@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
<h1 class="m-0 text-dark"><i class="fas fa-user"></i> Cadastro de Usuários </h1>
@stop

@section('content')

<div class="row">
    <div class="col-lg -12 col-md-12">
        <div class="card">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <p><strong>Erro ao realizar esta operação</strong></p>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                @if (!isset($user))
                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @else
                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                @endif
                
                @csrf

                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Dados do Usuário</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fullName">Nome</label>
                                    <input type="text" name="fullName" placeholder="Nome completo do Usuário" class="form-control" value="{{ isset($user) ? $user->fullName : null }}">
                                </div>
                                <div class="form-group">
                                    <label for="login">Login</label>
                                    <input type="text" name="login" placeholder="Nome de usuário para Login" class="form-control" value="{{ isset($user) ? $user->login : null }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" placeholder="Email do Usuario" class="form-control" value="{{ isset($user) ? $user->email : null }}">
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="password">Senha</label>
                                        <input type="password" id="password" name="password" placeholder="Informe a senha" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        @component('components.profile', ['profile' => isset($user) && $user->profile == 1 ? 1 : 0])@endcomponent
                        @component('components.status', ['status' => isset($user) && $user->status == 1 ? 1 : 0])@endcomponent
                    </div>
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn btn-outline-success"><i class="fas fa-save"></i> Salvar</button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-danger"><i class="far fa-times-circle"></i> Cancelar</a>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>
@stop