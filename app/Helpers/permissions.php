<?php

function check_user_permission($request, $actionName = NULL, $id = NULL)
{
    $currentUser = $request->user();

    if ($actionName) {
        $currentActionName = $actionName;
    } else {
        $currentActionName = $request->route()->getActionName();
    }

    list($controller, $method) = explode("@", $currentActionName);
    $controller = str_replace(["App\\Http\\Controllers\\Backend\\", "Controller"], "", $controller);
    $currentPermissionsMap = [
        'crud' => ['create', 'store', 'update', 'edit', 'restore', 'destroy', 'forceDestroy', 'index', 'view']
    ];

    $classesMap = [
        "Blog" => "post",
        "Category" => "categories",
        "User" => "users"
    ];

    foreach ($currentPermissionsMap as $permission => $methods) {
        if (in_array($method, $methods) && isset($classesMap[$controller])) {
            $className = $classesMap[$controller];
            if ($className == 'post' && in_array($method, ['edit', 'update', 'destroy', 'forceDestroy', 'restore'])) {

                $id = !is_null($id) ? $id : $request->route('blog');

                if ($id && (!$currentUser->can('update-others-post') || !$currentUser->can('delete-others-post'))) {
                    $post = \App\Post::withTrashed()->find($id);
                    if ($post->author_id !== $currentUser->id) {
                        return false;
                    }
                }
            } else if (!$currentUser->can("{$permission}-{$className}")) {
                return false;
            }
            break;
        }
    }
    return true;
}