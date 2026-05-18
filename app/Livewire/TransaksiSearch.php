<?php

namespace App\Livewire;

use App\Models\Kategori;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class TransaksiSearch extends Component
{

    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $categories = Kategori::with(['produks' => function ($query) {
            $query->where('nama_produk', 'like', '%' . trim($this->search) . '%');
        }])->get();

        return view('livewire.transaksi-search', [
            'categories' => $categories,
        ]);
    }
}
