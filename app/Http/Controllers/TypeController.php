<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller{

    public function get(Type $type){
        return response()->json(['type' => $type]);
    }

    public function getAll(){
        $types = Type::all();
        return response()->json(['type' => $types]);
    }

    public function create(Request $data){
        $type = Type::create([
            'name' => $data->name,
            'description' => $data->email,
            'artist_id' => $data->artist_id  // ->artist() funcionaria?
        ]);

        return response()->json(['success' => true, 'type' => $type]);
    }

    public function delete(Type $type){
        if(Type::whereId($type->id)->count()){
            $type->delete();
            return response()->json(['success' => true, 'type' => $type]);
        }
        return response()->json(['success' => false]);
    }

    public function update(){
        //TODO:
    }


}