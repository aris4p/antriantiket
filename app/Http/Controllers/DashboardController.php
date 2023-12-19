<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index(){
        return view('master.index',[
            'title' => "Dashboard"
        ]);
    }
    
    public function loket(Request $request){
        $data = [
            'loket' => $request->input('value'),
        ];
        $loket =  User::find(auth()->user()->id);
        $uniqueLokets = User::pluck('loket')->toArray();
        
        if(in_array($data['loket'], $uniqueLokets)){
            return response()->json([
                'status' => false,
                'message' => "Loket tidak tersedia"
            ], 400);
        }

        $loket->update($data);
        
        return response()->json([
            'status' => true,
            'message' => 'Berhasil'
        ]);
    }
}
