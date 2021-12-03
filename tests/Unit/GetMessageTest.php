<?php

namespace Tests\Unit;

use Tests\TestCase;

class GetMessageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $value=[
            'room_id' => 1
        ];
        $this->get(route('api.message.byroom'), $value)->assertStatus(200);
    }
}
