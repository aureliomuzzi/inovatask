@extends('adminlte::page')

@section('title', 'InovaTask')

@section('content')

    @section('content')
    <div class="row">
        <section class="content-header">
            <div class="col-sm-6">
                <h1>Kanban Board</h1>
            </div>
            <div class="container-fluid">
                <div id="app">
                    <kanban-board />
                </div>
            </div>
        </section>
    </div>    
    @endsection

@stop

@push('scripts')
  <script src="{{ mix('js/app.js') }}"></script>
@endpush