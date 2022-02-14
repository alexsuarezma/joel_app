<?php

namespace App\Http\Livewire\Admin\Producto;

use Livewire\Component;

use App\Models\Producto;
use App\Models\TipoGasto;

use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['search' => ['except'=>'']];

    public $search = '';
    public $tipo_gasto_id = 0;
    public $tipo_inventario = 0;

    public function render()
    {
        return view('livewire.admin.producto.index',
        [
            'productos' => Producto::where('tipo_gasto_id', ($this->tipo_gasto_id != 0 ? '=' : '<>'), $this->tipo_gasto_id)
                            ->where('tipo_inventario', ($this->tipo_inventario != 0 ? '=' : '<>'), $this->tipo_inventario)
                            ->where( function($query) {
                                $query->where('descripcion', 'LIKE', "%{$this->search}%")->orWhere('costo', 'LIKE', "%{$this->search}%");
                            })
                            ->paginate(10),
            'tipo_gastos' => TipoGasto::all()
        ]);
    }
}
