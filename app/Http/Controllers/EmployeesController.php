<?php

namespace App\Http\Controllers;

use App\Models\employees;
use Illuminate\Http\Request;
use App\Models\employee_attachments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = employees::all();
        return view('employees.employees',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.add_employee');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'position' => 'nullable|string',
            'salary' => 'nullable|string',
            'hire_date' => 'nullable|string',
        ]);

        // Create a new employee instance with the validated data
        $employee = employees::create($validatedData);
        if ($request->hasFile('pic')) {
            $employee_id = employees::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $employee_name = $request->name;
            $attachments = new employee_attachments();
            $attachments->file_name = $file_name;
            $attachments->Created_by = Auth::user()->name;
            $attachments->employee_id = $employee_id;
            $attachments->save();
            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $employee_name), $imageName);
        }
        return redirect()->back()->with('message','تم إضافة الموظف بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = employees::findorfail($id);
        $employee_attachments = employee_attachments::where('employee_id',$id)->get();
        return view('employees.employee_details',compact('employee','employee_attachments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = employees::findorfail($id);
        return view('employees.edit_employee',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employees $employees)
    {

        $employee = employees::findorfail($request->id);
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->address= $request->address;
        $employee->position=$request->position;
        $employee->salary =$request->salary;
        $employee->hire_date =$request->hire_date;
        $employee->save();
        return redirect()->back()->with('message','تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->employee_id;
        $employees = employees::where('id', $id)->first();
        $Details = employee_attachments::where('employee_id', $id)->first();

         $id_page =$request->id_page;


        if (!$id_page==2) {

        if (!empty($Details->employee_id)) {

            Storage::disk('public_uploads')->deleteDirectory($employees->name);
        }

        $employees->forceDelete();
        session()->flash('delete_customer');
        return redirect('/employees');

        }

        else {

            $employees->delete();
            session()->flash('archive_invoice');
            return redirect('/Archive');
        }
    }
}
