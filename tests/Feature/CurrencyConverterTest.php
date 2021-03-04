<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrencyConverterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetResponseStatusOkWithCorrectJsonStructure()
    {
        $response = $this->get('/api/convert?access_key=API_KEY&from=USD&to=IDR&amount=1');
        $response->assertStatus(200)
            ->assertJsonStructure(  [ 'success'
                                    , 'query' =>    [ 'from'
                                                    , 'to'
                                                    , 'amount'
                                                    ]
                                    , 'info' => [ 'timestamp'
                                                , 'rate'
                                                ]
                                    , 'historical'
                                    , 'date'
                                    , 'result'
                                    ]
                                );
    }

    public function testValidationFailWithoutParameters()
    {
        $response = $this->get('/api/convert');
        $response->assertStatus(302);
    }
}
