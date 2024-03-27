@extends('adminlte::page')

@section('title', 'Tarefas')

@section('content_header')
<h1 class="m-0 text-dark"><i class="fas fa-user"></i> Cadastro de Tarefas </h1>
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

                @if (!isset($task))
                    <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                @else
                    <form method="POST" action="{{ route('tasks.update', $task->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                @endif
                
                @csrf

                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Informação sobre a Tarefa</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Titulo</label>
                                    <input type="text" name="title" placeholder="Titulo da Tarefa" class="form-control" value="{{ isset($task) ? $task->title : null }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Descrição</label>
                                    <textarea id="story" name="description" rows="5" cols="33" class="form-control">{{ isset($task) ? $task->description : 'Descrição detalhada da tarefa...' }} </textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Classificação da Tarefa</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="icheck-success">
                                            <input type="radio" id="normal" name="status" value="Normal", {{ isset($task) && $task->status == "Normal" ? 'checked' : '' }} />
                                            <label for="normal">Normal</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="icheck-dark">
                                            <input type="radio" id="inProgress" name="status" value="In Progress", {{ isset($task) && $task->status == "In Progress" ? 'checked' : '' }} />
                                            <label for="inProgress">Em Progresso</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="icheck-warning">
                                            <input type="radio" id="paused" name="status" value="Paused", {{ isset($task) && $task->status == "Paused" ? 'checked' : '' }} />
                                            <label for="paused">Pausado</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="icheck-danger">
                                            <input type="radio" id="canceled" name="status" value="Canceled", {{ isset($task) && $task->status == "Canceled" ? 'checked' : '' }} />
                                            <label for="canceled">Cancelado</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="icheck-primary">
                                            <input type="radio" id="concluded" name="status" value="Concluded", {{ isset($task) && $task->status == "Concluded" ? 'checked' : '' }} />
                                            <label for="concluded">Concluido</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn btn-outline-success"><i class="fas fa-save"></i> Salvar</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-danger"><i class="far fa-times-circle"></i> Cancelar</a>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>
@stop