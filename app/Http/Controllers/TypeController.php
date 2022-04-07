<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller{

    public function get(Type $type){
        return view('types.details')->with('type', $type);
    }

    public function getAll(){
        $types = Type::paginate(2);
        return view('types.list')->with('types', $types);
    }

    public function store(Request $data){
        $data->validate([
            'name' => 'required',
        ]);

        $type = Type::create([
            'name' => $data->name,
            'description' => $data->description,
        ]);

        return back();
    }

    public function delete(Request $request){
        $request->validate([
            'iddelete' => 'required|exists:types,id'
        ]);
        $type = Type::find($request->iddelete);
        $type->delete();
        return back();
    }

    public function update(Request $request){
        $request->validate([
            'id_update' => 'required|exists:types,id',
        ]);
        $newType = Type::find($request->id_update);
        if($request->filled('name_update')) {
            $newType->name = $request->name_update;
        }
        if($request->filled('description_update')) {
            $newType->description = $request->description_update;
        }
        
        $newType->update();
        return back();
    }

    public function sortByName(Request $request) {
        if ($request->sortByExclusivity == 0) {
            $types = Type::orderBy('name', 'DESC')->paginate(2);
        } elseif ($request->sortByExclusivity == 1) {
            $types = Type::orderBy('name', 'ASC')->paginate(2);
        } else {
            $types = Type::paginate(2);
        }

        return view('types.list')->with('types', $types);
    }
}