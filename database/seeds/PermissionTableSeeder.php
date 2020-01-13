<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //crud post
        $crudPost = new Permission();
        $crudPost->name = 'crud-post';
        $crudPost->display_name = 'CRUD-Post';
        $crudPost->save();
        //update others post
        $updateOthersPost = new Permission();
        $updateOthersPost->name = 'update-others-post';
        $updateOthersPost->display_name = 'Update-Others-Post';
        $updateOthersPost->save();
        //delete others post
        $deleteOthersPost = new Permission();
        $deleteOthersPost->name = 'delete-others-post';
        $deleteOthersPost->display_name = 'Delete-Others-Post';
        $deleteOthersPost->save();
        //crud categories
        $crudCategories = new Permission();
        $crudCategories->name = 'crud-categories';
        $crudCategories->display_name = 'CRUD-Categories';
        $crudCategories->save();
        //crud users
        $crudUsers = new Permission();
        $crudUsers->name = 'crud-users';
        $crudUsers->display_name = 'CRUD-Users';
        $crudUsers->save();

        //attach permiossions for roles
        $admin = Role::whereName('admin')->first();
        $editor = Role::whereName('editor')->first();
        $author = Role::whereName('author')->first();

        $admin->detachPermissions([$crudPost, $updateOthersPost, $deleteOthersPost, $crudCategories, $crudUsers]);
        $admin->attachPermissions([$crudPost, $updateOthersPost, $deleteOthersPost, $crudCategories, $crudUsers]);
        $editor->detachPermissions([$crudPost, $updateOthersPost, $deleteOthersPost, $crudCategories]);
        $editor->attachPermissions([$crudPost, $updateOthersPost, $deleteOthersPost, $crudCategories]);
        $author->detachPermission($crudPost);
        $author->attachPermission($crudPost);
    }
}