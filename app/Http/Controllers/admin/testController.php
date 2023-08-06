<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use DB;
class testController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
           $students=Student::all();

           return response ([
                      'students'=>$students,
                       'message'=>'Success'

           ]);
        }catch(Exception $ex){
                return response ([
                
                   'message'=>$ex->getMessage()

               ]);

        }
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
        //

        // $validator=Validator::make($request->all(),[
        //     'name'=>'required',
        //                'size'=>'required',
        //                'price'=>'required'

        // ]);

        // if($validator->fails()){

        //     return response([
        //         'message'=>$validator->errors()->all()
        //     ]);
        // }


//       $validator=  $request->validate([
//            'name'=>'required',
//            'size'=>'required',
//            'price'=>'required'

//         ]);
//    if($validator->fails()){

//             return response([
//                 'message'=>$validator->errors()->all()
//             ]);
//         }
        try{
            $validator=  $request->validate([
                'name'=>'required',
                'size'=>'required',
                'price'=>'required'
     
             ]);

             if($validator){
                $student=new Student();
                $student->name=$request->name;
                $student->size=$request->size;
                $student->price=$request->price;
                $student->save();
    
                return response([
                   'message'=>'Student Create',
                   'student'=>$student
                ]);
             }else{
                return response([
                    "message"=> "The given data was invalid.",
                ]);
             }
          
         

        }catch(Exception $ex){
           
           return redirect([
            'message'=>$ex->getMessage()
           ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        try{

            $student=Student::find($id);
            $student->name=$request->name;
            $student->size=$request->size;
            $student->price=$request->price;
            $student->save();

            return response([
             
                "message"=>"student Update",
                "student"=>$student

            ]);

        }catch(Throwable $th){

            return response([
                'message'=>$th->getMessage()
               ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{

            $student=Student::find($id);
            $student->delete();

            return response ([
              
                "message"=>'student deleted'

            ]);

           }catch(Throwable $th){
            return response([
                'message'=>$th->getMessage()
               ]);
           }

    }


    
public function uploadImage(Request $request){
   try{

    if($request->hasFile('image')){
       $file=$request->file('image');
       $filename=$file->getClientOriginalName();
       $picture=\date('His').'-'.$filename;

        $file->move(\public_path('upload'),$picture);
        return response([
            'message'=>"image upload",
            'file'=>$picture
        ]);
        
    }else{

        return response([
            'message'=>"select image first"
        ]);
    }

   }catch(Throwable $th){
    return response([
        'message'=>$th->getMessage()
       ]);
    
   }
}
}