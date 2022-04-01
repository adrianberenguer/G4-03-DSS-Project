<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;

class CollectionController extends Controller {
    
    public function get(Collection $collection){
        return view('collections.details')->with('collection', $collection);
    }

    public function getAll(){
        $collections = Collection::paginate(2);
        return view('collections.list')->with('collections', $collections);
    }

    public function store(Request $data){
        $data->validate([
            'name' => 'required',
            'description' => 'required',
            'artist_id' => 'required|exists:artists,id|numeric'
        ]);

        Collection::create([
            'name' => $data->name,
            'description' => $data->description,
            'artist_id' => $data->artist_id  // ->artist() funcionaria?
        ]);
        return back();
    }

    public function delete(Request $request){
        $request->validate([
            'id' => 'required|exists:collections,id'
        ]);
        $collection = Collection::find($request->id);
        $collection->delete();
        return back();
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required|numeric'
        ]);

        $newCollection = Collection::find($request->id);
        if($request->name != null) {
            $newCollection->name = $request->name;
        }
        if($request->description != null) {
            $newCollection->description = $request->description;
        }
        if($request->artist_id != null) {
            $newCollection->artist_id = $request->artist_id;
        }
        $newCollection->update();
        return back();
    }
}