<?php

namespace App\Http\Livewire\Cliente;

use Livewire\Component;
use App\Models\Cliente;

use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $filter = '';
    public $status = 0;

    public function render()
    {
        return view('livewire.cliente.index',
            [
            'clientes' => Cliente::where( function($query) {
                                if($this->status != 0){
                                    $query->where('tipo_cliente', "{$this->status}");
                                }
                            })
                            ->where( function($query) {
                                $query->where('nombres', 'LIKE', "%{$this->search}%")->orWhere('apellidos', 'LIKE', "%{$this->search}%")
                                ->orWhere('cedula', 'LIKE', "%{$this->search}%")->orWhere('email', 'LIKE', "%{$this->search}%");
                            })
                            ->paginate(10)
        ]);
    }

}
