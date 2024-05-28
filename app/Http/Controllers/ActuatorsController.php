<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actuator;

class ActuatorsController extends Controller
{
    public function index(Request $request)
    {
        $rows = 10;
        if($request->has('rows')){
            $rows = $request->rows;
        }
        return Actuator::paginate($rows);
    }

    public function show($id){
        return Actuator::find($id);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:actuators',
            'type' => 'required',
            'value' => 'required',
        ]);
        $actuator = new Actuator();
        $actuator->fill($request->all());
        $actuator->date = date('Y-m-d H:i:s');
        $actuator->user_id = $request->user()->id;
        $actuator->save();
        return $actuator;
    }

    public function update(Request $request, $id){
        $actuator = Actuator::find($id);
        if(!$actuator) return response('', 404);
        $actuator->fill($request->all());
        $actuator->save();
        return $actuator;
    }

    public function destroy($id){
        $actuator = Actuator::find($id);
        if(!$actuator) return response('', 404);
        $actuator->delete();
        return $actuator;
    }
}
