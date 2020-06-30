<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
class WalletController extends Controller
{
    public function index(){
        $wallet = Wallet::firstOrFail(); //Buscamos el promer registro de la base de datos
        return response()->json($wallet->load('transfers'), 200); //Cargamos el transfer con el protocolo 200
    }
}
