<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use DB;
use App\Models\DisciplineLaw;

class DisciplineLawController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function showLawView(){
        $articles = DB::table('tb_discipline_article')
            ->where('parentID', '=', 0)
            ->get();
        return view("admin.disciplineApp.law.lawShow", compact("articles"));
    }

    public function getLaw(Request $req){
        $articles = DB::table('tb_discipline_law')
            ->where('articleID', '=', $req->articleID)
            ->get();
        return $articles;
    }

    public function loadLaw(Request $req){
        $law = DB::table("tb_discipline_law")
            ->where('articleID', '=', $req->articleID)
            ->get();
        return $law;
    }

    public function store(Request $req){
        // try {
            if($this->checkLaw($req->articleID) == 0){
                $law = new DisciplineLaw;
                $law->articleID = $req->articleID;
                $law->law = $req->law;
                $law->save();
            }
            else{
                DisciplineLaw::where('articleID', '=', $req->articleID)
                    ->update([
                        'law' => $req->law
                    ]);
            }
            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай хадгаллаа!!!'
            );
            return $array;
        // } catch (\Exception $e) {
        //     $array = array(
        //         'status' => 'error',
        //         'msg' => 'Алдаа гарлаа!!!'
        //     );
        //     return $array;
        // }
    }

    public function checkLaw($articleID){
        $article = DB::table('tb_discipline_law')
            ->where('articleID', '=', $articleID)
            ->get();
        return count($article);
    }

    public function delete(Request $req){
        try {
            $article = DisciplineLaw::find($req->id);
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

    public function getAllLaw(){
        $laws = DB::table('tb_discipline_law')->get();
        $array = array(
                'title' => $laws
            );
        return json_encode($array);
    }
}
