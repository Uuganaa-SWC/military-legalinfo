<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use APP\Models\AndroidTitles;
class MilitaryRuleController extends Controller
{
    public function getMilitaryRule(Request $req){
        try {
            $militaryTitle = DB::table('android_title')->where("id", "=", $req->id)->first();
            $militaryRuleData = DB::table('android_data')
            ->where("duremID", "=",$militaryTitle->duremID)
            ->where("bulegID", "=", $militaryTitle->bulegID)
            ->first();
            return $militaryRuleData;
        } catch (\Throwable $th) {
            return array(
                "status" => "error",
                "msg" => "Алдаа гарлаа",
            );
        }

    }



    public function getTitles(Request $req){
        try {
            $quw = DB::table("android_title")
            ->where("android_title.duremID", "=", $req->id)
            ->leftJoin('android_test', function($join)
            {
                $join->on('android_test.bulegID', '=', 'android_title.bulegID');
                $join->on('android_test.duremID', '=', 'android_title.duremID');
            })
            ->select("android_title.name", "android_title.id","android_title.bulegID",DB::raw("count(android_test.bulegID) as count"))
            ->groupBy("android_title.id", "android_title.name", "android_title.bulegID")
            ->get();
            return $quw;

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getByDuremBulegQuestions(Request $req){
        try {
            $questions = DB::table("android_test")
            ->where("duremID", "=", $req->duremID)
            ->where("bulegID", "=", $req->bulegID)
            ->select("android_test.*")
            ->get();
            return $questions;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
