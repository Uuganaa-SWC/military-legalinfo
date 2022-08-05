<?php

use App\Http\Controllers\DisciplineLawArticleController;
use App\Http\Controllers\DisciplineLawController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\SoldierController;
use App\Http\Controllers\UserRegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('layouts.login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Soldier controller route
Route::get("/show/soldier", [SoldierController::class, "Soldier"]);
Route::get("show/dvrem", [SoldierController::class, "showDvrem"]);
Route::get('/dvrem/delete', [SoldierController::class, "DvremDelete"]);
Route::get('/new/dvrem', [SoldierController::class, "newDvrem"]);
Route::post('/dvrem/store', [SoldierController::class, "storeDvrem"]);

Route::post('/get/buleg',  [SoldierController::class, "getdurem"]);


// 'DisciplineLawArticleController@showArticleView'

// START discipline android project
Route::get('/discipline/law/articles/show',[DisciplineLawArticleController::class, "showArticleView"])->middleware('auth');
Route::get('/discipline/law/articles/show/{lawID}', [DisciplineLawArticleController::class, "showArticleViewByLawID"])->middleware('auth');
Route::post('/discipline/law/articles/new', [DisciplineLawArticleController::class, "store"])->middleware('auth');
Route::post('/discipline/law/articles/delete', [DisciplineLawArticleController::class, "delete"])->middleware('auth');
Route::post('/get/discipline/law/articles', [DisciplineLawArticleController::class, "getParentArticlesAjax"])->middleware('auth');
Route::post('/get/discipline/law/child/articles', [DisciplineLawArticleController::class, "getChildArticlesAjax"])->middleware('auth');




Route::get('/discipline/law/law/show', [DisciplineLawController::class , "showLawView"])->middleware('auth');
Route::post('/discipline/law/law/new',  [DisciplineLawController::class , "store"])->middleware('auth');
Route::post('/discipline/law/law/delete',  [DisciplineLawController::class , "showLawView"])->middleware('auth');
Route::post('/discipline/load/law',  [DisciplineLawController::class , "loadlaw"])->middleware('auth');

Route::get('/disciple/all/article', [DisciplineLawArticleController::class, "getAllArticle"]);
Route::get('/disciple/all/law', [DisciplineLawController::class , "getAllLaw"]);
// END discipline android project

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Soldier controller routes
Route::get("/show/soldier", [SoldierController::class, "Soldier"]);
Route::get("/show/dvrem", [SoldierController::class, "showDvrem"]);
Route::get('/dvrem/delete', [SoldierController::class, "DvremDelete"]);
Route::get('/new/dvrem', [SoldierController::class, "newDvrem"]);
Route::post('/dvrem/store', [SoldierController::class, "storeDvrem"]);
Route::get('/dvrem/edit/{id}', [SoldierController::class, "dvremEdit"]);
Route::post('/durem/editStore', [SoldierController::class, "editDuremStore"]);

// military rule edit start
Route::post("/select/durem", [SoldierController::class, "selectDurem"]);
Route::post("/select/input", [SoldierController::class, "selectInputDurem"]);
// military rule edit end

// Rule controller routes
Route::get("/show/rule", [RuleController::class, "showRule"]);
Route::get("/rules/table", [RuleController::class, "showRuleTable"]);
Route::get('/rules/delete', [RuleController::class, "ruleDelete"]);
Route::post('/rules/store', [RuleController::class, "storeRules"]);
Route::post('/edit/store', [RuleController::class, "ruleEdit"]);

// Group controller routes
Route::get("/show/group", [GroupController::class, "showGroup"]);
Route::get("/group/table", [GroupController::class, "showGroupTable"]);
Route::post("/group/store", [GroupController::class, "storeGroups"]);
Route::get("/group/delete", [GroupController::class, "groupDelete"]);
Route::post("/group/edit", [GroupController::class, "groupEdit"]);


// Instruction controller routes
Route::get("/show/instruction", [InstructionController::class, "seeInstruction"]);
Route::post("/edit/instruction", [InstructionController::class, "editInstruction"]);

Route::post("/check/purchase1", [PurchaseController::class, "checkError1"]);

// Ashiglah zaawar
Route::get("/show/zaawar", [InstructionController::class, "seeAshiglahZaawar"]);
Route::post("/edit/zaawar", [InstructionController::class, "editAshiglahZaawar"]);


// User bvrtgeh
Route::get("/show/userTable", [UserRegisterController::class, "showGroup"]);
Route::get("/userRegister/delete", [UserRegisterController::class, "deleteUser"]);
Route::post("/new/userRegister", [UserRegisterController::class, "newUserRegister"]);
Route::get("/show/table/user", [UserRegisterController::class, "showUserRegister"]);
Route::post("/edit/table/user", [UserRegisterController::class, "editUserregister"]);

// Холбоо барих
Route::get("/contacts/show", [InstructionController::class, "seeContacts"]);
Route::post("/edit/contact", [InstructionController::class, "editContacts"]);

// History
Route::get("/show/historyTable", [UserRegisterController::class, "showHistory"]);
Route::get("/show/table/history", [UserRegisterController::class, "showUserTable"]);
Route::get("/userHistory/delete", [UserRegisterController::class, "historyDelete"]);
