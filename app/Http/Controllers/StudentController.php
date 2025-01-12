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
}
