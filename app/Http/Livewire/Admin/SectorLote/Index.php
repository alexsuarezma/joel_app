<?php

namespace App\Http\Livewire\Admin\SectorLote;

use Livewire\Component;

use App\Models\SectorLote;

use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['search' => ['except'=>'']];

    public $search = '';
    public $status = 3;
    public $codigo_padre = 0;
    public $data;

    public function render()
    {
        return view('livewire.admin.sector-lote.index',
        [
            'sector_lotes' => SectorLote::where('vigencia', ($this->status != 3 ? '=' : '<>'), $this->status)
                            ->where('data', $this->data)
                            ->where( function($query) {
                                if($this->codigo_padre != 0 && $this->data == 'LT'){
                                    $query->where('codigo_padre', $this->codigo_padre);
                                }else{
                                    if($this->data == 'SC'){
                                    //     $query->where('codigo_padre', '<>',$this->codigo_padre);
                                    // }else{
                                        $query->where('codigo_padre', null);
                                    }
                                }
                            })
                            ->where( function($query) {
                                $query->where('descripcion', 'LIKE', "%{$this->search}%")->orWhere('hectareas_area', 'LIKE', "%{$this->search}%");
                            })
                            ->paginate(10),
            'sectores' => SectorLote::where('data', 'SC')->get()
        ]);
    }
}
