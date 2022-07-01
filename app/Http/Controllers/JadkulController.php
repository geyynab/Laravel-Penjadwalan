<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadkul;
use Illuminate\Support\Facades\Validator;

class JadkulController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index()
    {
        //get data from table jadkul
        // $posts = Jadkul::latest()->get();

        // //make response JSON
        // return response()->json([
        //     'success' => true,
        //     'message' => 'List Data Jadwal Kuliah',
        //     'data'    => $posts  
        // ], 200);

        $posts=Jadkul::join('pengampu','pengampu.id','=', 'jadkul.id_pengampu')
                       ->join('jam','jam.id','=', 'jadkul.id_jam')
                       ->join('hari','hari.id','=', 'jadkul.id_hari')
                       ->join('ruang','ruang.id','=', 'jadkul.id_ruang')
                       ->get();
                       
        return Response()->json([
            'success' => true,
            'message' => 'List Data Jadwal Kuliah',
            'data'=>$posts
        ]);

    }
    
     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find post by ID
        $post = Jadkul::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Jadwal Kuliah',
            'data'    => $post 
        ], 200);

    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'id_pengampu' => 'required',
            'id_jam'      => 'required',
            'id_hari'     => 'required',
            'id_ruang'    => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $post = Jadkul::create([
            'id_pengampu'     => $request->id_pengampu,
            'id_jam'          => $request->id_jam,
            'id_hari'         => $request->id_hari,
            'id_ruang'        => $request->id_ruang,
        ]);

        //success save to database
        if($post) {

            return response()->json([
                'success' => true,
                'message' => 'Jadwal Kuliah Created',
                'data'    => $post  
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Jadwal Kuliah Failed to Save',
        ], 409);

    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, $id)
   {
       //set validation
       $validator = Validator::make($request->all(),[
            'id_pengampu' => 'required',
            'id_jam'      => 'required',
            'id_hari'     => 'required',
            'id_ruang'    => 'required',
       ]);

       //response error validation
       if($validator->fails()){
           return response()->json($validator->errors()->toJson());
       }
       $post= Jadkul::where('id', $id)->update([
            'id_pengampu'     => $request->id_pengampu,
            'id_jam'          => $request->id_jam,
            'id_hari'         => $request->id_hari,
            'id_ruang'        => $request->id_ruang,
       ]);
       if($post){
           return response()->json([
               'status'  =>true, 
               'message' =>'Jadwal Kuliah Updated',
            //    'data'    => $post 
           ], 200);
       } else {
           return response()->json([
               'status'  =>false, 
               'message' =>'Jadwal Kuliah Failed to Update'
           ], 404);
       }
   }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find post by ID
        $post = Jadkul::findOrfail($id);

        if($post) {

            //delete post
            $post->delete();

            return response()->json([
                'success' => true,
                'message' => 'Jadwal Kuliah Deleted',
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Jadwal Kuliah Not Found',
        ], 404);
    }
}
