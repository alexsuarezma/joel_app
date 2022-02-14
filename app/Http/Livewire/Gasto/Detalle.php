<?php

namespace App\Http\Livewire\Gasto;
use App\Models\Producto;
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
    
    public $detalles_gastos = array();
    
    public $producto_id;
    public $sector_lote_id;
    public $sector_lote_mes;
    public $descripcion;
    public $descripcion_lote;
    public $cantidad;
    public $hectareas_aplicado;
    public $costo;
    public $unidad_medida;
    public $factor;
    public $total;
    public $totalDocumento;

    public $messageError;

    protected $rules = [
        // 'sector_lote_id' => 'required|numeric',
        'producto_id' => 'required|numeric',
        'cantidad' => 'required|numeric',
        'hectareas_aplicado' => 'required|numeric',
        'costo' => 'required|numeric',
        'unidad_medida' => 'required|string',
        'factor' => 'required|numeric',
        'total' => 'required|numeric',
    ];

    public function render()
    {
        return view('livewire.gasto.detalle',[
            'productos' => Producto::where('descripcion', 'LIKE', "%{$this->search}%")->orWhere('costo', 'LIKE', "%{$this->search}%")
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
        // $this->sector_lote_id = '';
        $this->descripcion = '';
        $this->descripcion_lote = '';
        $this->sector_lote_mes = '';
        $this->cantidad = 0;
        $this->hectareas_aplicado = 0;
        $this->costo = 0;
        $this->unidad_medida = '';
        $this->factor = 0;
        $this->total = 0;
        $this->totalDocumento = 0;
    }

    public function updated(){
        if(\intval($this->cantidad) < 0 || $this->cantidad == ''){
            $this->cantidad = 1;
        }

        if(\intval($this->costo) < 0 || $this->costo == ''){
            $this->costo = 0;
        }

        if(\intval($this->hectareas_aplicado) < 0 || $this->hectareas_aplicado == ''){
            $this->hectareas_aplicado = 0;
        }

        $this->total = $this->cantidad * $this->costo;
    }

    public function agregateDetail(){
        $this->validate();

        //Reordenar secuencia del detalle
        for($i = 0; $i < count($this->detalles_gastos); $i++){
            $this->detalles_gastos[$i]['secuencia'] = $i+1;
        }

        array_push($this->detalles_gastos, 
            array(
                'secuencia' => count($this->detalles_gastos) + 1,
                'producto_id' => $this->producto_id,
                'descripcion' => $this->descripcion,
                // 'sector_lote_id' => $this->sector_lote_id,
                'cantidad' => $this->cantidad,
                'hectareas_aplicado' => $this->hectareas_aplicado,
                'costo' => $this->costo,
                'unidad_medida' => $this->unidad_medida,
                'factor' => $this->factor,
                'total' => $this->total
            )
        );
        
        $this->totalDocumento = $this->totalDocumento + $this->total;

        // dd($this->totalDocumento);
        $this->reset(['producto_id','descripcion','descripcion_lote','cantidad',
                       'costo','unidad_medida','factor','total']);

        return back();
    }

    public function removeDetail($secuencia){
        
        $this->totalDocumento = $this->totalDocumento - $this->detalles_gastos[$secuencia-1]['total'];
        unset($this->detalles_gastos[$secuencia-1]);
        return back();
    }

    public function selectedProducto(Producto $producto){
        
        $this->producto_id = $producto->id;
        $this->descripcion = $producto->descripcion;
        $this->cantidad = 1;
        $this->costo = $producto->costo;
        $this->unidad_medida = $producto->unidad_medida;
        $this->factor = $producto->factor;
        $this->total = $this->cantidad * $this->costo;

        $this->emit('hideModal');
    }

    public function selectedSectorLote(SectorLote $sector_lote){
        
        $this->sector_lote_id = $sector_lote->id;
        $this->descripcion_lote = $sector_lote->descripcion;
        $this->hectareas_aplicado = $sector_lote->hectareas_area;
        $this->sector_lote_mes = $sector_lote->dualidad_mes;
        $this->emit('hideModal');
    }
    
    public function hideModal(){ return; }
}

