<table class="table table-responsive" id="remisions-table">
    <thead>
        <tr>
            <th>Descripcion</th>
        <th>Persona Id</th>
        <th>Proveedor Id</th>
        <th>Concepto Id</th>
        <th>Tipo Remision Id</th>
        <th>Fecha</th>
        <th>Valor</th>
        <th>Users Id</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($remisions as $remision)
        <tr>
            <td>{!! $remision->descripcion !!}</td>
            <td>{!! $remision->persona_id !!}</td>
            <td>{!! $remision->proveedor_id !!}</td>
            <td>{!! $remision->concepto_id !!}</td>
            <td>{!! $remision->tipo_remision_id !!}</td>
            <td>{!! $remision->fecha !!}</td>
            <td>{!! $remision->valor !!}</td>
            <td>{!! $remision->users_id !!}</td>
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