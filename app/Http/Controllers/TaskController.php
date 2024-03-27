<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\TaskDataTable;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaskDataTable $dataTable)
    {
        return $dataTable->render('tasks.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['user_id'] = Auth::id();
            
            Task::create($data);

            return redirect('/tasks')->with(['tipo'=>'success', 'mensagem'=>'Registro criado com sucesso!']);
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->back()->withErrors(['tipo'=>'danger', 'mensagem'=>'Erro ao realizar operação.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.form', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        try {
            $data = $request->all();
            $data['user_id'] = $task->user_id ? $task->user_id : Auth::id();
            
            $task->update($data);

            return redirect('/tasks')->with('mensagem', 'Registro atualizado com sucesso!');
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->back()->withErrors(['tipo'=>'danger', 'mensagem'=>'Erro ao realizar operação.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect('/tasks')->with('mensagem', 'Registro excluído com sucesso!');
    }

    /* Route of API */
    public function kanban()
    {
        $userId = Auth::id();
        $columns = Task::where('user_id', 1)->get();
        // $columns = Task::all();
        // dd($userId);
        return response()->json($columns);
    }

}
