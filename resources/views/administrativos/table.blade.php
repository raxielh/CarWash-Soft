<table class="table table-responsive" id="administrativos-table" style="width: 100%">
    <thead>
        <tr>
            <th>Persona</th>

        <th>Estado</th>
        <th>Creado por</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($administrativos as $administrativo)
        <tr>
            <td>{!! $administrativo->nom !!} {!! $administrativo->ape !!} {!! $administrativo->iden !!}</td>

            <td>{!! $administrativo->esta !!}</td>
            <td>{!! $administrativo->name !!}</td>
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