<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <H2 class="text-center">Reporte de Ventas</H2>

    <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                        #
                    </th>
                    <th style="width: 20%">
                        Descripcion
                    </th>
                    <th style="width: 30%">
                        Fecha documento
                    </th>
                    <th>
                        Cliente
                    </th>
                    <th>
                        Tipo
                    </th>
                    <th>
                        Anulado
                    </th>
                    <th style="width: 8%" class="text-center">
                        Total Ventas
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $totalDocumento = 0; ?>
                @forelse($ventas as $venta)
                    <tr>
                        <td>
                            #{{$venta->id}}
                        </td>
                        <td>
                            <div class="d-flex justify-content-around align-items-center">
                                <div class="">
                                    <a>
                                    {{$venta->comentario}}
                                    </a>
                                    <br/>
                                    <small>
                                        Created {{$venta->created_at}}
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td>
                        {{$venta->fecha_documento}}
                        </td>
                        <td class="project_progress">
                            {{ $venta->cliente->nombres.' '.$venta->cliente->apellidos }}
                        </td>
                        <td class="project_progress">
                            {{ $venta->tipo_venta == 1 ? 'Local' : 'Extranjero' }}
                        </td>
                        <td class="project_progress">
                            <span class="{{ $venta->anulado == 1 ? 'badge badge-danger' : '' }}">{{ $venta->anulado == 1 ? 'Anulado' : '' }}</span>
                        </td>
                        <td class="project-state">
                            <span>{{ $venta->total_venta }}</span>
                        </td>
                    </tr>
                    <?php $totalDocumento += $venta->total_venta; ?>
                @empty
                @endforelse
                
                <tr>
                    <th colspan="6">
                    </th>
                </tr>
                <tr>
                    <th colspan="5">
                        <span class="float-right">Total Ventas</span>
                    </th>
                    <th><span class="float-right">{{$totalDocumento}}</span></th>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>