<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articles = Article::all();
        return response()->json(['articles' => $articles]);
        // return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'code'=> 'required',
            'libelle'=> 'required',
            'slug'=> 'required',
            'description'=> 'required',
            'prix'=> 'required',

        ]);
        if($validator->fails()){

            $errors = $validator->errors();
            $errorList = [];

            foreach ($errors->keys() as $champ) {
                $errorList[$champ] = $errors->first($champ);
            }

            return response()->json([
                'status'=>422,
                'errors'=>$errorList],422
                );
        }
        else{
    $article= Article::create([
        'code' => $request->code,
        'libelle' => $request->libelle,
        'slug' => $request->slug,
        'description' => $request->description,
        'prix' => $request->prix,
    ]);

    if($article) {

        return response()->json([
            'status'=>200,
            'message'=>"Ajout OKK",
            'article'=>$article], 200);
    } else {
        return response()->json(
            [
            'status'=>500,
            'message'=>"NON OKK"],
            500
        );
    }
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
        return Article::find($id);
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
        $article = Article::find($id);
        $article->update($request->all());

        return $article;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Article::destroy($id);
    }



    /**
     * Search for libelle
     *
     * @param  str  $libelle
     * @return \Illuminate\Http\Response
     */
    public function search($libelle)
    {
        return Article::where('libelle','like','%'.$libelle.'%')->get();
    }
}
