<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('users.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['password'] = bcrypt($request->password);
            $data['status'] = $request->status == '1' ? 1 : 0;
            $data['profile'] = $request->profile == '1' ? 1 : 0;

            User::create($data);

            return redirect('/users')->with(['tipo'=>'success', 'mensagem'=>'Registro criado com sucesso!']);
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
    public function edit(User $user)
    {
        return view('users.form', [
            'user' => $user,
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $data = $request->all();
            $data['password'] = $request->password ? bcrypt($request->password) : $user->password;
            $data['status'] = $request->status == '' ? 0 : 1;
            $data['profile'] = $request->profile == '' ? 0 : 1;

            $user->update($data);

            return redirect('/users')->with('mensagem', 'Registro atualizado com sucesso!');
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
        $user = User::find($id);
        $user->delete();
        return redirect('/users')->with('mensagem', 'Registro excluído com sucesso!');
    }
}
