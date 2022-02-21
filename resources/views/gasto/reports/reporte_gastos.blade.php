<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Gastos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <H2 class="text-center">Reporte de gastos</H2>

    <div class="card-body p-0 pt-4">
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
                            Sector / lote
                        </th>
                        <th>
                            Anulado
                        </th>
                        <th style="width: 8%" class="text-center">
                            Total Gasto
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $totalDocumento = 0; ?>
                    @forelse($gastos as $gasto)
                        <tr>
                            <td>
                                #{{$gasto->id}}
                            </td>
                            <td>
                                <div class="d-flex justify-content-around align-items-center">
                                    <div class="">
                                        <a>
                                        {{$gasto->comentario}}
                                        </a>
                                        <br/>
                                        <small>
                                            Created {{$gasto->created_at}}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                            {{$gasto->fecha_documento}}
                            </td>
                            <td class="project_progress">
                                {{$gasto->sectorLote->descripcion}}
                            </td>
                            <td class="project_progress">
                                <span class="{{ $gasto->anulado == 1 ? 'badge badge-danger' : '' }}">{{ $gasto->anulado == 1 ? 'Anulado' : '' }}</span>
                            </td>
                            <td class="project-state">
                                <span>{{ $gasto->total_gasto }}</span>
                            </td>
                        </tr>
                        <?php $totalDocumento += $gasto->total_gasto; ?>
                    @empty
                    @endforelse
                    
                    <tr>
                        <th colspan="6">
                        </th>
                    </tr>
                    <tr>
                        <th colspan="5">
                            <span class="float-right">Total gastos</span>
                        </th>
                        <th><span class="float-right">{{$totalDocumento}}</span></th>
                    </tr>
                </tbody>
            </table>
        </div>
</body>
</html>