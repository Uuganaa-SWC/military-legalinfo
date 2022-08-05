<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\UserRegister;
use App\Models\History;

class UserRegisterController extends Controller
{
    public function showGroup(){
        $userRegister = DB::table("tb_purchase")->get();
        return view("layouts.userNew.userTable", compact("userRegister"));
    }

        public function deleteUser(Request $req){
        try{
            $ruleDelete = UserRegister::find($req->id);
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

        public function newUserRegister(Request $req)
        {
            try{
                $insertPurchase = new UserRegister;
                $insertPurchase->phone_number = $req->phone_number;
                $insertPurchase->money = $req->money;
                $insertPurchase->date = $req->date;
                $insertPurchase->isToken = 0;
                $insertPurchase->tailbar = $req->tailbar;
                $insertPurchase->save();
                return array(
                    "status" => "success",
                    "msg" => "Амжилттай"
                );
            }catch(\Exception $th){
            return array(
                "status" => "error",
                "msg" => "Алдаа гарлаа!!"
            );
        }
        }

        public function showUserRegister(Request $req){
            $showUserRegister = DB::table("tb_purchase")->get();
            return DataTables::of($showUserRegister)
            ->make(true);
    }

    public function editUserregister(Request $req){
        {
            try{
                $editPurchase = UserRegister::find($req->id);
                $editPurchase->phone_number = $req->phone_number;
                $editPurchase->money = $req->money;
                $editPurchase->date = $req->date;
                $editPurchase->isToken = $req->isToken;
                $editPurchase->tailbar = $req->tailbar;
                $editPurchase->save();
                return array(
                    "status" => "success",
                    "msg" => "Амжилттай зассан"
                );
            }catch(\Exception $th){
            return array(
                "status" => "error",
                "msg" => "Алдаа гарлаа!!"
            );
        }
        }
    }

        public function showHistory(){
        $userHistory = DB::table("tb_my_callbacks")->get();
        return view("layouts.history", compact("userHistory"));
    }

        public function showUserTable(Request $req){
        $showUserTable = DB::table("tb_my_callbacks")->get();
        return DataTables::of($showUserTable)
        ->make(true);
    }

            public function historyDelete(Request $req){
        try{
            $ruleDelete = History::find($req->id);
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
}
