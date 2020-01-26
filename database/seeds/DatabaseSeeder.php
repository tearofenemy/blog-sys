<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        if (env('APP_ENV') === 'local') {
            $this->call(UserSeeder::class);
            $this->call(CategorySeeder::class);
            $this->call(PostSeeder::class);
            $this->call(RoleTableSedeer::class);
            $this->call(PermissionTableSeeder::class);
            $this->call(CommentsTableSeeder::class);
            $this->call(TagSeeder::class);
        } else {
            $this->call(UserSeeder::class);
            $this->call(CategorySeeder::class);
            $this->call(RoleTableSedeer::class);
            $this->call(PermissionTableSeeder::class);
        }
    }
}