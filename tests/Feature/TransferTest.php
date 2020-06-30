<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Wallet;
use App\Transfer;

class TransferTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPostTransfer()
    {
        $wallet = factory(Wallet::class)->create(); //Usamos el factory para crear automaticamente la informacion
        $transfer = factory(Transfer::class)->make(); //Ponemos la informacion en memoria en lugar que se ingrese la infromacion a la base de datos
        $response = $this->json('POST', '/api/transfer',[
            'description' => $transfer->description,
            'amount' => $transfer->amount,
            'wallet_id' => $wallet->id
        ]);

        $response->assertStatus(201)->assertJsonStructure([
            'id', 'description', 'amount', 'wallet_id'
        ]); //Validamos que regrese como un estado 200

        $this->assertDatabaseHas('transfers', [ //Validamos que se inserto bien esos registros en la base de datos
            'description' => $transfer->description,
            'amount' => $transfer->amount,
            'wallet_id' => $wallet->id,
        ]);

        $this->assertDatabaseHas('wallets',[
            'id' => $wallet->id,
            'money' => $wallet->money + $transfer->amount,
        ]);//Validamos la cantidad de dinero
    }
}
