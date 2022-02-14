<?php

namespace App\Http\Livewire\Gasto;

use App\Models\Producto;
use App\Models\SectorLote;
use App\Models\Gasto;

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
    public $sector_lote_id;
    public $sector_lote_descripcion;

    public $fecha_inicio;
    public $fecha_fin;
    public $secuencia;
    public $anulado = 0;

    public function mount(){
        $this->producto = new Producto();
        $this->sector_lote = new SectorLote();
        $this->fecha_inicio = date('Y-m-', strtotime(\Carbon\Carbon::now()))."01";
        $this->fecha_fin = date('Y-m-d', strtotime(\Carbon\Carbon::now()));
    }

    public function updated(){
        if($this->producto_id == ''){
            $this->producto_id = '';
            $this->producto_descripcion = '';
        }else{
            $prod = Producto::where('id', $this->producto_id)->first();
            if($prod){
                $this->producto_id = $prod->id;
                $this->producto_descripcion = $prod->descripcion;
            }else{
                $this->producto_id = '';
                $this->producto_descripcion = '';
                $this->emit('showError', 'Producto no existe');
            }
        }

        if($this->sector_lote_id == ''){
            $this->sector_lote_id = '';
            $this->sector_lote_descripcion = '';
        }else{
            $sector_lot = SectorLote::where('id', $this->sector_lote_id)->first();
            if($sector_lot){
                $this->sector_lote_id = $sector_lot->id;
                $this->sector_lote_descripcion = $sector_lot->descripcion;
            }else{
                $this->sector_lote_id = '';
                $this->sector_lote_descripcion = '';
                $this->emit('showError', 'Sector / Lote no existe');
            }
        }
    }

    public function render()
    {
        return view('livewire.gasto.index',[
            'productos' => Producto::where('descripcion', 'LIKE', "%{$this->searchModals}%")->orWhere('costo', 'LIKE', "%{$this->searchModals}%")
                            ->paginate(10),
            'sector_lotes' => SectorLote::where('descripcion', 'LIKE', "%{$this->searchModals}%")->orWhere('hectareas_area', 'LIKE', "%{$this->searchModals}%")
                            ->paginate(10),
            'gastos' => Gasto::select(DB::raw("DISTINCT gastos.*"))
                                ->join("detalles_gastos", "gastos.id", '=', 'detalles_gastos.gasto_id', 'left outer')
                                ->where('anulado', $this->anulado)
                                ->where( function($query) {
                                    $query->where('gastos.comentario', 'LIKE', "%{$this->search}%")->orWhere('gastos.id', 'LIKE', "%{$this->search}%");
                                })
                                ->where( function($query) {
                                    if($this->secuencia != ''){
                                        $query->where('gastos.id', "{$this->secuencia}");
                                    }
                                })
                                ->whereBetween('gastos.fecha_documento', [date('Y-m-d 00:00:00', strtotime($this->fecha_inicio)),date('Y-m-d 23:59:59',strtotime($this->fecha_fin))])
                                ->where( function($query) {
                                    if($this->sector_lote_id != ''){
                                        $query->where('gastos.sector_lote_id', $this->sector_lote_id);
                                    }
                                })
                                ->where( function($query) {
                                    if($this->producto_id != ''){
                                        $query->where('detalles_gastos.producto_id', $this->producto_id);
                                    }
                                })
                            ->paginate(10),
            'total_gasto' => Gasto::select(DB::raw("ifnull(sum(DISTINCT gastos.total_gasto),0) as total_gasto"))
                                    ->join("detalles_gastos", "gastos.id", '=', 'detalles_gastos.gasto_id', 'left outer')
                                    ->where('anulado', $this->anulado)
                                    ->where( function($query) {
                                        $query->where('gastos.comentario', 'LIKE', "%{$this->search}%")->orWhere('gastos.id', 'LIKE', "%{$this->search}%");
                                    })
                                    ->where( function($query) {
                                        if($this->secuencia != ''){
                                            $query->where('gastos.id', "{$this->secuencia}");
                                        }
                                    })
                                    ->whereBetween('gastos.fecha_documento', [date('Y-m-d 00:00:00', strtotime($this->fecha_inicio)),date('Y-m-d 23:59:59',strtotime($this->fecha_fin))])
                                    ->where( function($query) {
                                        if($this->sector_lote_id != ''){
                                            $query->where('gastos.sector_lote_id', $this->sector_lote_id);
                                        }
                                    })
                                    ->where( function($query) {
                                        if($this->producto_id != ''){
                                            $query->where('detalles_gastos.producto_id', $this->producto_id);
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

    public function selectedSectorLote(SectorLote $sector_lote){
        
        $this->sector_lote_id = $sector_lote->id;
        $this->sector_lote_descripcion = $sector_lote->descripcion;
        $this->emit('hideModal');
    }
    
    public function hideModal(){ return; }
    
    public function showError($error){ return; }
}
