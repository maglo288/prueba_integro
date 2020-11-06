<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
class FilmController extends Controller
{
    public function store(Request $request)
    {
        return Film::create(
            [
                'title' => $request->nombre,
                'synopsis' => $request->synopsis,
                'age' => $request->age,
            ]
        );
        
    }

    public function update(Film $model,Request $request, $id){
        $films = $model->find($id);
        return $films->save();
    }

    public function destroy(Film $model, $id){
        $films = $model->find($id);
        return $films->delete();
    }

    public function info(Request $request){
        $f = new Film();
        $films = $f->find($request->id_film);
        return response()->json([$films]);
        
    }

    public function film_all(Film $model){
        return [
            'films' => $model->select("*")
            ->where("title", "<>", "null")
            ->get()
        ];
    }

    public function comparar_año(){

    }
}
