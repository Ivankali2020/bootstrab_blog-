<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request){

        $categories = Category::all();
        $mainCover = Article::where('mainCover','1')->with('user','category')->first();
        $co_mains = Article::where('co_main','>','0')->with('category')->get();
        $articles = $this->getArticles($request,$mainCover->id);

        $random = Article::inRandomOrder()->limit(10)->pluck("created_at")->all();
//        return $random;
        return view('welcome',compact('articles','categories','mainCover','co_mains','random'));
    }

    public function show(Request $request,$article_id){

        $article = Article::where('slug',$article_id)->with('user','category')->first();
        $articles = $this->getArticles($request,$article->id);

        if(isset(request()->search)){
            $article = $articles->first();
            $articles = $this->getArticles($request,$article->id); //ဒါက articles ထဲမှာ မထပ်အောင်လို့ပါ

            return view('blog.detail',compact('article','articles'));
        }
        return view('blog.detail',compact('article','articles'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getArticles(Request $request,$article_id)
    {

        $articles = Article::when(isset($request->category), function ($q) {
            $id = request('category');
            return $q->where('slug_category', $id);
        })->when(isset($request->search), function ($q) {
            $search = request()->search;
            return $q->orWhere('title', 'like', "%$search%")->orWhere('description', 'like', "%$search%");
        })->when(isset($request->date), function ($q) {
            $month = request()->date;
            return $q->whereDate('created_at',"$month");
        })->with('category', 'user')->orderBy('id', 'desc')->where('id','!=',$article_id)->simplePaginate(4);
        return $articles;
    }
}
