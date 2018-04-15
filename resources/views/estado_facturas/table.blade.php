<table class="table table-responsive" id="estadoFacturas-table">
    <thead>
        <tr>
            <th>Descripcion</th>
        <th>Creado Por</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($estadoFacturas as $estadoFactura)
        <tr>
            <td>{!! $estadoFactura->descripcion !!}</td>
            <td>{!! $estadoFactura->users_id !!}</td>
            <td>
                {!! Form::open(['route' => ['estadoFacturas.destroy', $estadoFactura->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('estadoFacturas.show', [$estadoFactura->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('estadoFacturas.edit', [$estadoFactura->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>