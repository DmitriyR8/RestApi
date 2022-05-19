<?php

namespace Tests\Feature;

use App\User;
use TestCase;

class RegisterTest extends TestCase
{
    /**
     * Register endpoint test
     *
     * @return void
     */
    public function testRegister(): void
    {
        $user = factory(User::class)->make();

        $response = $this->post('api/user/register',[
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => $user->password,
            'phone' => $user->phone
        ]);

        $response->seeJsonContains(['message' => 'User created successfully.'])
            ->seeStatusCode(200);
    }
}
