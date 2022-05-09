<?php

use App\Company;
use App\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (!Company::exists()) {
            $users = User::all();

            foreach ($users as $user) {
                factory(Company::class, 3)->create([
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
