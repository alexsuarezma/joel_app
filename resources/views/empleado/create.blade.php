<x-app-layout>
    <x-slot name="header">
        Registrar nuevo empleado
    </x-slot>
    <div class="container">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registrar Empleado</h3>
            </div>
            <!-- /.card-header -->
            <x-toast-message></x-toast-message>
            <!-- form start -->
            <form method="POST" action="{{ route('empleado.create.post') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputCedula1">Cedula</label>
                        <input type="text" name="cedula" id="cedula" value="{{ old('cedula') }}" onkeypress="return soloNumeros(event)" class="form-control" id="exampleInputCedula1" required>
                        <div class="invalid-feedback">
                            Cedula invalida.
                        </div>
                        <div class="valid-feedback">
                            Cedula valida.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNombres1">Nombres</label>
                        <input type="text" name="nombres" value="{{ old('nombres') }}" class="form-control" id="exampleInputNombres1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputApellidos1">Apellidos</label>
                        <input type="text" name="apellidos" value="{{ old('apellidos') }}" class="form-control" id="exampleInputApellidos1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDireccion1">Dirección</label>
                        <input type="text" name="direccion" value="{{ old('direccion') }}" class="form-control" id="exampleInputDireccion1" required>
                    </div>
                    {{--<div class="form-group">
                        <label class="selection" for="exampleInputHorario1">Horario</label>
                        <select class="form-control" name="horario_id" id="exampleInputHorario1">
                            @if(!empty($horarios)) <option disabled selected>Escoja un horario</option> @endif
                            @forelse($horarios as $horario)
                                <option value="{{$horario->id}}" {{ old('horario_id') == $horario->id ? 'selected' : '' }} >{{$horario->descripcion}}</option>
                            @empty
                                <option disabled selected>No existen horarios</option>
                            @endforelse
                        </select>
                    </div>--}}
                    <div class="form-group">
                        <label>Fecha Ingreso</label>
                        <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}" class="form-control"  required/>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Crear Empleado</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <script>
        document.getElementById('cedula').addEventListener('change', () => {
            const input = document.getElementById('cedula')
            const resolve = verificarCedula(input)
            const classBad = ['is-invalid']
            const classOk = ['is-valid']

            if(!resolve){
                input.value = ''
                classBad.forEach((cls) => input.classList.add(cls))
                classOk.forEach((cls) => input.classList.remove(cls))
            }else{
                classBad.forEach((cls) => input.classList.remove(cls))
                classOk.forEach((cls) => input.classList.add(cls))
            }
        })
    </script>
    {{--<!-- jQuery -->
    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- BS-Stepper -->
    <script src="{{ asset('/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/dist/js/demo.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });

            //Date and time picker
            $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker(
            {
                ranges   : {
                'Today'       : [moment(), moment()],
                'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
            )

            //Timepicker
            $('#timepicker').datetimepicker({
            format: 'LT'
            })

            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            })

            $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

        })

    </script>--}}
</x-app-layout>