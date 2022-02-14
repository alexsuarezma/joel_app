<x-app-layout>
    <x-slot name="header">
        Reporte de Produccion
    </x-slot>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Produccion</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Produccion</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <livewire:produccion.index/>    
</x-app-layout>