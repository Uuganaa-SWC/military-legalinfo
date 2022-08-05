<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\ConsoleEvents;

use function PHPUnit\Framework\returnSelf;

class DisciplineController extends Controller
{
    // Дүрэм журам харах хэсгийн Expandable list View харуулхад дээд цэснээс id аваад буцааж байна.
    public function getAricleExpandable(Request $req){
        // return $req->lawID;
        try{
            $desciplinArticle = DB::table("tb_discipline_article")
            ->where("tb_discipline_article.lawID", "=", $req->lawID)->get();
            // ->join("tb_discipline_type_law", "tb_discipline_type_law.lawID", "=", "tb_discipline_article.lawID")

            // ->select("tb_discipline_article.*", "tb_discipline_type_law.lawName", "tb_discipline_type_law.isDurem" )->get();
            $arrayBig = array();
            foreach ($desciplinArticle as $value) {
                if($value->parentID == 0){
                    $row = array(
                        "id" => $value->id,
                        "lawID" => $value->lawID,
                        "parentID" => $value->parentID,
                        "articleName" => $value->articleName,
                        // "lawName" => $value->lawName,
                        // "isDurem" => $value->isDurem,
                        "isExpanded" =>false,
                        "childrenCount" => $this->getChildCount($value->id),
                        "children" => $this->getChildMenu($value->parentID,$value->id)
                    );
                   array_push($arrayBig,$row);
                }

            }
           return $arrayBig;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function getChildCount($ID){
            $desciplinArticle = DB::table("tb_discipline_article")->where("parentID", "=", $ID)
            ->select("id", "lawID", "parentID","articleName as childName")
            ->count();
        return $desciplinArticle;


    }

    // $legals = DB::table("header_menu")->select("header_menu.id", "header_menu.header_menu_name", DB::raw("(select count(`legal`.`id`) FROM `legal` inner join `sub_menu` on `legal`.`sub_menu_id` = `sub_menu`.`id` inner join `side_menu` on `sub_menu`.`side_menu_id` = `side_menu`.`id` where `side_menu`.`header_menu_id` = `header_menu`.`id`) as count"))->get();
    public function getAricleJson(){
        try{
            $desciplinArticle = DB::table("tb_discipline_article")
            ->join("tb_discipline_type_law", "tb_discipline_type_law.lawID", "tb_discipline_article.lawID")
            ->select("tb_discipline_article.*", "tb_discipline_type_law.lawName", "tb_discipline_type_law.isDurem" )->get();
            // return $desciplinArticle;
            $arrayBig = array();
            foreach ($desciplinArticle as $value) {
                if($value->parentID == 0){
                    $row = array(
                        "id" => $value->id,
                        "lawID" => $value->lawID,
                        "parentID" => $value->parentID,
                        "articleName" => $value->articleName,
                        "lawName" => $value->lawName,
                        "isDurem" => $value->isDurem,
                        "children" => $this->getChildMenu($value->parentID,$value->id)
                    );
                   array_push($arrayBig,$row);
                }

            }
           return $arrayBig;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getChildMenu($parentID,$ID){
        if($parentID == 0){
            $desciplinArticle = DB::table("tb_discipline_article")->where("parentID", "=", $ID)
            ->select("id", "lawID", "parentID","articleName as childName")
            ->get();
        return $desciplinArticle;
        }

    }

    function createSubTitleCheck(array $elements, $parentIdid = 0){
        $branch = array();
        foreach ($elements as $element) {

            if ($element['parentID'] == $parentIdid) {
                // $children = $this->createSubTitle($elements, $element['value']);
                // if ($children) {
                //     $element['children'] = $children;
                // }
                $branch[] = $element;
            }else{
                $children = $this->createSubTitle($elements, $element['value']);
                if ($children) {
                    $element['children'] = $children;
                }
            }
        }

        return $branch;
    }

    function createSubTitle(array $elements){
        $branch = array();
        foreach ($elements as $element) {
                    $element['children'] = $element;
        }

        return $branch;
    }


    public function getDisciplineLaw(Request $req){
        try {
            // return $req->id;
            $lawtable = DB::table("tb_discipline_law")
            ->where("articleID", "=", $req->id)->first();
          return $lawtable;
        } catch (\Throwable $th) {
           return "aldaa";
        }
    }

    public function getLawType(Request $req){
        try {
            $getLawType = DB::table("tb_discipline_type_law")->where("isDurem", "=", $req->isDurem)->get();
        return  $getLawType;

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
