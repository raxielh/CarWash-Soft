<table class="table table-responsive" id="marcas-table" style="width: 100%">
    <thead>
        <tr>
            <th>Descripcion</th>
        <th>Creado por</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($marcas as $marca)
        <tr>
            <td>{!! $marca->descripcion !!}</td>
            <td>{!! $marca->name !!}</td>
            <td>
                {!! Form::open(['route' => ['marcas.destroy', $marca->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('marcas.show', [$marca->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('marcas.edit', [$marca->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>