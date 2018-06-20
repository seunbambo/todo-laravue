<?php
namespace App\Http\Controllers;
use App\Todo;
use Illuminate\Http\Request;
class TodoController extends Controller
{
    public function index()
    {
        return Todo::latest()->get();
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:500'
        ]);
        return Todo::create([ 'body' => request('body') ]);
    }
    public function destroy($id)
    {
        $task = Todo::findOrFail($id);
        $task->delete();
        return 204;
    }
}