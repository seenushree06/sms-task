<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use DataTables;
class TeacherController extends Controller
{
    public function index(Request $request)
    {
   
        if ($request->ajax()) {
            $data = Teacher::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editTeacher">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteTeacher">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('teacher',compact('teachers'));
    }
    public function store(Request $request)
    {   

        Teacher::updateOrCreate(['id' => $request->teacher_id],
                ['name' => $request->name, 'designation' => $request->designation, 'standard' => $request->standard]);        
   
        return response()->json(['success'=>'Teacher saved successfully.']);
    }
  
    public function edit($id)
    {
        $teacher = Teacher::find($id);
        return response()->json($teacher);
    }
  
    public function destroy($id)
    {
        Teacher::find($id)->delete();
     
        return response()->json(['success'=>'Teacher deleted successfully.']);
    }
}
