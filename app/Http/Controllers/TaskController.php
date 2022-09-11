<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;
Use Auth;
Use Validator;

class TaskController extends Controller
{
    public function index()
    {
        $user=Auth::user();

        $todos = Task::where('uid', $user->id)->where('status',1)->get();
        $inpros = Task::where('uid', $user->id)->where('status',2)->get();
        $dones = Task::where('uid', $user->id)->where('status',3)->get();

        return view('home',compact('todos','inpros','dones'));
    }

    public function store(Request $request){
        $user=Auth::user();

        $validation = Validator::make($request->all(),
        [
            'name' => ['required','string', 'max:255','min:2']
        ]);
        
        if($validation->fails())
        {
            return back()->withInput()->withErrors($validation);
        }
        $data = new Task;
        $data->name = $request->name;
        $data->status =1;
        $data->uid =$user->id;
        $data->save();
        return redirect()->route('dashboard')->with('success', 'Successfully Added Task');

    }


    public function inprocess($id){


        $data = Task::where('id',$id)->first();
        $data->status=2;
        $data->save();

        return redirect()->route('dashboard')->with('success', 'Successfully Task Move To In Process');


    }

    public function done($id){


        $data = Task::where('id',$id)->first();
        $data->status=3;
        $data->save();

        return redirect()->route('dashboard')->with('success', 'Successfully Task Move To Done');


    }


   
}
