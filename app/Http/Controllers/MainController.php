<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function listing(){

        $todolist = ToDoList::orderBy('done', 'asc')->orderByDesc('created_at')->paginate(10);

        return view('listing', compact('todolist'));
    }

    public function edit(){

        $todolist = ToDoList::orderBy('done', 'asc')->orderByDesc('created_at')->paginate(10);

        return view('edit', compact('todolist'));
    }

    public function operations(Request $request, $type){

        //EKLEME
        if ($type == 'add') {
            $validator = $request->validate([
                'todo' => ['required', 'max:500'],
                'due_date' => ['required'],
                'earnings' => ['required'],
            ]);

            if ($validator) {
                if ($request->id > 0 ){
                    $item = ToDoList::where('id', $request->id)->firstOrFail();
                    $item->todo = $request->todo;
                    $item->due_date = $request->due_date;
                    $item->earnings = $request->earnings;
                    $item->save();
                    $message = 'Listing Updated Succesfully.';
                }else{
                    $item = new ToDoList();
                    $item->todo = $request->todo;
                    $item->due_date = $request->due_date;
                    $item->earnings = $request->earnings;
                    $item->save();
                    $message = 'Listing Added Succesfully.';
                }


                $todolist = ToDoList::orderBy('done', 'asc')->orderByDesc('created_at')->paginate(10);
                $html = view('partials.todolist', compact('todolist'))->render();
                return response()->json(compact('html', 'message'));
            } elseif ($validator->fails()) {
                $data = array(
                    'message' => $validator->errors()->all(),
                    'type' => 'error',
                    'status' => '422',
                    'errors' => $validator->getMessageBag()->toArray(),
                );
                return response()->json($data);
            }
        }

        //SİLME
        if ($type == 'remove'){
            $item = ToDoList::where('id', $request->id)->firstOrFail();
            $item->delete();
            $todolist = ToDoList::orderBy('done', 'asc')->orderByDesc('created_at')->paginate(10);
            $html = view('partials.todolist', compact('todolist'))->render();
            return response()->json(compact('html'), 200);
        }

        if ($type == 'check'){
            $item = ToDoList::where('id', $request->id)->firstOrFail();
            if ($item->done == 1){
                $item->done=0;
                $responsestatus = 'Changed Status To Undone.';
            }else{
                $item->done=1;
                $responsestatus = 'Changed Status To Done.';
            }
            $item->save();
            $todolist = ToDoList::orderBy('done', 'asc')->orderByDesc('created_at')->paginate(10);
            $html = view('partials.todolist', compact('todolist'))->render();
            return response()->json(compact('html', 'responsestatus'), 200);
        }

        if ($type == 'show-edit-form'){
            $item = ToDoList::where('id', $request->id)->firstOrFail();
            $html = view('partials.editform', compact('item'))->render();
            return response()->json(compact('html'), 200);
        }

    }
}
