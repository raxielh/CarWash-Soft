<table class="table table-responsive table-striped" style="width:100%"" id="equipos-table">
    <thead>
        <tr>
            <th>Codigo</th>
        <th>Descripcion</th>
        <th>Creado por</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($equipos as $equipos)
        <tr>
            <td>{!! $equipos->codigo !!}</td>
            <td>{!! $equipos->descripcion !!}</td>
            <td>{!! $equipos->name !!}</td>
            <td>
                {!! Form::open(['route' => ['equipos.destroy', $equipos->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('equipos.show', [$equipos->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('equipos.edit', [$equipos->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>