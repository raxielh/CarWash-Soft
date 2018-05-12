<table class="table table-responsive" id="configuracions-table">
    <thead>
        <tr>
            <th>Concepto Admin Gasto</th>
        <th>Concepto Lavador Gasto</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($configuracions as $configuracion)
        <tr>
            <td>{!! $configuracion->concepto_admin_gasto !!}</td>
            <td>{!! $configuracion->concepto_lavador_gasto !!}</td>
            <td>
                {!! Form::open(['route' => ['configuracions.destroy', $configuracion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('configuracions.show', [$configuracion->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('configuracions.edit', [$configuracion->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>