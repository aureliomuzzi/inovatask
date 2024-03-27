@extends('adminlte::page')

@section('title', 'Usuários')



@section('content_header')
<h1 class="m-0 text-dark"><i class="fas fa-user"></i>  Lista de Usuários </h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @if(session()->has('mensagem'))
            <div class="alert alert-success">
                {{ session()->get('mensagem') }}
            </div>
        @endif

        <div class="table-responsive">
            {{ $dataTable->table(['class'=>'table table-striped','style' => 'width: 100%']) }}
        </div>


    </div>
</div>

@stop

@push('js')
    {{ $dataTable->scripts() }}
@endpush