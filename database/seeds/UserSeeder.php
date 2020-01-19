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
        $faker = Faker\Factory::create();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();

        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'slug' => 'john-doe',
                'bio' => $faker->text(6, 12),
                'email' => 'john@de.com',
                'password' => bcrypt('john')
            ],
            [
                'name' => "Kate Morison",
                'slug' => 'kate-morison',
                'bio' => $faker->text(6, 12),
                'email' => 'kate@mr.com',
                'password' => bcrypt('kate')
            ],
            [
                'name' => 'Mike Loris',
                'slug' => 'mike-loris',
                'bio' => $faker->text(6, 12),
                'email' => 'mike@lr.com',
                'password' => bcrypt('mike')
            ],
            [
                'name' => 'Admin User',
                'slug' => 'admin-user',
                'bio' => $faker->text(6, 12),
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin')
            ]
        ]);
    }
}