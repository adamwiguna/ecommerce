<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $queryString = [
        'search',
    ];

    public function render()
    {
        $products = Product::whereNull('product_id');
        $products->with(['sizes', 'categories', 'images']);

        if ($this->search) {
            $products->where('name', 'like',"%".$this->search."%")
                     ->orWhereHas('categories', function ($query){
                        $query->where('name', 'like', '%'. $this->search.'%');
                     });
        }

        $products = $products->latest()->paginate();
        // dd($products);
        // $products = $products->load(['sizes', 'categories', 'images']);

        return view('livewire.product.index', [
            'products' => $products,
        ]);
    }
}
