<?php

namespace App\Http\Controllers;

use App\Enums\Bank;
use App\Enums\Position;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{

    public function index()
    {
        $query = request('query');
        $employees = Employee::query();
        $employees->where('first_name', 'like', '%' . $query . '%')
            ->orWhere('last_name', 'like', '%' . $query . '%');

        $employees = $employees->latest()->paginate(10)->withQueryString();
        return response()->json($employees);
    }

    public function home()
    {
        $query = request('query');
        $post = request('post');

        $employees = Employee::query();
        $positions = Position::cases();

        if ($post != null) {
            $employees->where('position', $post);
        }

        if ($query != null) {
            $employees->where(function ($q) use ($query) {
                $q->where('first_name', 'like', '%' . $query . '%')
                    ->orWhere('last_name', 'like', '%' . $query . '%');
            });
        }

        $employees = $employees->paginate(10)->withQueryString();
        return view('employee.index', [
            'employees' => $employees,
            "positions" => $positions,
            "query" => $query,
            'post' => $post,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $banks = Bank::cases();
        $positions = Position::cases();
        return view('employee.form', [
            "title" => "Create Employee",
            "method" => "store",
            "banks" => $banks,
            "positions" => $positions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $formData = $request->except("id_scan");

        if ($request->hasFile('id_scan')) {
            $path = Employee::storeImage($request->file('id_scan'));
            $formData['id_scan'] = $path;
        }
        Employee::create($formData);
        return redirect()->route('employees.home')->with('success', 'Employee created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $banks = Bank::cases();
        $positions = Position::cases();
        return view('employee.form', [
            "title" => "Edit Employee",
            "method" => "update",
            "param" => ["employee" => $employee->id],
            "employee" => $employee,
            "banks" => $banks,
            "positions" => $positions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $formData = $request->except("id_scan");

        if ($request->hasFile('id_scan')) {
            $path = $request->file('id_scan')->store('uploads', 'public');
            $formData['id_scan'] = $path;
        }
        $employee->update($formData);
        return redirect()->route('employees.home')->with('success', 'Employee created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.home')->with('success', 'Employee deleted successfully!');
    }
}
