<table class="table table-responsive table-striped" style="width:100%" id="descuentos-table">
    <thead>
        <tr>
            <th>Codigo</th>
        <th>Descripcion</th>
        <th>Porcentaje</th>
        <th>Creado Por</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($descuentos as $descuento)
        <tr>
            <td>{!! $descuento->codigo !!}</td>
            <td>{!! $descuento->descripcion !!}</td>
            <td>%{!! $descuento->porcentaje !!}</td>
            <td>{!! $descuento->name !!}</td>
            <td>
                {!! Form::open(['route' => ['descuentos.destroy', $descuento->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('descuentos.show', [$descuento->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('descuentos.edit', [$descuento->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>