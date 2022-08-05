<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Soldier;

use Illuminate\Http\Request;

class SoldierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Soldier(){
        return view("layouts.soldier");
        $durem = DB::table('android_data')->get();
        $title = DB::table('android_title')->get();
        $duremuud = DB::table('duremuud')->get();
        return view("layouts.soldier", compact("durem", "title", "duremuud"));
    }



    public function showDvrem(Request $req){
        $dvremTable = DB::table("android_data")
        ->Join('duremuud', 'android_data.duremID', '=', 'duremuud.id')
        ->Join('android_title', 'android_data.bulegID', '=', 'android_title.id')
        ->select('android_data.*', 'android_title.name', 'duremuud.bulegNer' )
            ->get();
        return DataTables::of($dvremTable)
        ->make(true);
    }

    // dvrem oruulax blade
    public function newDvrem(Request $req){
        $dvrems = DB::table("duremuud")->get();
        $bulegs = DB::table("android_title")
        ->where("duremID", '=', $req->id)
        ->get();
        return view("layouts.dvrem_nemex", compact("dvrems", "bulegs"));
    }
    // medee edit blade
    public function medeeEdit($id){
        $medee = DB::table('news_table')->where("news_table.id", "=", $id)->first();
        return view("layouts.medee_zassax", compact("medee", "id"));
    }





    public function storeDvrem(Request $req){
        // try {
        try {
            $dvremStore = new Soldier();
            $dvremStore->duremID = $req->duremID;
            $dvremStore->bulegID = $req->bulegID;
            $dvremStore->mainInfo = $req->mainInfo;
            $dvremStore->save();

            return response(
                array(
                    "status" => "alertify.success",
                    "msg" => "Амжилттай хадгаллаа !!"
                ),
            );
        // } catch (\Throwable $th) {
        //     return response(
        //         array(
        //             "status" => "alertify.error",
        //             "msg" => "Алдаа гарлаа !!"
        //         ),
        //     );
        // }
        } catch (\Throwable $th) {
            return response(
                array(
                    "status" => "alertify.error",
                    "msg" => "Алдаа гарлаа !!"
                ),
            );
        }
    }


    // Delete dvrem function
    public function DvremDelete(Request $req){
        try{
            $deleteDvrem = DB::table("android_data")->where("idid", $req->id);
            $deleteDvrem-> delete();
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


    public function getdurem(Request $req){
        $soldiers = DB::table('android_title')
        ->where('duremID', '=', $req->id)
        ->get();
    return $soldiers;

    }





// // Edit function
//     public function editStore(Request $req){
//         try {
//             $medeelels = Soldier::find($req->id);
//             $medeelels->title = $req->title;
//             $medeelels->image = $req->image;
//             $medeelels->about = $req->about;
//             $medeelels->save();
//             return array(
//                 "status" => "alertify.success",
//                 "msg" => "Амжилттай заслаа"
//             );
//         }
//         catch (\Throwable $th) {
//             return array(
//                 "status" => "alertify.error",
//                 "msg" => "Алдаа гарлаа !!"
//             );
//         }
//     }


    public function dvremEdit(Request $req){
        $ID = $req->id;

        $androidData = DB::table('android_data')->where("idid", "=", $req->id)->first();

        $selectedBuleg = DB::table("android_title")
        ->where("duremID", "=", $androidData->duremID)
        ->where("bulegID", "=", $androidData->bulegID)->first();
        $bulegs = DB::table("android_title")->where("duremID", $androidData->duremID)->get();

        $dvrems = DB::table("duremuud")->get();
        $selectedDvrem = DB::table("duremuud")->where("id", $androidData->duremID)->first();
        return view("layouts.durem_zassax", compact("selectedDvrem","dvrems", "bulegs","selectedBuleg",  "androidData", "ID"));
    }


// Edit function
    public function editDuremStore(Request $req){
        try {
            $durems = DB::table("android_data")
                ->where("idid", $req->id)
                ->update(["duremID"=> $req->duremID, "bulegID"=> $req->bulegID, "mainInfo"=> $req->mainInfo ]);
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

    public function selectDurem(Request $req){
        try {
            $bulegs = DB::table("android_title")
            ->where("duremID", "=", $req->id)->get();
            return $bulegs;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function selectInputDurem(Request $req){
        try {
            $bulegs = DB::table("android_title")
            ->where("duremID", "=", $req->id)->get();
            return $bulegs;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
