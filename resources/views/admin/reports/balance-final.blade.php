<x-app-layout>
    <x-slot name="header">
        Reportes
    </x-slot>

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
        <h1>Balance Final</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Balance Final</li>
        </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <livewire:admin.reportes.balance-final/>   
</x-app-layout>