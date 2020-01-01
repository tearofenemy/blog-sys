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
                'bio' => $faker->text(250, 300),
                'email' => $faker->email,
                'password' => bcrypt($faker->password(6, 15))
            ],
            [
                'name' => "Kate Morison",
                'slug' => 'kate-morison',
                'bio' => $faker->text(250, 300),
                'email' => $faker->email,
                'password' => bcrypt($faker->password(6, 15))
            ],
            [
                'name' => 'Mike Loris',
                'slug' => 'mike-loris',
                'bio' => $faker->text(250, 300),
                'email' => $faker->email,
                'password' => bcrypt($faker->password(6, 15))
            ]
        ]);
    }
}