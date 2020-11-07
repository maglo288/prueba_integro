<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
class FilmController extends Controller
{
    public function store(Request $request)
    {
        return Film::create(
            [
                'title' => $request->title,
                'synopsis' => $request->synopsis,
                'age' => $request->age,
            ]
        );
        
    }

    public function update(Film $model,Request $request, $id){
        $films = $model->find($id);
        $films->title = $request->title;
        $films->synopsis = $request->synopsis;
        $films->age = $request->age;
        return $films->save();
    }

    public function destroy(Film $model, $id){
        $films = $model->find($id);
        return $films->delete();
    }

    public function info(Film $model, $id){
        // $f = new Film();
        // echo ($request);
        $films = $model->find($id);
        return  ['film' => $films];
        // $films = $f->find($request->id_film);
        // return response()->json([$films]);
        
    }

    public function film_all(Film $model){
        return [
            'films' => $model->select("*")
            ->where("title", "<>", "null")
            ->get()
        ];
    }

    
}
