@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Equipo de Lavado
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    @if (count($datos['lavados'])==0)
                        {!! Form::open(['route' => 'lavados.store']) !!}

                            @include('lavados.fields')

                        {!! Form::close() !!}
                    @else
                        <div class="form-group col-sm-6">
                            <h4>Esta comanda se le asigno el equipo {{$datos['lavados'][0]->equipo}} con codigo {{$datos['lavados'][0]->codigo}} </h4>
                            {!! Form::open(['route' => ['lavados.destroy',$datos['lavados'][0]->id ], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Desasignar equipo', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                            {!! Form::close() !!} <hr>
                            <a href="{!! route('comandas.show',$datos['id']) !!}" class="btn btn-default">Cancelar</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
