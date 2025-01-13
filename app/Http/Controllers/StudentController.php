<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function addStudent(Request $request)
    {

    $file=$request->file('file');
    $fileName=time().''.$file->getClientOriginalName();
    $filepath=$file->storeAs('images',$fileName,'public');

    $Student=new Student;

    $Student->name=$request->name;
    $Student->email=$request->email;
    $Student->image=$filepath;
    $Student->save();

       return response()->json(['result' => 'Student Created Successfully']);
    }


    public function getStudent()
    {
    $students=Student::all();

       return response()->json(['students' => $students]);
    }


    public function editStudent($id)
    {
        // Correct method to find a student by id
        $student = Student::where('id',$id)->get();
    
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }
    
        return view('editStudent', ['student' => $student]);
    }

    

    public function updateStudent(Request $request)
    {

    $student=Student::find($request->id);

    $student->name=$request->name;
    $student->email=$request->email;
    
if($request->file('file'))
{

   $file=$request->file('file');
   $fileName=time().''.$file->getClientOriginalName();
   $filepath=$file->storeAs('images',$fileName,'public');
   $student->image=$filepath;
}


    $student->save();

       return response()->json(['result' => 'Student Updated Successfully']);
    }



    public function deleteStudent($id)
    {

       $student=Student::where('id',$id)->delete();

       return response()->json(['result' => 'Student Deleted Successfully']);
    }
}
