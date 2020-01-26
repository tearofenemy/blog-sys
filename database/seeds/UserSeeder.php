<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();


        if (env('APP_ENV') === 'local') {
            $faker = Faker\Factory::create();
            DB::table('users')->insert([
                [
                    'name' => 'John Doe',
                    'slug' => 'john-doe',
                    'email' => 'john@de.com',
                    'password' => bcrypt('john')
                ],
                [
                    'name' => "Kate Morison",
                    'slug' => 'kate-morison',
                    'email' => 'kate@mr.com',
                    'password' => bcrypt('kate')
                ],
                [
                    'name' => 'Mike Loris',
                    'slug' => 'mike-loris',
                    'email' => 'mike@lr.com',
                    'password' => bcrypt('mike')
                ],
                [
                    'name' => 'Admin User',
                    'slug' => 'admin-user',
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('admin')
                ]
            ]);
        } else {
            DB::table('users')->insert([
                'name' => 'Administrator',
                'slug' => 'administrator',
                'email' => 'admin@prod.com',
                'password' => bcrypt('administrator')
            ]);
        }
    }
}