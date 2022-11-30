<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article as ModelsArticle;
use Illuminate\Http\Request;

class Article extends Controller
{
    //for show article
    public function index(){
        return response()->json(['status'=>true,'data'=>ModelsArticle::paginate(25)],200);
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
}
