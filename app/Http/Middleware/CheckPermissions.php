<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $currentUser = $request->user();
        $currentActionName = $request->route()->getActionName();
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
                    if( ($id = $request->route("blog")) && (!$currentUser->can('update-others-post') || !$currentUser->can('delete-others-post'))) {
                        $post = \App\Post::find($id);
                        if($post->author_id !== $currentUser->id) {
                            abort(403, 'Forbidden action');
                        }
                    }
                }
                else if (!$currentUser->can("{$permission}-{$className}")) {
                    abort(403, 'Forbidden action');
                }
                break;
            }
        }
        return $next($request);
    }
}