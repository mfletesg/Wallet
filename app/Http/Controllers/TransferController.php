<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transfer;
use App\Wallet;
class TransferController extends Controller
{
    public function store(Request $request){

        $wallet = Wallet::find($request->wallet_id); //Buscamos un nuevo registro
        $wallet->money = $wallet->money + $request->amount; //Modificamos el dinero
        $wallet->update(); //Lo actualizamos en la base de datos

        $transfer = new Transfer();
        $transfer->description = $request->description;
        $transfer->amount = $request->amount;
        $transfer->wallet_id = $request->wallet_id;
        $transfer->save(); //Guardamos en la base de datos

        return response()->json($transfer, 201);
    }
}
