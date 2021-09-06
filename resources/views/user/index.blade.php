<x-app-layout>
    <x-slot name="header">
        Lista de usuarios
    </x-slot>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Usuarios</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                          Nombres
                      </th>
                      <th style="width: 30%">
                          <!-- Team Members -->
                      </th>
                      <th>
                          Email
                      </th>
                      <th style="width: 8%" class="text-center">
                          Estado
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                @forelse($users as $user)
                  <tr>
                      <td>
                          #
                      </td>
                      <td>
                          <a>
                                {{$user->name.' '.$user->lastname}}
                          </a>
                          <br/>
                          <small>
                              Created {{$user->created_at}}
                          </small>
                      </td>
                      <td>
                          <ul class="list-inline">
                              <li class="list-inline-item">
                                  <img alt="Avatar" class="table-avatar" src="{{$user->profile_photo_url}}">
                              </li>
                          </ul>
                      </td>
                      <td class="project_progress">
                            {{$user->email}}
                      </td>
                      <td class="project-state">
                          <span class="badge badge-success">{{$user->admin == 1 ? 'Admin': 'User' }}</span>
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-info btn-sm" href="{{ route('user.update', ['id' => $user->id] ) }}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Editar
                          </a>
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              Eliminar
                          </a>
                      </td>
                  </tr>
                @empty
                @endforelse
            </tbody>
        </table>
        {{$users->links()}}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</x-app-layout>