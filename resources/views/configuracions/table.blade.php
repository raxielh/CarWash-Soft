<table class="table table-responsive" id="configuracions-table" style="width: 100%">
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
            <td>{!! $configuracion->conceptos1 !!}</td>
            <td>{!! $configuracion->conceptos2 !!}</td>
            <td>
                {!! Form::open(['route' => ['configuracions.destroy', $configuracion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('configuracions.edit', [$configuracion->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>