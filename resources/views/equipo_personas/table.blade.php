<table class="table table-responsive" id="equipoPersonas-table">
    <thead>
        <tr>
            <th>Equipo Id</th>
        <th>Persona Id</th>
        <th>Estado Id</th>
        <th>Users Id</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($equipoPersonas as $equipoPersonas)
        <tr>
            <td>{!! $equipoPersonas->equipo_id !!}</td>
            <td>{!! $equipoPersonas->persona_id !!}</td>
            <td>{!! $equipoPersonas->estado_id !!}</td>
            <td>{!! $equipoPersonas->users_id !!}</td>
            <td>
                {!! Form::open(['route' => ['equipoPersonas.destroy', $equipoPersonas->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('equipoPersonas.show', [$equipoPersonas->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('equipoPersonas.edit', [$equipoPersonas->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>