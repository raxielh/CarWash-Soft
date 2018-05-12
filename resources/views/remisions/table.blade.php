<table class="table table-responsive" id="remisions-table" style="width: 100%">
    <thead>
        <tr>
            <th>Descripcion</th>
        <th>Fecha</th>
        <th>Valor</th>
        <th>Persona</th>
        <th>Proveedor</th>
        <th>Concepto</th>
        <th>Tipo Remision</th>

        <th>Creado Por</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($remisions as $remision)
        <tr>
            <td>{!! $remision->descripcion !!}</td>
            <td>{!! $remision->fecha !!}</td>
            <td>{!! number_format($remision->valor) !!}</td>
            <td>{!! $remision->nombre !!} {!! $remision->apellido !!} {!! $remision->identificacion !!}</td>
            <td>{!! $remision->razon_social !!}</td>
            <td>{!! $remision->con !!}</td>
            <td>{!! $remision->tr !!}</td>
            <td>{!! $remision->name !!}</td>
            <td>
                {!! Form::open(['route' => ['remisions.destroy', $remision->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('remisions.show', [$remision->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('remisions.edit', [$remision->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>