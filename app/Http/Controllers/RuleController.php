<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Rule;

use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showRule(){
        return view("layouts.rule_table");
    }

    public function showRuleTable(Request $req){
        $showRuleTable = DB::table("duremuud")
            ->get();
        return DataTables::of($showRuleTable)
        ->make(true);
    }

    public function ruleDelete(Request $req){
        try{
            $ruleDelete = Rule::find($req->id);
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

    public function storeRules(Request $req){
        try {
            $dvremStore = new Rule();
            $dvremStore->bulegNer = $req->bulegNer;
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

    public function ruleEdit(Request $req){
        try {
            $rule = Rule::find($req->id);
            $rule->bulegNer = $req->bulegNer;
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
}
