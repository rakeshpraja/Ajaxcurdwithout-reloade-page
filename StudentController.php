<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    public function studendForm(){
        //$student= Student::get();
        return view('index');
    }
    public function studendAll(){
        $student= Student::get();
        return response()->json(['student'=>$student]);
    }
    public function storedata(Request $request){
       
      $filename= $request->file('image');
      $files=time().''.$filename->getClientOriginalName();
      $filee=$filename->storeAs('images',$files,'public');
      if($request->id!=""){
        $student= Student::find($request->id);
      $student->name=$request->name;
      $student->email=$request->email;
      $student->image=$filee;
      if( $student->save()){
            return response()->json(['success'=>"update successfully"]);
      }
      }else{
      $student=new Student();
      $student->name=$request->name;
      $student->email=$request->email;
      $student->image=$filee;
      if( $student->save()){
            return response()->json(['success'=>"add successfully"]);
      }
    }
    }
    public function editdata($id){
        $data= Student::find($id);
       
        return response()->json($data);
    }

    public function deletedata($id){
        $data= Student::find($id)->delete();
       
        return response()->json($data);
    }
    
   
}
