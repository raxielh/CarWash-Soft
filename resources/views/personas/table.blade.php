<table class="table table-responsive table-striped" id="personas-table">
    <thead>
        <tr>
            <th>Nombre</th>
        <th>Apellido</th>
        <th>Tipo Identificacion</th>
        <th>Identificacion</th>
        <th>Fecha Nacimiento</th>
        <th>Direccion</th>
        <th>Telefono</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($personas as $personas)
        <tr>
            <td>{!! $personas->nombre !!}</td>
            <td>{!! $personas->apellido !!}</td>
            <td>{!! $personas->des !!}</td>
            <td>{!! $personas->identificacion !!}</td>
            <td>{!! $personas->fecha_nacimiento !!}</td>
            <td>{!! $personas->direccion !!}</td>
            <td>{!! $personas->telefono1 !!}</td>
            <td>
                {!! Form::open(['route' => ['personas.destroy', $personas->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('personas.show', [$personas->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('personas.edit', [$personas->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>