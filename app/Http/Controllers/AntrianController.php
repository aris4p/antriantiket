<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Daftarantrian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    public function index(){
        if(Auth::user()->role == "teller"){
            $antrian = Antrian::where('type_antrian', "teller")->get();
        }
        if(Auth::user()->role == "customer_service"){
            $antrian = Antrian::where('type_antrian', "customer_service")->get();
        }


        return view('antrian.index',[
            'title'=>"Antrian"
        ], compact('antrian'));
    }

    public function create(Request $request){
        if($request->category == "A"){
            $type_antrian = "customer_service";
        }else{
            $type_antrian = "teller";
        }

        $data = [
            'kode_antrian' => $request->input('ticket_number'),
            'type_antrian' => $type_antrian,
        ];

        $antrian = Antrian::create($data);

        return response()->json([
            'message'=> "success",
            'data'=> $antrian
        ]);
    }

    public function getAntrian(Request $request){

        $data = [
            'antrian_id' => $request->input('antrian_id'),
            'user_id' => $request->input('user_id'),
        ];

        $daftarantrian = Daftarantrian::create($data);

        if($daftarantrian){
          $antrian =  Antrian::where('id', $request->antrian_id);
          $antrian->delete();
        }

        return response()->json([
            'status' => true,
            'message' => $daftarantrian
        ]);
    }
}
