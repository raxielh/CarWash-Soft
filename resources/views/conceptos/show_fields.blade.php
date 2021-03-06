<div class="row">
    <div class="col-sm-2">

        <!-- Id Field -->
        <div class="form-group">
            {!! Form::label('id', 'Id:') !!}
            <p>{!! $datos['conceptos'][0]->id !!}</p>
        </div>

        <!-- Codigo Field -->
        <div class="form-group">
            {!! Form::label('codigo', 'Codigo:') !!}
            <p>{!! $datos['conceptos'][0]->codigo !!}</p>
        </div>

        <!-- Descripcion Field -->
        <div class="form-group">
            {!! Form::label('descripcion', 'Descripcion:') !!}
            <p>{!! $datos['conceptos'][0]->descripcion !!}</p>
        </div>

        <!-- Tipo Conceptos Id Field -->
        <div class="form-group">
            {!! Form::label('tipo_conceptos_id', 'Tipo Conceptos:') !!}
            <p>{!! $datos['conceptos'][0]->desctp !!}</p>
        </div>

        <!-- Estado Id Field -->
        <div class="form-group">
            {!! Form::label('estado_id', 'Estado:') !!}
            <p>{!! $datos['conceptos'][0]->desc_estado !!}</p>
        </div>

        <!-- Users Id Field -->
        <div class="form-group">
            {!! Form::label('users_id', 'Creado por:') !!}
            <p>{!! $datos['conceptos'][0]->name !!}</p>
        </div>

        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{!! $datos['conceptos'][0]->created_at !!}</p>
        </div>

        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{!! $datos['conceptos'][0]->updated_at !!}</p>
        </div>

    </div>
    <div class="col-sm-4" style="padding-right: 2em">
        <div class="box box-primary">
            <div class="box-body">
                {!! Form::open(['route' => 'valoresConceptos.store']) !!}
                    <input type="hidden" id="concepto_id" name="concepto_id" value="{!! $datos['conceptos'][0]->id !!}">
                    <div class="form-group col-sm-6">
                        {!! Form::label('valor', 'Agregar Precio:') !!}
                        {!! Form::number('valor', null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                    </div>
                    <div class="form-group col-sm-6" style="margin-top: 24px;">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
                <table class="table table-responsive" id="combos-table" style="width: 100%">
                    <thead>
                        <tr>
                        <th>Precio</th>
                        <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($datos['precios'] as $precio)
                        <tr>
                            <td>{!! $precio->valor !!}</td>
                            <td>{!! $precio->created_at !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6" >                   
    @if ($datos['conceptos'][0]->idtipo === 1)
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <h4 style="padding-left: 10px;">Adicionar Producto ó Servicio al combo</h4>
            <div class="box-body">
                {!! Form::open(['route' => 'combos.store']) !!}

                    <!-- Concepto Id1 Field -->
                    <input type="hidden" name="concepto_id1" id="concepto_id1" value="{{$datos['conceptos'][0]->id}}">
                    <!-- Concepto Id Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('concepto_id2', 'Productos ó Servicios:') !!}
                        {!! Form::select('concepto_id2', $datos['productos'], null, ['class' => 'form-control chosen-select']) !!}
                    </div>

                    <!-- Estado Id Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('estado_id', 'Estado:') !!}
                        {!! Form::select('estado_id',$datos['estados'], null, ['class' => 'form-control chosen-select']) !!}
                    </div>

                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit('Agregar', ['class' => 'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}
                
                <table class="table table-responsive" id="combos-table" style="width:100%">
                    <thead>
                        <tr>
                        <th>Producto ó Servicio</th>
                        <th>% Comision</th>
                        <th>% Impuesto</th>
                        <th>Estado</th>
                        <th>Creado por</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($datos['combos'] as $combos)
                        <tr>
                            <td>{!! $combos->producto !!}</td>
                            <td>{!! $combos->comision !!}</td>
                            <td>{!! $combos->impuesto !!}</td>
                            <td>{!! $combos->descestado !!}</td>
                            <td>{!! $combos->name !!}</td>
                            <td>
                                {!! Form::open(['route' => ['combos.destroy', $combos->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    @endif
    </div>





</div>