<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\purchase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Middleware;
use GuzzleHttp\Client;


class PurchaseController extends Controller
{

    public function show()
    {
        $purchase = DB::table('tb_purchase')->get();
        return view('admin.pur.purchase', compact('purchase'));
    }

    public function getPurchaseData(Request $req)
      {
        try{
          $purchase = DB::table("tb_purchase")->get();
          return DataTables::of($purchase)
            ->make(true);
        }catch(\Exception $e){
          return "Алдаа!!!";
        }
      }

      public function store(Request $req)
      {
        try{
          $insertPurchase = new purchase;
          $insertPurchase->phone_number = $req->phone_number;
          $insertPurchase->money = $req->money;
          $insertPurchase->date = $req->date;
          $insertPurchase->isPurchased = 0;
          $insertPurchase->save();
          return "Амжилттай хадгаллаа";
        }catch(\Exception $e){
          return "Алдаа!!!";
        }
      }

      public function delete(Request $req)
      {
        try{
          $deletepurchase = purchase::find($req->rowID);
          $deletepurchase->delete();
          return "Амжилттай устгалаа";
        }catch(\Exception $e){
          return "Алдаа!!! ";
        }
      }

    public function add(Request $req)
    {
        $purchase = new purchase;
        $purchase->phone_number = $req->phone_number;
        $purchase->money = $req->money;
        $purchase->date = date("Y-m-d");
        $purchase->save();

        return array(
            "status" => "success",
            "msg" => "Амжилттай хадгаллаа!!!"
        );
    }

    public function checkError1(Request $req){
        return array(
            "status" => "success",

        );
    }
    public function checkError(Request $req)
    {

        $newToken = Str::random(120).time();
        $users = DB::table('tb_purchase')
            ->where('phone_number', '=', $req->phone)
            ->get();
        if (count($users) == 0) {
            return array(
                "status" => "notPAID",
                "msg" => "Та төлбөрөө төлөөгүй байна!!!"
            );
        }
        $purchasedMoney = 0;
        $isPurchased = 0;
        $phoneNumber = 0;
        $isToken = 0;
        foreach ($users as $user) {
            $purchasedMoney = $purchasedMoney + $user->money;
            $isPurchased = $user->isPurchased;
            $phoneNumber = $user->phone_number;
            $isToken = $user->isToken;
        }
        if($isToken != 0){
            return array(
                "status" => "errorLogin",
                "msg" => "Та өөр төхөөрөмжнөөс нэвтэрсэн байна!!"
            );
        }
        if ($purchasedMoney < 10) {
            return array(
                "status" => "moneyError",
                "msg" => "Та төлбөрөө дутуу төлсөн байна!!!",
                "money" => $purchasedMoney
            );
        } else {
            $this->saveLoginUser($req->phone, $newToken);
            return array(
                "status" => "success",
                "msg" => "Төлбөр төлсөн",
                "phoneNumber" => $phoneNumber,
                "newToken" => $newToken,
            );
        }
    }
    // төлбөр төлөгдсөн үед утасны дугаар нэхэмжлэхийн дугаар хадгалж байна.
    public function paidStore(Request $req){
        try {
            $newToken = Str::random(120).time();
            $purchase = new purchase;
            $purchase->phone_number = $req->phone;
            $purchase->money = 10;
            $purchase->isToken = $newToken;
            $purchase->date = date("Y-m-d");
            $purchase->save();
            return array(
                "status" => "success",
                "msg" => "Төлбөр төлсөн",
                "phoneNumber" => $req->phone,
                "newToken" => $newToken,
            );
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function saveLoginUser($phone, $newToken){
      purchase::where('phone_number', $phone)
      ->update(['isToken' => $newToken]);
    }

    public function getPurchaseInstruction(){
        $ins = DB::table("tb_purchase_instuction")
            ->where("id", "=", 1)->first();
            return $ins->instruction;
        return array(
                "status" => "success",
                "msg" => $ins->instruction
            );
    }

    public function logoutUser(Request $req){
        // return $req;
        try {
            $zero = DB::table('tb_purchase')->where("phone_number", "=", $req->phoneNumber)->get();
            foreach ($zero as $value) {
                purchase::where('phone_number', $value->phone_number)
                ->update(['isToken' => "0"]);
            }
            return array(
                "status" => "logout",
            );
        } catch (\Throwable $th) {
           return "aldaa";
        }
    }

    public function isLogid(Request $req){
        // return $req->token;
        $isCheck = DB::table('tb_purchase')->where("isToken", "=", $req->token )->get();
        if(count($isCheck) >0){
            return array(
                "status" => "TrueToken",
            );
        }else{
            return array(
                "status" => "FalseToken",
            );
        }
    }

    public function paymentCheck(Request $req){
        try {

            return $req->payment_id;
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
}
