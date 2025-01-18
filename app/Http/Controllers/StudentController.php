<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Student;
use App\Models\User;
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





    public function searchStudent(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::where('name', 'LIKE','%' .$request->name . '%')->get();
            $output = '';
    
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block; position:relative; z-index:1">';
    
                foreach ($data as $row) {
                    $output .= '<li class="list-group-item">' . $row->name . '</li>';
                }
                $output .= '</ul>';
            }
             else {
                $output .= '<li class="list-group-item">No Data Found</li>';
            }
    
            return $output;
        }
    
        return view('search');
    }






    public function userSearch(Request $request)
    {

        $query=User::query();

        if ($request->ajax()) {
            $users = $query->where('name', 'LIKE','%' .$request->search. '%')
            ->orWhere('email', 'LIKE','%' .$request->search. '%')
            ->get();
            return response()->json(['users'=>$users]);
        }

        $users=$query->get();
        return view('userSearch', compact('users'));
    }



    public function filterProduct(Request $request)
    {

       $query=Product::query();
       $categories=Category::all();


       if($request->ajax()){

        if (empty($request->category)) {

            $products = $query->get();

        }
        
        else {

            $products= $query->where(['category_id'=>$request->category])->get();
        }

        return response()->json(['products'=> $products]);
       }

       $products = $query->get();

       return view('filterProduct',compact('categories','products'));
    }
    
}
