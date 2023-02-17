<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        if (App::environment() !== 'local') {
            die("In production environment you can not seed the database");
        }

        $truncate = [
            'users',
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        foreach ($truncate as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');


        User::create([
            'email' => 'labs@cascus.net',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'phone' => '123456789',
            'address' => 'admin address',
            'password' => bcrypt('cascus'),
            'role' => 1,
        ]);


    }
}
