<table class="table table-responsive" id="administrativos-table">
    <thead>
        <tr>
            <th>Persona Id</th>
        <th>Comision</th>
        <th>Estado Id</th>
        <th>Users Id</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($administrativos as $administrativo)
        <tr>
            <td>{!! $administrativo->persona_id !!}</td>
            <td>{!! $administrativo->comision !!}</td>
            <td>{!! $administrativo->estado_id !!}</td>
            <td>{!! $administrativo->users_id !!}</td>
            <td>
                {!! Form::open(['route' => ['administrativos.destroy', $administrativo->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('administrativos.show', [$administrativo->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('administrativos.edit', [$administrativo->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>