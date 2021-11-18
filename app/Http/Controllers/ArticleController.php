<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Http\Requests\ArticleFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $articles = Article::with(['user','category'])->when(isset($request->search),function ($q){
                    $search = request()->search;
                    return $q->where('title','like',"%$search%");
                    })->paginate(5);
        return view('Article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Article.summernote');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleFormRequest $request)
    {
        $hash = htmlspecialchars($request->description);

        $article = new Article();
        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->description = $hash;
        $article->user_id = Auth::id();
        $article->category_id = $request->category_id;
        $article->slug_category = Category::where('id',$request->category_id)->first()->slug;
        if(isset($request->photo)){
            $photo = $request->photo;
            $newName = uniqid().'.'.$photo->extension();

            Storage::putFileAs('public/BlogPhoto',$photo,$newName);
            $article->photo = $newName;
        }
        if(isset($request->mainCover)){
            $this->mainCoverDelete();
            $article->mainCover = '1';
        }
        $article->save();
        return redirect()->route('article.index')->with('toast',['icon'=>'success','title'=>'New Article']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Article $article)
    {
        $page = $request->page;
        return view('Article.show',compact('article','page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('Article.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleFormRequest $request, Article $article)
    {
        $hash = htmlspecialchars($request->description);

        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->description = $hash;
        $article->category_id = $request->category_id;
        $article->slug_category = Category::where('id',$request->category_id)->first()->slug;
        if(isset($request->photo)){
            $photo = $request->photo;
            $newName = uniqid().'.'.$photo->extension();

            Storage::putFileAs('public/BlogPhoto',$photo,$newName);
            $article->photo = $newName;
        }
        if(isset($request->mainCover)){
            $this->mainCoverDelete();
            $article->mainCover = '1';
        }
        $article->update();

        return redirect()->route('article.index')->with('toast',['icon'=>'success','title'=>'Article Updated']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $file = $article->photo;
        if($article->mainCover == '1'){
            return redirect()->route('article.index',['page'=>request()->page])->with('message',['icon'=>'error','title'=>'If You Want To Delete You Need To Change Star']);
        }
        if($file != 'blog_photo.jpeg'){
            Storage::delete('BlogPhoto/'.$file);
        }
        $article->delete();
        return redirect()->route('article.index',['page'=>request()->page])->with('toast',['icon'=>'success','title'=>'Article Deleted']);
    }


    public function coMainDelete($choose)
    {
        $articles = Article::all();
        foreach ($articles as $a){
           if($a->co_main == $choose){
               $a->co_main = '0';
               $a->update();
           }
        }
    }

    public function coMainLeft(Article $article)
    {

        if($article->co_main == '2'){
            return redirect()->route('article.index')->with('toast',['icon'=>'question','title'=>'Already Added Star']);
        }
        $this->coMainDelete(2);
        $article->co_main = '2';
        $article->update();

        return redirect()->route('article.index')->with('toast',['icon'=>'success','title'=>'Co_Main Article Added'.$article->co_main]);

    }

    public function coMainRight(Article $article)
    {

        if($article->co_main == '1'){
            return redirect()->route('article.index')->with('toast',['icon'=>'question','title'=>'Already Added Star']);
        }
        $this->coMainDelete('1');
        $article->co_main = '1';
        $article->update();

        return redirect()->route('article.index')->with('toast',['icon'=>'success','title'=>'Co_Main Article Added'.$article->co_main]);
    }



    public function mainCoverDelete()
    {
        $articles = Article::all();
        foreach ($articles as $a){
            $a->mainCover = '0';
            $a->update();
        }
    }


    public function mainCover(Article $article)
    {

        if($article->mainCover == '1'){
            return redirect()->route('article.index')->with('toast',['icon'=>'question','title'=>'Already Added Star']);
        }
        $this->mainCoverDelete();
        $article->mainCover = '1';
        $article->update();

        return redirect()->route('article.index')->with('toast',['icon'=>'success','title'=>'Main Article Added']);
    }

    public function dataTable(){
        $articles = Article::with(['user','category'])->get();
        return view('Article.dataTable',compact('articles'));
    }

    public function showDataTable(Request $request){
        $data = Article::with('category');
        return DataTables::of($data)
            ->editColumn('title',function ($each){
                return   ' <span class="font-weight-bolder ">
                          '.Str::limit($each->title,20).'
                             </span>
                             <br>
                              <small class="text-black-50">
                           '.Str::limit($each->description,30).'
                           </small>' ;
            })
            ->addColumn('category',function ($each){
                return $each->category->title;
            })
            ->addColumn('hello',function ($each){
                return $each->created_at->diffForHumans();
            })
            ->addColumn('action',function ($each){

                return '<a href="'.route("article.show",$each->id). '" class="btn btn-outline-success">Detail</a>
                        <a href="'.route("article.edit",$each->id).'" class="btn btn-outline-warning">Edit</a>
                        <button type="button" onclick="askConfirm('.$each->id.')" class="btn btn-outline-primary deleteBtn">Delete</button>
';
            })
            ->rawColumns(['action','title','hello'])
            ->make(true);
    }
}
