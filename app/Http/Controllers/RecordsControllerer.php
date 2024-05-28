<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;

class RecordsControllerer extends Controller
{
    function index(Request $request){
        $rows = 10;
        if($request->has('rows')){
            $rows = $request->rows;
        }
        return Record::paginate($rows);
    }

    function show($id){
        return Record::find($id);
    }

    function store(Request $request){
        $this->validate($request,[
            'value' => 'required',
            'sensor_id' => 'required',
        ]);
        $record = new Record();
        $record->fill($request->all());
        $record->date = date('Y-m-d H:i:s');
        $record->save();
        return $record;
    }

    function update(Request $request, $id){
        $record = Record::find($id);
        if(!$record) return response('', 404);
        $record->fill($request->all());
        $record->save();
        return $record;
    }

    function destroy($id){
        $record = Record::find($id);
        if(!$record) return response('', 404);
        $record->delete();
        return $record;
    }
}
