<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;

class UserController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->paginate($this->limit);
        $usersCount = User::count();
        if (view()->exists('backend.user.index')) {
            return view('backend.user.index', compact('users', 'usersCount'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        if (view()->exists('backend.user.create')) {
            return view('backend.user.create', compact('user'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        User::create($request->all());
        return redirect('/backend/user')->with('message', 'User successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if (view()->exists('backend.user.edit')) {
            return view('backend.user.edit', compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        User::findOrFail($id)->update($request->all());
        return redirect('/backend/user')->with('message', 'User successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDestroyRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $deleted_oprtion = $request->deleted_option;
        $selected_user = $request->selected_user;

        if($deleted_oprtion == 'delete') {
            $user->posts()->withTrashed()->forceDelete();
        } else if($deleted_oprtion == 'attribute') {
            $user->posts()->update(['author_id' => $selected_user]);
        }

        $user->delete();
        return redirect('/backend/user')->with('message', 'User successfully deleted.');
    }

    public function confirm(UserDestroyRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $users = User::where('id', '!=', $user->id)->pluck('name', 'id');

        return view('backend.user.confirm', compact('user', 'users'));
    }
}
