<div class="row">
    <div class="col-md-4">
        <!-- Id Field -->
        <div class="form-group">
            {!! Form::label('id', 'Id:') !!}
            <p>{!! $datos['equipos']->id !!}</p>
        </div>

        <!-- Codigo Field -->
        <div class="form-group">
            {!! Form::label('codigo', 'Codigo:') !!}
            <p>{!! $datos['equipos']->codigo !!}</p>
        </div>

        <!-- Descripcion Field -->
        <div class="form-group">
            {!! Form::label('descripcion', 'Descripcion:') !!}
            <p>{!! $datos['equipos']->descripcion !!}</p>
        </div>

        <!-- Users Id Field -->
        <div class="form-group">
            {!! Form::label('users_id', 'Users Id:') !!}
            <p>{!! $datos['equipos']->users_id !!}</p>
        </div>

        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{!! $datos['equipos']->created_at !!}</p>
        </div>

        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{!! $datos['equipos']->updated_at !!}</p>
        </div>
    </div>
    <div class="col-md-8">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body" style="padding: 1em">
                <div class="row">
                    {!! Form::open(['route' => 'equipoPersonas.store']) !!}
                        <input type="hidden" id="equipo_id" name="equipo_id" value="{!! $datos['equipos']->id !!}">
                        <!-- Persona Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('persona_id', 'Persona:') !!}
                            {!! Form::select('persona_id', $datos['personas'], null, ['class' => 'form-control chosen-select']) !!}
                        </div>

                        <!-- Estado Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('estado_id', 'Estado:') !!}
                            {!! Form::select('estado_id',$datos['estados'], null, ['class' => 'form-control chosen-select']) !!}
                        </div>

                        <!-- Submit Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Asignar', ['class' => 'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
                    
                    <table class="table table-responsive" id="equipoPersonas-table" style="width: 100%">
                        <thead>
                            <tr>
                            <th>Trabajador</th>
                            <th>Estado</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($datos['equipoPersonas'] as $equipoPersonas)
                            <tr>
                                <td>{!! $equipoPersonas->nombre !!}</td>
                                <td>{!! $equipoPersonas->estado !!}</td>
                                <td>
                                    {!! Form::open(['route' => ['equipoPersonas.destroy', $equipoPersonas->id], 'method' => 'delete']) !!}
                                    <div class='btn-group'>
                                        <a href="{!! route('equipoPersonas.edit', [$equipoPersonas->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
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
        </div>
    </div>
</div>