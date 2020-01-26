<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\EmployeeInfo;

class EmployeeController extends Controller
{

    public function index()
	{
		$employee_info = new Employee();
		$employee_info_edit = new Employee();
	    $employees = Employee::get();
	    $employers = EmployeeInfo::get();
	    return view('employee.index',compact('employee_info_edit','employees','employee_info','employers'));
	}

	public function show($id)
	{
	    $employee_info = Employee::where('id',$id)->first();
	    $employee_info_edit = new Employee();
	    $employees = Employee::get();
	    $employers = EmployeeInfo::get();
	    return view('employee.index',compact('employee_info_edit','employees','employee_info','employers'));
	}

	public function store(Request $request)
	{
	    $this->validate($request, [
	        'date' => 'required',
	        'employee_code' => 'required',
	        'offence' => 'required',
	        'punishment' => 'required',
	        'punishment_line1' => 'nullable',
	        'punishment_line2' => 'nullable',
	        'remarks' => 'nullable',
	    ]);

	    $employee = new Employee();
	    $employee->date = $request->date;
	    $employee->employee_code = $request->employee_code;
	    $employee->offence = $request->offence;
	    $employee->punishment = $request->punishment;
	    $employee->punishment_line1 = $request->punishment_line1;
	    $employee->punishment_line2 = $request->punishment_line2;
	    $employee->remarks = $request->remarks;
	    $employee->save();

	    return back();
	}

	public function edit($id)
	{
	    $employee_info_edit = Employee::where('id',$id)->first();
	    $employee_info = Employee::where('id',$id)->first();
	    $employees = Employee::get();
	    $employers = EmployeeInfo::get();
	    return view('employee.index',compact('employee_info_edit','employees','employee_info','employers'));
	}

	public function update(Request $request, $id)
	{
	    $employee = Employee::find($id);
	    $employee->date = $request->date;
        $employee->employee_code = $request->employee_code;
        $employee->offence = $request->offence;
        $employee->punishment = $request->punishment;
        $employee->punishment_line1 = $request->punishment_line1;
        $employee->punishment_line2 = $request->punishment_line2;
        $employee->remarks = $request->remarks;
        $employee->save();
	    return redirect()->route('employee.index');
	}

	public function destroy($id)
	{
	    $employee = Employee::where('id',$id)->delete();

	    return redirect()->route('employee.index');
	}

	public function autocompleteSearch(Request $request)
    {
        $searchquery = $request->searchquery;
        $data = EmployeeInfo::where('name','like','%'.$searchquery.'%')->get();
        return response()->json($data);
    }
}
