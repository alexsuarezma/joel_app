<x-app-layout>
    <x-slot name="header">
        Actualizar {{ Route::is('sector.update') ? 'Sector' : 'Lote' }}
    </x-slot>
    <div class="container">
        <!-- general form elements -->
        <x-toast-message></x-toast-message>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Actualizar {{ Route::is('sector.update') ? 'Sector' : 'Lote' }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ Route::is('sector.update') ? route('sector.update.put') : route('lote.update.put') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="data" value="{{ Route::is('sector.update') ? 'SC' : 'LT' }}">
                <input type="hidden" name="id" value="{{$sector_lote->id}}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputDescripcion1">Descripción</label>
                        <input type="text" name="descripcion" value="{{ $sector_lote->descripcion }}" class="form-control" id="exampleInputDescripcion1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputHectareaArea1">Hectareas/Area</label>
                        <input type="number" name="hectareas_area" value="{{ $sector_lote->hectareas_area }}" class="form-control" id="exampleInputHectareaArea1" required>
                    </div>
                    @if(Route::is('lote.update'))
                        <div class="form-group">
                            <label>Codigo Sector</label>
                            <select class="form-control" name="codigo_padre">
                                <option selected></option>
                                @forelse($sectores as $sector)
                                    <option value="{{$sector->id}}" {{ $sector_lote->codigo_padre == $sector->id ? 'selected' : '' }}>{{$sector->descripcion}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dualidad Mes</label>
                            <select class="form-control" name="dualidad_mes" required>
                                <option selected></option>
                                <option value="ene_feb" {{ $sector_lote->dualidad_mes == 'ene_feb' ? 'selected' : '' }}>Enero-Febrero</option>
                                <option value="mar_abr" {{ $sector_lote->dualidad_mes == 'mar_abr' ? 'selected' : '' }}>Marzo-Abril</option>
                                <option value="may_jun" {{ $sector_lote->dualidad_mes == 'may_jun' ? 'selected' : '' }}>Mayo-Junio</option>
                                <option value="jul_ago" {{ $sector_lote->dualidad_mes == 'jul_ago' ? 'selected' : '' }}>Julio-Agosto</option>
                                <option value="sep_oct" {{ $sector_lote->dualidad_mes == 'sep_oct' ? 'selected' : '' }}>Septiembre-Octubre</option>
                                <option value="nov_dic" {{ $sector_lote->dualidad_mes == 'nov_dic' ? 'selected' : '' }}>Noviembre-Diciembre</option>
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Vigente</label>
                        <select class="form-control" name="vigencia">
                          <option value="1" {{ $sector_lote->vigencia == 1 ? 'selected' : '' }}>Vigente</option>
                          <option value="0" {{ $sector_lote->vigencia == 0 ? 'selected' : '' }}>No Vigente</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Actualizar</button>
                    @if($sector_lote->vigencia == 1)
                        <form method="POST" action="{{ Route::is('sector.update') ? route('sector.update.vigencia.put') : route('lote.update.vigencia.put') }}" autocomplete="off" >
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$sector_lote->id}}">
                            <input type="hidden" name="vigencia" value="{{$sector_lote->vigencia == 1 ? 0 : 1}}">
                            <button type="submit" class="btn btn-danger float-right mr-4">Eliminar</button>
                        </form>
                    @endif
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</x-app-layout>