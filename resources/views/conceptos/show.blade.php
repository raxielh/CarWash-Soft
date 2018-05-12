@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Conceptos
        </h1>
    </section>
    <div class="content">
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row" style="padding-left: 20px">
                        @include('conceptos.show_fields')
                        <a href="{!! route('conceptos.index') !!}" class="btn btn-default">Atras</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="content">
                @include('adminlte-templates::common.errors')
                <div class="box box-primary">

                    <div class="box-body">
                        <div class="row">
                            {!! Form::open(['route' => 'valoresConceptos.store']) !!}

                                <!-- Concepto Id Field -->
                                <div class="form-group col-sm-6">
                                    <input type="text id="concepto_id" name="concepto_id">
                                </div>

                                <!-- Valor Field -->
                                <div class="form-group col-sm-6">
                                    {!! Form::label('valor', 'Valor:') !!}
                                    {!! Form::number('valor', null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                                </div>

                                <!-- Submit Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                </div>


                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
