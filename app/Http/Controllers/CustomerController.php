<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display the dashboard statistics.
     */
    public function dashboard()
    {
        $totalCustomers = Customer::count();
        $activeCustomers = Customer::where('status', 'Active')->count();
        $inactiveCustomers = Customer::where('status', 'Inactive')->count();
        $customersAddedThisMonth = Customer::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return view('dashboard', compact(
            'totalCustomers',
            'activeCustomers',
            'inactiveCustomers',
            'customersAddedThisMonth'
        ));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status', 'All');
        $status = in_array($status, ['Active', 'Inactive'], true) ? $status : 'All';

        $customers = Customer::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($status !== 'All', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('customers.index', compact('customers', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->prepareCustomerInput($request);

        $validated = $request->validate(
            $this->customerValidationRules($request),
            $this->customerValidationMessages()
        );

        Customer::create($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);

        $this->prepareCustomerInput($request);

        $validated = $request->validate(
            $this->customerValidationRules($request, $customer->id),
            $this->customerValidationMessages()
        );

        $customer->update($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Normalize customer input before validation.
     */
    private function prepareCustomerInput(Request $request): void
    {
        $request->attributes->set('customer_raw_input', $request->only([
            'first_name',
            'last_name',
            'email',
            'phone',
            'address',
            'status',
        ]));

        $status = Str::lower(trim((string) $request->input('status', '')));

        $request->merge([
            'first_name' => Str::title(Str::squish(strip_tags((string) $request->input('first_name', '')))),
            'last_name' => Str::title(Str::squish(strip_tags((string) $request->input('last_name', '')))),
            'email' => Str::lower(trim(strip_tags((string) $request->input('email', '')))),
            'phone' => str_replace([' ', '-'], '', trim((string) $request->input('phone', ''))),
            'address' => Str::squish(strip_tags((string) $request->input('address', ''))),
            'status' => match ($status) {
                'active' => 'Active',
                'inactive' => 'Inactive',
                default => trim(strip_tags((string) $request->input('status', ''))),
            },
        ]);
    }

    /**
     * Get the validation rules for customer create and update requests.
     */
    private function customerValidationRules(Request $request, ?int $customerId = null): array
    {
        $uniqueEmailRule = Rule::unique('customers', 'email');
        $uniquePhoneRule = Rule::unique('customers', 'phone');

        if ($customerId !== null) {
            $uniqueEmailRule->ignore($customerId);
            $uniquePhoneRule->ignore($customerId);
        }

        return [
            'first_name' => [
                'required',
                'string',
                'min:2',
                'max:100',
                'regex:/^[A-Za-z ]+$/',
                $this->safeTextRule($request, 'first_name'),
            ],
            'last_name' => [
                'required',
                'string',
                'min:2',
                'max:100',
                'regex:/^[A-Za-z ]+$/',
                $this->safeTextRule($request, 'last_name'),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'not_regex:/\s/',
                'ends_with:@gmail.com',
                $uniqueEmailRule,
                $this->safeTextRule($request, 'email'),
            ],
            'phone' => [
                'required',
                'regex:/^[0-9]+$/',
                'digits:10',
                'starts_with:0',
                $uniquePhoneRule,
                $this->safeTextRule($request, 'phone'),
            ],
            'address' => [
                'required',
                'string',
                'min:5',
                'max:255',
                'regex:/^[A-Za-z0-9\s,.\/#-]+$/',
                $this->safeTextRule($request, 'address'),
            ],
            'status' => ['required', Rule::in(['Active', 'Inactive']), $this->safeTextRule($request, 'status')],
        ];
    }

    /**
     * Reject script and SQL injection signatures using the original submitted value.
     */
    private function safeTextRule(Request $request, string $field): callable
    {
        return function (string $attribute, mixed $value, callable $fail) use ($request, $field): void {
            $rawInput = $request->attributes->get('customer_raw_input', []);
            $submittedValue = (string) ($rawInput[$field] ?? $value);
            $valueToInspect = $submittedValue . ' ' . (string) $value;

            if ($this->containsScriptInjection($valueToInspect)) {
                $fail('Scripts are not allowed.');
                return;
            }

            if ($this->containsSqlInjection($valueToInspect)) {
                $fail('Invalid characters detected.');
            }
        };
    }

    private function containsScriptInjection(string $value): bool
    {
        return preg_match('/<\s*\/?\s*script\b|javascript\s*:|\bon(?:error|click|load)\s*=/i', $value) === 1;
    }

    private function containsSqlInjection(string $value): bool
    {
        return preg_match("/(?:'\\s*)?\\bor\\b\\s+\\d+\\s*=\\s*\\d+\\s*(?:--|#)?|\\bdrop\\s+table\\b|\\bunion\\s+select\\b/i", $value) === 1;
    }

    /**
     * Get the custom validation messages for customer requests.
     */
    private function customerValidationMessages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'first_name.regex' => 'First name must contain only letters and spaces.',
            'first_name.min' => 'First name must be at least 2 characters.',
            'first_name.max' => 'First name cannot exceed 100 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.regex' => 'Last name must contain only letters and spaces.',
            'last_name.min' => 'Last name must be at least 2 characters.',
            'last_name.max' => 'Last name cannot exceed 100 characters.',
            'email.email' => 'Please enter a valid email address.',
            'email.not_regex' => 'Please enter a valid email address.',
            'email.ends_with' => 'Only Gmail addresses (@gmail.com) are allowed.',
            'email.unique' => 'This email has already been registered.',
            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Phone number must contain numbers only.',
            'phone.digits' => 'Phone number must contain exactly 10 digits.',
            'phone.starts_with' => 'Phone number must start with 0.',
            'phone.unique' => 'This phone number has already been registered.',
            'address.required' => 'Address is required.',
            'address.regex' => 'Invalid characters detected.',
            'address.min' => 'Address must be at least 5 characters.',
            'address.max' => 'Address cannot exceed 255 characters.',
            'status.required' => 'Please select a status.',
            'status.in' => 'Please select a status.',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
