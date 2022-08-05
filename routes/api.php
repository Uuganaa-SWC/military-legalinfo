<?php

use App\Http\Controllers\AppPurchaseController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\InstructionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MilitaryRuleController;
use App\Models\DisciplineLaw;
use App\Models\MilitaryRuleData;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/test/purchase", [PurchaseController::class, "add"]);
Route::post("/check/purchase", [PurchaseController::class, "checkError"]);
Route::get("/get/purchase/instruction", [PurchaseController::class, "getPurchaseInstruction"]);
Route::get("/get/ashiglah/zaavar", [InstructionController::class, "getAshiglahZaavar"]);
Route::get("/get/contact", [InstructionController::class, "getContact"]);

Route::get("/payment", [PurchaseController::class, "paymentCheck"]);
Route::post("/paid/store", [PurchaseController::class, "paidStore"]);


// Route::get("/app/check/purchase/{phone}", [AppPurchaseController::class, "firstRequestFromApp"]);

Route::post("/app/check/purchase", [AppPurchaseController::class, "firstRequestFromApp"]);
Route::get("/callback/check/{invoice_id}", [AppPurchaseController::class, "callBackIsPuchase"]);
Route::post("/callback/check/first", [AppPurchaseController::class, "callBackIsPuchaseFirst"]);

Route::get("/payment/delete/{payment_id}", [AppPurchaseController::class, "qpayDeleteToken"]); // туршиж үзсэн ажилаагүй

// Ашиглах заавар зургаар авж байна
Route::get("/instructions/images", [InstructionController::class, "getInstractionsImages"]);
Route::get("/payment/images", [InstructionController::class, "getPaymentImages"]);

Route::get("/myCheck", [AppPurchaseController::class, "myCheck"]);










// contactMain
// ashiglahMain

Route::post("/check/purchase/test", function(){
    return "AAA";
});

// get/military/rule
Route::post("/get/military/rule", [MilitaryRuleController::class, "getMilitaryRule"]);

// get json discipline article
Route::get("/get/discipline/article", [DisciplineController::class, "getAricleJson"]);

// Дүрэм журам харах хэсгийн Expandable list View харуулхад дээд цэснээс id аваад буцааж байна.
Route::post("/get/discipline/article/expandable", [DisciplineController::class, "getAricleExpandable"]);


// Батлан хамгаалах, Зэвсэгт хүчний тухай хууль
Route::post("/get/law/type", [DisciplineController::class, "getLawType"]);
Route::post("/get/discipline/law", [DisciplineController::class, "getDisciplineLaw"]);

// logout
Route::post("/logout", [PurchaseController::class, "logoutUser"]);

//is logid
Route::post("/check/login", [PurchaseController::class, "isLogid"]);

// дадлыгын тест title харуулах
Route::post("/get/titles", [MilitaryRuleController::class, "getTitles"]);
Route::post("/get/questions/by/durem/buleg", [MilitaryRuleController::class, "getByDuremBulegQuestions"]);
