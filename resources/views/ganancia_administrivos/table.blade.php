<table class="table table-responsive" id="gananciaAdministrivos-table" style="width: 100%">
    <thead>
        <tr>
            <th>Valor Inicial</th>
        <th>Valor Final</th>
        <th>Porcentaje Ganancia</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($gananciaAdministrivos as $gananciaAdministrivo)
        <tr>
            <td>{!! number_format($gananciaAdministrivo->valorini) !!}</td>
            <td>{!! number_format($gananciaAdministrivo->valorfin) !!}</td>
            <td>{!! $gananciaAdministrivo->porcenganancia !!}</td>
            <td>
                {!! Form::open(['route' => ['gananciaAdministrivos.destroy', $gananciaAdministrivo->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('gananciaAdministrivos.show', [$gananciaAdministrivo->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('gananciaAdministrivos.edit', [$gananciaAdministrivo->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>