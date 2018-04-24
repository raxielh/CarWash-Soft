<table class="table table-responsive" id="lineas-table" style="width: 100%">
    <thead>
        <tr>
            <th>Marca</th>
        <th>Descripcion</th>
        <th>Creado por</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($lineas as $linea)
        <tr>
            <td>{!! $linea->marca !!}</td>
            <td>{!! $linea->descripcion !!}</td>
            <td>{!! $linea->name !!}</td>
            <td>
                {!! Form::open(['route' => ['lineas.destroy', $linea->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('lineas.show', [$linea->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('lineas.edit', [$linea->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>