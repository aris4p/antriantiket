<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Events\TampilAntrian;
use App\Models\Daftarantrian;
use App\Models\Antrianselesai;
use App\Models\Currentantrian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    public function index(){
        if(Auth::user()->role == "teller"){
            $antrian = Antrian::where('type_antrian', "teller")
            ->where('status', 0)
            ->get();
        }
        if(Auth::user()->role == "customer_service"){
            $antrian = Antrian::where('type_antrian', "customer_service")
            ->where('status', 0)
            ->get();
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
            'status' => 0
        ];

        $antrian = Antrian::create($data);

        return response()->json([
            'message'=> "success",
            'data'=> $antrian
        ]);
    }

    public function getAntrian(Request $request){

        $validasi = Daftarantrian::with('user','antrian')
        ->where('user_id', auth()->user()->id)
        ->count();

        if($validasi > 0){
            return response()->json([
                'status' => false,
                'message' => 'Anda masih memiliki antrian yang aktif'
            ], 400);
        }

        $data = [
            'antrian_id' => $request->input('antrian_id'),
            'user_id' => $request->input('user_id'),

        ];

       

        

        $daftarantrian = Daftarantrian::with('antrian','user')->create($data);

        if($daftarantrian){
          $antrian =  Antrian::where('id', $request->antrian_id);
          $antrian->update(['status' => 1]);
        }

        

        $datakirim = [
            'kode_antrian' => $daftarantrian->antrian->kode_antrian,
            'type_antrian' => $daftarantrian->antrian->type_antrian,
            'loket_antrian' => $daftarantrian->user->loket,

        ];

        TampilAntrian::dispatch($datakirim);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil ambil antrian'
        ]);
    }

    public function currentantrian(){
        
        

        $currentAntrian = Daftarantrian::with('user','antrian')
        ->where('user_id', auth()->user()->id)
        ->first();
        
        
        

        return view('antrian.currentantrian', [
            'title' => 'Antrian saat ini'
        ], compact('currentAntrian'));
    }

    public function antrianselesai(Request $request){

        // dd($request->all());
        $data = [
            'antrian_id' => $request->input('antrian_id'),
            'status' => $request->input('status')
        ];

        $antrianselesai = Antrianselesai::create($data);

        if($antrianselesai){
            Daftarantrian::find($request->antrian_id)->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'berhasil'
        ]);
    }
}
