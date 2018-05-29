@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Conceptos
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'conceptos.store','enctype'=>'multipart/form-data']) !!}

                        @include('conceptos.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('#comision,#impuesto').val(0);
        });
    </script>
@endsection
