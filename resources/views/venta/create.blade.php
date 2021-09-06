<x-app-layout>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Venta</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Venta</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">

            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                <div class="col-12">
                    <h4>
                    <i class="fas fa-globe"></i> Venta, Inc.
                    <small class="float-right">fecha: 2/09/2021</small>
                    </h4>
                </div>
                <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    De
                    <address>
                    <strong>Admin, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Telefono: (804) 123-5432<br>
                    Email: info@almasaeedstudio.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    A
                    <address>
                    <strong>John Doe</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Telefono: (555) 539-1037<br>
                    Email: john.doe@example.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Factura #007612</b><br>
                    <br>
                    <b>Orden ID:</b> 4F3S8J<br>
                    <b>Fecha de pago:</b> 2/09/2021<br>
                    <b>Cuenta:</b> 968-34567
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Codigo</th>
                        <th>Serie #</th>
                        <th>Descripción</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Código del producto</td>
                        <td>455-981-221</td>
                        <td>Descripción del producto</td>
                        <td>$64.50</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Código del producto</td>
                        <td>247-925-726</td>
                        <td>Descripción del producto</td>
                        <td>$50.00</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Código del producto</td>
                        <td>735-845-642</td>
                        <td>Descripción del producto</td>
                        <td>$10.70</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Código del producto</td>
                        <td>422-568-642</td>
                        <td>Descripción del producto</td>
                        <td>$25.99</td>
                    </tr>
                    </tbody>
                    </table>
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Metodos de pago:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Descripción del metodo de pago
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Monto adeudado 2/22/2014</p>

                    <div class="table-responsive">
                    <table class="table">
                        <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>$250.30</td>
                        </tr>
                        <tr>
                        <th>Impuesto (9.3%)</th>
                        <td>$10.34</td>
                        </tr>
                        <tr>
                        <th>Transporte:</th>
                        <td>$5.80</td>
                        </tr>
                        <tr>
                        <th>Total:</th>
                        <td>$265.24</td>
                        </tr>
                    </table>
                    </div>
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                <div class="col-12">
                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Imprimir</a>
                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Guardar Venta
                    </button>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generar PDF
                    </button>
                </div>
                </div>
            </div>
            <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</x-app-layout>