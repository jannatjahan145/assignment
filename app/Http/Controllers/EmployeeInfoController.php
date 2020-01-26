<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeInfo;
use Image;


class EmployeeInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee_info = new EmployeeInfo();
        $employee_info_edit = new EmployeeInfo();
        $employees = EmployeeInfo::get();
        return view('employee_info.index',compact('employee_info_edit','employees','employee_info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'rank' => 'required',
            'designation' => 'required',
            'organization' => 'nullable',
            'location' => 'nullable',
            'photos' => 'nullable',
        ]);

        $imageName= '';
        if($request->file('photos')){
            $photo = $request->file('photos');
            $l_extension=$photo->getClientOriginalExtension();
            $imageName = time().'.'.$request->name.'.'.$l_extension;
            Image::make($photo)->heighten(100)->save(public_path('/images/').$imageName);
        }

        $employee = new EmployeeInfo();
        $employee->name = $request->name;
        $employee->rank = $request->rank;
        $employee->designation = $request->designation;
        $employee->organization = $request->organization;
        $employee->location = $request->location;
        $employee->photos = $imageName;
        $employee->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee_info = EmployeeInfo::where('id',$id)->first();
        $employee_info_edit = new EmployeeInfo();
        $employees = EmployeeInfo::get();
        return view('employee_info.index',compact('employee_info_edit','employees','employee_info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee_info_edit = EmployeeInfo::where('id',$id)->first();
        $employee_info = EmployeeInfo::where('id',$id)->first();
        $employees = EmployeeInfo::get();
        return view('employee_info.index',compact('employee_info_edit','employees','employee_info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = EmployeeInfo::find($id);

        $oldPhoto = $employee->photos;

        $photoName = '';
        if($request->hasFile('photos')){
            $photo = $request->file('photos');
            $pName = $photo->getClientOriginalExtension();
            $photoName = time().'.'.$employee->name.'.'.$pName;
            Image::make($photo)->heighten(100)->save(public_path('/images/').$photoName);
            $photo = $photoName;
        }else{
            $photo = $employee->photos;
        }
        
        $employee->name = $request->name;
        $employee->rank = $request->rank;
        $employee->designation = $request->designation;
        $employee->organization = $request->organization;
        $employee->location = $request->location;
        $employee->photos = $photo;
        $employee->save();

        return redirect()->route('employee-info.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = EmployeeInfo::where('id',$id)->delete();

        return redirect()->route('employee-info.index');
    }
}
