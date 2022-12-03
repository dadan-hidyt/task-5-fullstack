<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article as ModelsArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Article extends Controller
{
    //for show article
    public function index(){
        return response()->json(['status'=>true,'data'=>ModelsArticle::paginate(25)],200);
    }
    public function detail($id = null) {
        if (is_null($id)){
            return null;
        }
        //mendapatkan data berdasarkan id
        $detail = DB::table('articles')->where('id',$id)->first();
        if ($detail){
            return response()->json([
                'status' => true,
                'data' => $detail,
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Artikel Tidak di temukan',
        ]);
    }
    public function delete($id = null){
        if (is_null($id)){
            return null;
        }
        if (DB::table('articles')->where('id',$id)->delete()) {
            return response()->json('Data berhasil di hapus');
        }
        return response()->json('data gagal di hapus');
    }
    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);
        ModelsArticle::create($data);
        return response()->json(['status'=>'true','message'=>'Article success inserted','data'=>$data]);
    }
    public function update(Request $request){
    
        $data = $request->validate([
            'id'=> 'required',
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);
        $update = DB::table('articles')->where('id',$data['id'])->update($data);
        if($update){
            return response()->json(['status'=>'true','message'=>'Article success updated','data'=>$data]);
        } else {
            return response()->json(['status'=>'false','message'=>'Article failed updated']);
        }
    }
}
