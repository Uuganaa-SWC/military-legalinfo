<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Models\purchase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Middleware;
use GuzzleHttp\Client;
use Illuminate\Support\stringify;
use App\Models\QpayToken;
use App\Models\TB_Callback;

class AppPurchaseController extends Controller
{

    public function callBackIsPuchaseFirst(Request $req){
        $getCheckCallBack = DB::table("tb_my_callbacks")
        ->where("senderInvoiceNo", "=", $req->ourInvoiceNo)
        ->where("invoiceID", "=", $req->payment_id)->first();
        if($getCheckCallBack->isPaid === "PAID"){
            $newToken = Str::random(120).time();
            $checkPhone = DB::table("tb_purchase")->where("phone_number", "=", $req->phoneNumber)->get();
        if(count($checkPhone) <= 0){
        $addNewUser = new purchase;
        $addNewUser->phone_number = $req->phoneNumber;
        $addNewUser->isToken = $newToken;
        $addNewUser->date = date("Y-m-d");
        $addNewUser->save();
        return array(
                "payment_status" => "PAID",
                "phoneNumber"=>$req->phoneNumber,
                "newToken" => $newToken,
                "msg" => "Төлбөр амжилттай төлөгдлөө."
            );
        }
        }else{
            return array(
                "msg" => "Төлбөр төлөгдөөгүй байна."
            );
        }
    }
    public function callBackIsPuchase($sender_invoice_no){
        DB::table("tb_my_callbacks")->where("senderInvoiceNo", "=", $sender_invoice_no)
        ->update(["isPaid" => "PAID"]);
        return response( array(
                "status" => "SUCCESS",
        ),200);
    }

    public function firstRequestFromApp(Request $req){
        // return $req->phone;
      return $this->checkPurches($req->phone);
    }

    public function qpayGetToken()
    {
        $client = new Client();
        $credentials = base64_encode('TSAH_ERHZUI:2221exkp');
        $response = $client->request('POST','https://merchant.qpay.mn/v2/auth/token', ['headers' => [
                        'Authorization' => ['Basic '.$credentials]
                    ]
        ]);
        $json = json_decode($response->getBody());
        return $json->access_token;
    }

    public function checkPurches($phone){
        $newToken = Str::random(120).time();
        $phoneMyNumber = 0;
        $isToken = 0;
        $users = DB::table('tb_purchase')
            ->where('phone_number', '=', $phone)
            ->get();
        if (count($users) == 0) {
            $getMyToken = DB::table("tb_qpay_token")->first();
        if(strtotime(date("Y-m-d h:i:s"))-strtotime($getMyToken->qpayDate) > 86400){
             $qpayAccessToken = $this->qpayGetToken();
             $getMyToken = QpayToken::where("id", "=", 1)->update(['qpayToken' => $qpayAccessToken,'qpayDate' => date("Y-m-d h:i:s")]);
           return  $this->createInvoice($qpayAccessToken, $phone);
        }else{
           return $this->createInvoice($getMyToken->qpayToken, $phone);
        }
        }

        foreach ($users as $user) {
            $isToken = $user->isToken;
            $phoneMyNumber = $user->phone_number;
        }
        if($isToken != 0){
            return array(
                "status" => "errorLogin",
                "msg" => "Та өөр төхөөрөмжнөөс нэвтэрсэн байна!!"
            );
        }else{
             $this->saveLoginUserPurchesed($phoneMyNumber, $newToken);
            return array(
                "status" => "success",
                "msg" => "Төлбөр төлсөн",
                "phoneNumber" => $phoneMyNumber,
                "newToken" => $newToken,
            );
        }
    }

    public function saveLoginUserPurchesed($phoneMyNumber, $newToken){
      purchase::where('phone_number', $phoneMyNumber)
      ->update(['isToken' => $newToken]);
    }

    public function createInvoice($token, $phone)
    {
        $our_sender_invoice_no = date("Y-m-d-h:i:s-").Str::lower(Str::random(10)).rand(5,99);
        $client = new Client();
        $response = $client->request('POST','https://merchant.qpay.mn/v2/invoice', [
            'headers' => [
                        'Authorization' => ['Bearer '.$token],
            ],
            'form_params' =>[
                "invoice_code" => "TSAH_ERHZUI_INVOICE",
			   "sender_invoice_no" => $our_sender_invoice_no,
			   "invoice_receiver_code" => $phone,
			   "invoice_description" => $phone,
			   "amount" => 2500,
			   "callback_url" => "https://military.gsmaf.gov.mn/api/callback/check/".$our_sender_invoice_no,
            ]
        ]);

        $json = json_decode($response->getBody());
                $addMyCallBack = new TB_Callback;
                $addMyCallBack->phoneNumber = $phone;
                $addMyCallBack->invoiceID = $json->invoice_id;
                $addMyCallBack->senderInvoiceNo = $our_sender_invoice_no;
                $addMyCallBack->callBackDate = date("Y-m-d h:i:s");
                $addMyCallBack->save();
             return array(
                "status" => "notPAID",
                "msg" => 'Та төлбөрөө төлөөгүй байна!!!',
                "msgQpay" => "Та төлбөрөө дараах банкнуудаас сонгон Qpay ашиглан төлөх боломжтой.",
                "invoice_id" => $json->invoice_id,
                "our_sender_invoice_no" => $our_sender_invoice_no,
                "urls" => $json->urls,
            );
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

    public function qpayDeleteToken($payment_id)
    {
        $getMyToken = DB::table("tb_qpay_token")->first();
        $client = new Client();
        $response = $client->request('POST','https://merchant.qpay.mn/v2/invoice',
                    ['headers' => [
                        'Authorization' => ['Bearer '.$getMyToken->qpayToken],
                        'form_params' =>[
                            "invoice_code" => "TSAH_ERHZUI_INVOICE",
                            "invoice_id" => $payment_id,
                            "sender_invoice_no" => "1234567",
                            "invoice_receiver_code" => "terminal",
                            "invoice_description" => "66666666",
                            "amount" => 10,
                            "callback_url" => "https://bd5492c3ee85.ngrok.io/payments?payment_id=1234567"
                            ]
                    ]
        ]);
        $json = json_decode($response->getBody());
        return $json;
    }

    public function myCheck(){
        $client = new Client();
        $response = $client->request('POST','https://merchant.qpay.mn/v2/payment/check', [
            'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => ['Bearer '. "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjbGllbnRfaWQiOiJhZmY1ZjVmMi1jYWQ5LTQ1MDAtOTQwOS0wMTEzOGUyZDUxMzYiLCJzZXNzaW9uX2lkIjoiUVVULWdsQlhxbldmSHBKY0hZdGxJVXRsUWJMNEZHZDgiLCJpYXQiOjE2NTk0ODcyMDcsImV4cCI6MzMxOTA2MDgxNH0.kqRME1yvPIa6z3p0hk5hpHtDN7eqtpIpyHx2enpnDKA"],
            ],
            'form_params' =>[
                "object_type" => "INVOICE",
			   "object_id" => "2022-08-03-07:27:58-p0tqhrpcia35",
            //    "sender_invoice_no" => "2022-08-03-07:27:58-p0tqhrpcia35",
			   "offset" =>[
                'page_number'=>1,
                'page_limit'=>100,
               ]
            ]
        ]);
        $json = json_decode($response->getBody());
        return $json;
    }
}
