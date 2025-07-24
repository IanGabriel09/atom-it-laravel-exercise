<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function main()
    {
        $tasks = PostModel::all();
        return view('todo', compact('tasks'));
    }

    public function store(Request $request)
    {
        PostModel::create($request->only('title', 'content'));

        session()->flash('message', 'Task Successfully created.'); // Flash message
        
        return redirect()->route('todo.main');
    }

    public function update(Request $request, $id)
    {
        $post = PostModel::findOrFail($id);
        $post->update($request->only('title', 'content'));

        session()->flash('message', 'Task successfully updated.');

        return redirect()->route('todo.main');
    }

    public function declare($id)
    {
        $post = PostModel::findOrFail($id);
        $post->status = $post->status === 'done' ? 'not-done' : 'done';
        $post->save();

        session()->flash('message', 'Task status successfully updated');

        return redirect()->route('todo.main');
    }

    public function destroy($id)
    {
        PostModel::destroy($id);

        session()->flash('message', 'Task successfully deleted');
        
        return redirect()->route('todo.main');
    }
}
