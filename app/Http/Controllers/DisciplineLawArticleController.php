<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use DB;
use App\Models\DisciplineLawArticle;

class DisciplineLawArticleController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function showArticleView(){
        return view("admin.disciplineApp.article.articleShow");
    }

    public function showArticleViewByLawID($lawID){
        $articles = $this->getParentArticles($lawID);
        return view("admin.disciplineApp.article.articleShowByLawID", compact("articles"));
    }

    public function getParentArticles($lawID){
        $articles = DB::table('tb_discipline_article')
            ->where('lawID', '=', $lawID)
            ->where('parentID', '=', 0)
            ->get();
        return $articles;
    }

    public function getParentArticlesAjax(Request $req){
      $articles = DB::table('tb_discipline_article')
          ->where('lawID', '=', $req->lawID)
          ->where('parentID', '=', 0)
          ->get();
        return $articles;
    }

    public function getChildArticlesAjax(Request $req){
        $articles = DB::table('tb_discipline_article')
            ->where('parentID', '=', $req->id)
            ->get();
        return $articles;
    }

    public static function getChildArticles($parentID){
        $articles = DB::table('tb_discipline_article')
            ->where('parentID', '=', $parentID)
            ->get();
        return $articles;
    }

    public function store(Request $req){
        try {
            $article = new DisciplineLawArticle;
            $article->lawID = $req->lawID;
            $article->parentID = $req->parentID;
            $article->articleName = $req->articleName;
            $article->save();

            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай хадгаллаа!!!'
            );
            return $array;
        } catch (\Exception $e) {
            $array = array(
                'status' => 'error',
                'msg' => 'Алдаа гарлаа!!!'
            );
            return $array;
        }
    }

    public function delete(Request $req){
        try {
            $article = DisciplineLawArticle::find($req->id);
            $article->delete();
            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай устгалаа!!!'
            );
            return $array;
        } catch (\Exception $e) {
            $array = array(
                'status' => 'error',
                'msg' => 'Алдаа гарлаа!!!'
            );
            return $array;
        }
    }

    public function getAllArticle(){

        $laws = DB::table('tb_discipline_article')->get();
        $array = array(
                'title' => $laws
            );
        return json_encode($array);
    }
}
