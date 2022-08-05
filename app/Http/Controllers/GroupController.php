<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Group;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showGroup(){
        $durems = DB::table("duremuud")->get();
        $android_title = DB::table("android_title")->get();
        return view("layouts.group_table", compact("durems", "android_title"));
    }

    public function showGroupTable(Request $req){
        $showGroupTable = DB::table("android_title")
        ->select('android_title.*', 'duremuud.bulegNer' )
        ->Join('duremuud', 'android_title.duremID', '=', 'duremuud.id')
        ->get();
        return DataTables::of($showGroupTable)
        ->make(true);
    }

    public function storeGroups(Request $req){
        try {
            $bulegMaxId = DB::table("android_title")->where("duremID", $req->duremID)->max("bulegID");

            $dvremStore = new Group();
            $dvremStore->duremID = $req->duremID;
            $dvremStore->bulegID = $bulegMaxId+1;
            $dvremStore->name = $req->name;
            $dvremStore->save();

            return response(
                array(
                    "status" => "alertify.success",
                    "msg" => "Амжилттай хадгаллаа !!"
                ),
            );
        } catch (\Throwable $th) {
            return response(
                array(
                    "status" => "alertify.error",
                    "msg" => "Алдаа гарлаа !!"
                ),
            );
        }
    }

    public function groupDelete(Request $req){
        try{
            $ruleDelete = Group::find($req->id);
            $ruleDelete-> delete();
            return array(
                "status" => "success",
                "msg" => "Амжилттай устгалаа"
            );
        }catch(\Exception $th){
            return array(
                "status" => "error",
                "msg" => "Алдаа гарлаа!!"
            );
        }
    }

    public function groupEdit(Request $req){
        try {
            $rule = Group::find($req->id);
            $rule->duremID = $req->duremID;
            $rule->bulegID = $req->bulegID;
            $rule->name = $req->name;
            $rule->save();
            return array(
                "status" => "alertify.success",
                "msg" => "Амжилттай заслаа"
            );
        }
        catch (\Throwable $th) {
            return array(
                "status" => "error",
                "msg" => "Алдаа гарлаа !!"
            );
        }
    }


    public function selectGroupDurem(Request $req){
        try {
            $durems = DB::table("android_title")
            ->where("duremID", "=", $req->id)->get();
            return $durems;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
