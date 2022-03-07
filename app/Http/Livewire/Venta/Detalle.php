<?php

namespace App\Http\Livewire\Venta;

use App\Models\Producto;
use App\Models\Cliente;
use App\Models\SectorLote;

use Livewire\Component;

use Livewire\WithPagination;

class Detalle extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search' => ['except'=>'']];
    protected $listeners = ['hideModal'];

    public $search = '';
    
    public $detalles_ventas = array();
    
    public $sector_lote_id;
    public $sector_lote_mes;
    public $descripcion_lote;
    public $producto_id;
    public $cliente_id;
    public $descripcion;
    public $descripcion_cliente;
    public $tipo_venta;

    public $cantidad;
    public $precio_unitario;
    public $stock_actual;
    public $unidad_medida;
    public $factor;
    public $cajas;
    public $total;
    public $totalDocumento;

    public $messageError;

    protected $rules = [
        'producto_id' => 'required|numeric',
        'cantidad' => 'required|numeric',
        'precio_unitario' => 'required|numeric',
        'unidad_medida' => 'required',
        'factor' => 'required|numeric',
        'cajas' => 'required|numeric',
        'total' => 'required|numeric',
    ];

    public function render()
    {
        return view('livewire.venta.detalle',[
            'productos' => Producto::where('tipo_producto', '2')
                                ->where( function($query) {
                                    $query->where('descripcion', 'LIKE', "%{$this->search}%")->orWhere('costo', 'LIKE', "%{$this->search}%");
                                })
                            ->paginate(10),
            'clientes' => Cliente::where('nombres', 'LIKE', "%{$this->search}%")->orWhere('apellidos', 'LIKE', "%{$this->search}%")->
                                        orWhere('cedula', 'LIKE', "%{$this->search}%")
                            ->paginate(10),
            'sector_lotes' => SectorLote::where( function($query) {
                                $query->where('descripcion', 'LIKE', "%{$this->search}%")->orWhere('hectareas_area', 'LIKE', "%{$this->search}%");
                            })
                            ->where('data', 'LT')
                            ->paginate(10),
        ]);
    }

    public function mount(){

        $this->producto_id = '';
        //$this->cliente_id = '';
        $this->descripcion = '';
        $this->descripcion_cliente = '';
        $this->descripcion_lote = '';
        $this->sector_lote_mes = '';
        $this->cantidad = 0;
        $this->precio_unitario = 0;
        $this->cajas = 0;
        $this->stock_actual = 0;
        $this->tipo_venta = '';
        $this->unidad_medida = '';
        $this->factor = 0;
        $this->total = 0;
        //$this->totalDocumento = 0;
    }

    public function updated(){
        if(\intval($this->cantidad) < 0 || $this->cantidad == ''){
            $this->cantidad = 1;
        }

        if(\intval($this->precio_unitario) < 0 || $this->precio_unitario == ''){
            $this->precio_unitario = 0;
        }
    
        if(\intval($this->cantidad) > $this->stock_actual){
            $this->messageError = 'No existe suficiente stock';
            return;
        }else{
            $this->messageError = '';
        }

        $this->cantidad = intval($this->cajas * $this->factor);
        $this->total = $this->cajas * $this->precio_unitario;
    }

    public function agregateDetail(){
        $this->validate();

        //Reordenar secuencia del detalle
        for($i = 0; $i < count($this->detalles_ventas); $i++){
            $this->detalles_ventas[$i]['secuencia'] = $i+1;
        }
        
        if(\intval($this->cantidad) > $this->stock_actual){
            $this->messageError = 'No existe suficiente stock';
            return;
        }else{
            $this->messageError = '';
        }

        array_push($this->detalles_ventas, 
            array(
                'secuencia' => count($this->detalles_ventas) + 1,
                'producto_id' => $this->producto_id,
                'descripcion' => $this->descripcion,
                'stock_actual' => $this->stock_actual,
                'cantidad' => $this->cantidad,
                'precio_unitario' => $this->precio_unitario,
                'cajas' => $this->cajas,
                'unidad_medida' => $this->unidad_medida,
                'factor' => $this->factor,
                'total' => $this->total
            )
        );
        
        $this->totalDocumento = $this->totalDocumento + $this->total;

        // dd($this->totalDocumento);
        $this->reset(['producto_id','descripcion','cantidad','precio_unitario','stock_actual',
                       'cajas','unidad_medida','factor','total']);

        return back();
    }

    public function removeDetail($secuencia){
        
        $this->totalDocumento = $this->totalDocumento - $this->detalles_ventas[$secuencia-1]['total'];
        unset($this->detalles_ventas[$secuencia-1]);
        return back();
    }

    public function selectedProducto(Producto $producto){
        
        $this->producto_id = $producto->id;
        $this->descripcion = $producto->descripcion;
        $this->cantidad = 1;
        $this->cajas = 0;
        $this->unidad_medida = $producto->unidad_medida;
        $this->factor = $producto->factor;
        $this->precio_unitario = $producto->precio_unitario;
        // $this->total = $this->cantidad * $this->precio_unitario;
        // $this->cajas = intval($this->cantidad / $this->factor);
        // $this->total = $this->cajas * $this->precio_unitario;
        $this->cantidad = intval($this->cajas * $this->factor);
        $this->total = $this->cajas * $this->precio_unitario;
        $this->stock_actual = $producto->stock;

        $this->emit('hideModal');
    }

    public function selectedSectorLote(SectorLote $sector_lote){
        
        $this->sector_lote_id = $sector_lote->id;
        $this->descripcion_lote = $sector_lote->descripcion;
        $this->sector_lote_mes = $sector_lote->dualidad_mes;
        $this->emit('hideModal');
    }

    public function selectedCliente(Cliente $cliente){
        
        $this->cliente_id = $cliente->id;
        $this->descripcion_cliente = $cliente->nombres.' '.$cliente->apellidos;
        $this->tipo_venta = $cliente->tipo_cliente;

        $this->emit('hideModal');
    }
    
    public function hideModal(){ return; }
}
