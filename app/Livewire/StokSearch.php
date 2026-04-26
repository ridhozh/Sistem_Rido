<?php

namespace App\Livewire;

use App\Models\Produk;
use Livewire\Component;
use Livewire\WithPagination;

class StokSearch extends Component
{

    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $products = Produk::with('kategori')
            ->where('nama_produk', 'like', '%' . trim($this->search) . '%')
            ->paginate(10);

        return view('livewire.stok-search', [
            'products' => $products,
        ]);
    }
}
