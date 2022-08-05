<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Instruction;

use Illuminate\Http\Request;

class InstructionController extends Controller
{
    public function getInstractionsImages(){
        $getImages = DB::table("tb_ashiglahzaawar_img")->get();
        return $getImages;
    }

    public function getPaymentImages(){
        $getImages = DB::table("tb_payment_instructions")->get();
        return $getImages;
    }
    public function seeInstruction(){
        $instructions = DB::table("tb_purchase_instuction")->first();
        return view("layouts.instruction", compact("instructions"));
    }


    public function editInstruction(Request $req){
        try {
            $durems = DB::table("tb_purchase_instuction")
                ->where("id", $req->id)
                ->update(["instruction"=> $req->instruction]);
            return array(
                "status" => "alertify.success",
                "msg" => "Амжилттай заслаа"
            );
        }
        catch (\Throwable $th) {
            return array(
                "status" => "alertify.error",
                "msg" => "Алдаа гарлаа !!"
            );
        }
    }


     public function seeAshiglahZaawar(){
        $ashiglah = DB::table("tb_ashiglahzaawar")->first();
        return view("layouts.ashiglahZaawar", compact("ashiglah"));
    }

        public function editAshiglahZaawar(Request $req){
        try {
            $zaawar = DB::table("tb_ashiglahzaawar")
                ->where("id", $req->id)
                ->update(["ashiglahMain"=> $req->ashiglahMain]);
            return array(
                "status" => "alertify.success",
                "msg" => "Амжилттай заслаа"
            );
        }
        catch (\Throwable $th) {
            return array(
                "status" => "alertify.error",
                "msg" => "Алдаа гарлаа !!"
            );
        }
    }

    public function getAshiglahZaavar(Request $req){
        try {
            $ins = DB::table("tb_ashiglahzaawar")
            ->where("id", "=", 1)->first();
            return $ins->ashiglahMain;
        } catch (\Throwable $th) {
            return array(
                "status" => "alertify.error",
                "msg" => "Алдаа гарлаа !!"
            );
        }
    }

        public function getContact(Request $req){
        try {
            $ins = DB::table("tb_contacts")
            ->where("id", "=", 1)->first();
            return $ins->contactMain;
        } catch (\Throwable $th) {
            return array(
                "status" => "alertify.error",
                "msg" => "Алдаа гарлаа !!"
            );
        }
    }

    public function seeContacts(){
        $contacts = DB::table("tb_contacts")->first();
        return view("layouts.contacts", compact("contacts"));
    }

        public function editContacts(Request $req){
        try {
            $contacts = DB::table("tb_contacts")
                ->where("id", $req->id)
                ->update(["contactMain"=> $req->contactMain]);
            return array(
                "status" => "success",
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
