@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Usuarios</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('usuarios.create') !!}">Agregar nuevo</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('usuarios.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>

    <script src="{{URL::asset('js/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function(){
          $('#datos').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('usuarios_tabla') }}',
                "columns": [
                      {data: 'id', name: 'id'},
                      {data: 'name', name: 'name'},
                      {data: 'email', name: 'email'},
                ]
            });
        });
    </script>
@endsection

