<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listeArticles = Article::selectArticle();
        return view('forum.forum', ['listeArticles' => $listeArticles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Session::get('id');
        $user = User::find($id);
        
        return view('forum.createArticle',['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $request->validate([
            'title' => 'between:2,20|required_without:title_fr',
            'body' => 'required_without:body_fr',
            'title_fr' => 'between:2,20|required_without:title',
            'body_fr' => 'required_without:body',
        ]);
        $newArticle = new Article;
        
        $newArticle->fill($request->all());
        ($request->title != null) ? $newArticle->title = $request->title : $newArticle->title ='';  
        ($request->title_fr != null) ? $newArticle->title_fr = $request->title_fr : $newArticle->title_fr ='';
        ($request->body != null) ? $newArticle->body = $request->body : $newArticle->body ='';  
        ($request->body_fr != null) ? $newArticle->body_fr = $request->body_fr : $newArticle->body_fr ='';

        $newArticle->save();

        return redirect(route('forum'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        if(session()->has('locale'))
        {
            if (session()->get('locale') == 'fr')
            {
                $article = Article::Select('articles.id',
                DB::raw('(case 
                            when (title_fr != "") then title_fr else title
                        end) as title'),
                DB::raw('(case 
                            when (body_fr != "") then body_fr else body
                        end) as body'),
                'articles.userId',
                'users.name as nom',
                'articles.created_at',
                'articles.updated_at'   
                )
                ->JOIN('users','users.id','=','articles.userId')
                ->WHERE('articles.id', $article->id )
                ->get(); 
            }
            else
            {
                $article = Article::Select('articles.id',
                DB::raw('(case 
                            when (title != "") then title else title_fr
                        end) as title'),
                DB::raw('(case 
                            when (body != "") then body else body_fr
                        end) as body'),
                'articles.userId',
                'users.name as nom',
                'articles.created_at',
                'articles.updated_at'   
                )
                ->JOIN('users','users.id','=','articles.userId')
                ->WHERE('articles.id', $article->id )
                ->get(); 
            }    
        }
        
        return view('forum.showArticle', ['article' => $article[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $user = User::find($article->userId); 
        return view('forum.editArticle', ['article' => $article, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {   
        // return 'article edit';
        $request->validate([
            'title' => 'required_without:title_fr',
            'body' => 'required_without:body_fr',
            'title_fr' => 'required_without:title',
            'body_fr' => 'required_without:body',
        ]);

        $article->update([
            'title' => ($request->title != null) ? $request->title = $request->title : $request->title ='',
            'body' => ($request->body != null) ? $request->body = $request->body : $request->body ='',
            'title_fr' => ($request->title_fr != null) ? $request->title_fr = $request->title_fr : $request->title_fr ='',
            'body_fr' => ($request->body_fr != null) ? $request->body_fr = $request->body_fr : $request->body_fr =''
        ]);

        return redirect(route('article.show', $article->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        
        $article->delete();
        
        return redirect(route('forum'));
    }
}
