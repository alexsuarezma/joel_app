<x-app-layout>
    <x-slot name="header">
        Lista de {{ Route::is('sector.index') ? 'Sector' : 'Hectarea' }}
    </x-slot>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ Route::is('sector.index') ? 'Sector' : 'Hectarea' }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ Route::is('sector.index') ? 'Sector' : 'Hectarea' }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php $data; ?>
    @if(Route::is('sector.index'))
      <?php $data = 'SC'; ?>
    @else
      <?php $data = 'LT'; ?>
    @endif
    <livewire:admin.sector-lote.index :data="$data" />    
</x-app-layout>