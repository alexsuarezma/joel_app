<?php

namespace App\Http\Livewire\Venta;

use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Venta;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search' => ['except'=>'']];
    protected $listeners = ['hideModal','showError'];

    public $search = '';
    public $searchModals = '';

    public $producto_id;
    public $producto_descripcion;
    public $cliente_id;
    public $cliente_descripcion;

    public $fecha_inicio;
    public $fecha_fin;
    public $secuencia;
    public $anulado = 0;

    public function mount(){
        $this->fecha_inicio = date('Y-m-', strtotime(\Carbon\Carbon::now()))."01";
        $this->fecha_fin = date('Y-m-d', strtotime(\Carbon\Carbon::now()));
    }

    public function render()
    {
        return view('livewire.venta.index',[
            'productos' => Producto::where('descripcion', 'LIKE', "%{$this->searchModals}%")->orWhere('costo', 'LIKE', "%{$this->searchModals}%")
                            ->paginate(10),
            'clientes' => Cliente::where('nombres', 'LIKE', "%{$this->searchModals}%")->orWhere('apellidos', 'LIKE', "%{$this->searchModals}%")
                                ->orWhere('cedula', 'LIKE', "%{$this->searchModals}%")
                            ->paginate(10),
            'ventas' => Venta::select(DB::raw("DISTINCT ventas.*"))
                                ->join("detalle_ventas", "ventas.id", '=', 'detalle_ventas.venta_id', 'left outer')
                                ->where('anulado', $this->anulado)
                                ->where( function($query) {
                                    $query->where('ventas.comentario', 'LIKE', "%{$this->search}%")->orWhere('ventas.id', 'LIKE', "%{$this->search}%");
                                })
                                ->where( function($query) {
                                    if($this->secuencia != ''){
                                        $query->where('ventas.id', "{$this->secuencia}");
                                    }
                                })
                                ->whereBetween('ventas.fecha_documento', [date('Y-m-d 00:00:00', strtotime($this->fecha_inicio)),date('Y-m-d 23:59:59',strtotime($this->fecha_fin))])
                                ->where( function($query) {
                                    if($this->cliente_id != ''){
                                        $query->where('ventas.cliente_id', $this->cliente_id);
                                    }
                                })
                                ->where( function($query) {
                                    if($this->producto_id != ''){
                                        $query->where('detalle_ventas.producto_id', $this->producto_id);
                                    }
                                })
                            ->paginate(10),
            'total_venta' => Venta::select(DB::raw("ifnull(sum(DISTINCT ventas.total_venta),0) as total_venta"))
                                    ->join("detalle_ventas", "ventas.id", '=', 'detalle_ventas.venta_id', 'left outer')
                                    ->where('anulado', $this->anulado)
                                    ->where( function($query) {
                                        $query->where('ventas.comentario', 'LIKE', "%{$this->search}%")->orWhere('ventas.id', 'LIKE', "%{$this->search}%");
                                    })
                                    ->where( function($query) {
                                        if($this->secuencia != ''){
                                            $query->where('ventas.id', "{$this->secuencia}");
                                        }
                                    })
                                    ->whereBetween('ventas.fecha_documento', [date('Y-m-d 00:00:00', strtotime($this->fecha_inicio)),date('Y-m-d 23:59:59',strtotime($this->fecha_fin))])
                                    ->where( function($query) {
                                        if($this->cliente_id != ''){
                                            $query->where('ventas.cliente_id', $this->cliente_id);
                                        }
                                    })
                                    ->where( function($query) {
                                        if($this->producto_id != ''){
                                            $query->where('detalle_ventas.producto_id', $this->producto_id);
                                        }
                                    })
                        ->first()
        ]);
    }

    public function selectedProducto(Producto $producto){
        
        $this->producto_id = $producto->id;
        $this->producto_descripcion = $producto->descripcion;
        $this->emit('hideModal');
    }

    public function selectedCliente(Cliente $cliente){
        
        $this->cliente_id = $cliente->id;
        $this->cliente_descripcion = $cliente->nombres.' '.$cliente->apellidos;
        $this->emit('hideModal');
    }
    
    public function hideModal(){ return; }
    
    public function showError($error){ return; }
}
