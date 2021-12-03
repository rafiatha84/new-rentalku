<?php

namespace Tests\Unit;

use Tests\TestCase;

class SendMessageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $value=[
            'user_id' => '4',
            'room_id' => '1',
            'message' => 'Pesan test'
        ];
        $this->post(route('api.message.send'), $value)->assertStatus(201);
    }
}
