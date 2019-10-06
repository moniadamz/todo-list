<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
class TodosController extends Controller
{
 public function index() {
    $todos = Todo::all(); //pega todos os ToDos da tabela
     return view('todos.index')->with('todos', $todos);
 }
 
 public function show(Todo $todo) {
    return view('todos.show')->with('todo', $todo);
 }

 public function create() {
     return view('todos.create');
 }

 public function store() {
     $this->validate(request(), [
         'name' => 'required',
         'description' => 'required'
     ]);

     $data = request()->all();

     $todo = new Todo();
     $todo->name = $data['name'];
     $todo->description = $data['description'];
     $todo->completed = false;
     $todo->save();

     session()->flash('success', 'Todo created successfully!');

     return redirect('/todos');
 }

 public function complete(Todo $todo) {
    $todo->completed = true;
    $todo->save();

    session()->flash('success', 'Todo completed successfully.');

    return redirect('/todos');
 }
}

