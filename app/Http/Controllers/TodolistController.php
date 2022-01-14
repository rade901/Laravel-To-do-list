<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    public function index()
    {
       $todolists = Todolist::paginate(10);
       return view('home', compact('todolists'));
       
    }

    
     
    public function store(Request $request)
    {
        $request->session()->flash('alert-success', 'Task was successful added!');
       $data = $request->validate([
        'content' => 'required|max:255',
       ]);
       Todolist::create($data);
       return back();
    }

    public function destroy(Todolist $todolist)
    {
       $todolist->delete();
       return back();
    }
    public function completed($id){
      $todolist = Todolist::find($id);
      if ($todolist->completed){
          $todolist->update(['completed' => false]);
          return redirect()->back()->with('success', "TODO marked as incomplete!");
      }else {
          $todolist->update(['completed' => true]);
          return redirect()->back()->with('success', "TODO marked as complete!");
      }
  }

  
}
