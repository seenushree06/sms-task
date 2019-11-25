<?php

namespace App\Http\Controllers;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use DataTables;
class SchoolController extends Controller
{
   public function index(Request $request)
    {  
   
        if ($request->ajax()) {

             $data = Student::select ('students.name','teachers.name as teacher_name','students.standard','students.section')->join('teachers','teachers.standard','=','students.standard')->get();
            // $data = Teacher::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }
        
      
        return view('school',compact('students'));
    }
    public function store(Request $request)
    {   

        Teacher::updateOrCreate(['id' => $request->teacher_id],
                ['name' => $request->name, 'designation' => $request->designation]);        
   
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
     
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
