<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    protected $employee;

    public function __construct(){
        $this->employee = new Employee();
    }

    public function index()
    {
        $employees = $this->employee->all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email|unique:users,email',
            // Add other validation rules as needed
        ]);

        // Create the User account for the worker
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phoneNo' => $request->phone,
            'password' => Hash::make('password123'),
            'role' => 'worker',
        ]);

        // Create the Employee record linked to the User
        $employeeData = $request->all();
        $employeeData['user_id'] = $user->id;
        $employee = $this->employee->create($employeeData);

        $prefix = auth()->user()->role === 'admin' ? 'admin.' : 'worker.';
        return redirect()->route($prefix . 'employees.index')->with('success', 'Employee created successfully. Default password is password123.');
    }

    public function show($id)
    {
        $employee = $this->employee->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = $this->employee->findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = $this->employee->findOrFail($id);
        $employee->update(array_merge($employee->toArray(), $request->toArray()));

        $prefix = auth()->user()->role === 'admin' ? 'admin.' : 'worker.';
        return redirect()->route($prefix . 'employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = $this->employee->findOrFail($id);
        
        // Delete the associated user account if it exists
        if ($employee->user_id) {
            User::destroy($employee->user_id);
        }

        $employee->delete();

        $prefix = auth()->user()->role === 'admin' ? 'admin.' : 'worker.';
        return redirect()->route($prefix . 'employees.index')->with('success', 'Employee deleted successfully.');
    }
}
