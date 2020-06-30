<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Wallet;
use App\Transfer;

class WalletTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetWallet()
    {
        $wallet = factory(Wallet::class)->create(); //Usamos el factory para generar informacion e insertarlo en la db
        $transfers = factory(Transfer::class, 3)->create([
            'wallet_id' => $wallet->id //Sustituimos el id generado por el id del elemento generado
        ]); //Creamos tres veces la informacion para el transfer


        $response = $this->json('GET', '/api/wallet'); //Validamos que se haga una paticiion get y que exista la ruta
        $response->assertStatus(200) //Valida que llegue un estado 200
                ->assertJsonStructure([ //Validamos la estructura del json
                        'id', 'money', 'transfers' => [
                                            '*' => [ //Que contenga cualquier contenido
                                                'id', 'amount', 'description', 'wallet_id' //Con estos atributos
                                        ]
                                    ]
                    ]); //Valida la estructura del json


        $this->assertCount(3, $response->json()['transfers']); //Probamos cuantos transfers se han retornado y validamos que el response contengan los 3 elementos
    }
}
