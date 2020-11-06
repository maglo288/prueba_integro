<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UsersController extends Controller
{
    public function index()
    {
        return view('users');
        
    }

    public function store(Request $request)
    {
        return User::create(
            [
                'name' => $request->name,
                'nickname' => $request->nickname,
                'email' => $request->email,
                'password' => $request->password,
            ]
        );
        
    }

    public function update(User $model,Request $request, $id){
        $users = $model->find($id);
        $users->name = $request->name;
        $users->nickname = $request->nickname;
        $users->email = $request->email;
        $users->password = $request->password;
        return $users->save();
    }

    public function destroy(User $model, $id){
        $users = $model->find($id);
        return $users->delete();
    }

    public function info(User $model, $id){
        // $f = new Film();
        // echo ($request);
        $users = $model->find($id);
        return  ['user' => $users];
        // $films = $f->find($request->id_film);
        // return response()->json([$films]);
        
    }

    public function user_all(User $model){
        return [
            'users' => $model->select("*")
            ->where("name", "<>", "null")
            ->get()
        ];
    }
}
