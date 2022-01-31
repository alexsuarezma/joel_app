<?php

namespace App\Http\Livewire\Admin\TipoGasto;

use Livewire\Component;
use App\Models\TipoGasto;

use Livewire\WithPagination;

class Index extends Component
{
    
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['search' => ['except'=>'']];

    public $search = '';

    public function render()
    {
        return view('livewire.admin.tipo-gasto.index',
        [
            'tipo_gastos' => TipoGasto::where( function($query) {
                                $query->where('descripcion', 'LIKE', "%{$this->search}%");
                            })
                            ->paginate(10)
        ]);
    }
}
