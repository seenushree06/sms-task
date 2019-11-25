<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use DataTables;

class StudentController extends Controller
{
   public function index(Request $request)
    {
   
        if ($request->ajax()) {
            $data = Student::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editStudent">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteStudent">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('student',compact('students'));
    }
    public function store(Request $request)
    {   

        Student::updateOrCreate(['id' => $request->student_id],
                ['name' => $request->name, 'section' =>$request->section,'standard' =>$request->standard]);        
   
        return response()->json(['success'=>'Student saved successfully.']);
    }
  
    public function edit($id)
    {
        $student = Student::find($id);
        return response()->json($student);
    }
  
    public function destroy($id)
    {
        Student::find($id)->delete();
     
        return response()->json(['success'=>'student deleted successfully.']);
    }
}
