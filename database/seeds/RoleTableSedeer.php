<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\User;

class RoleTableSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create role 'admin'
        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'Admin';
        $admin->save();

        //Create role 'editor'
        $editor = new Role();
        $editor->name = 'editor';
        $editor->display_name = 'Editor';
        $editor->save();

        //Create role 'author'
        $author = new Role();
        $author->name = 'author';
        $author->display_name = 'Author';
        $author->save();

        //Attach role for users
        $adm = User::first();
        $adm->detachRole($admin);
        $adm->attachRole($admin);

        if (env('APP_ENV') === 'local') {
            $johnBlade = User::find(1);
            $johnBlade->detachRole($editor);
            $johnBlade->attachRole($editor);

            $mikeLoris = User::find(3);
            $mikeLoris->detachRole($editor);
            $mikeLoris->attachRole($editor);

            $kateWaste = User::find(2);
            $kateWaste->detachRole($author);
            $kateWaste->attachRole($author);
        }
    }
}