<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Article::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $newArticle = $request->validate([
            'code'=> 'required',
            'libelle'=> 'required',
            'slug'=> 'required',
            'description'=> 'required',
            'prix'=> 'required',
        ]);
        $article= Article::create([
            'code' => $newArticle['code'],
            'libelle' => $newArticle['libelle'],
            'slug' => $newArticle['slug'],
            'description' => $newArticle['description'],
            'prix' => $newArticle['prix']
        ]);
        return response($article,201);
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
