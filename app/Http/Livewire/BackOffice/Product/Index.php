<?php

namespace App\Http\Livewire\BackOffice\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    
    public $search;

    public $isBestSeller = false;
    public $isNewArrival = false;

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

        if ($this->isBestSeller === true) {
           $products = $products->where('is_best_seller', 1);
        }
        if ($this->isNewArrival === true) {
           $products = $products->where('is_new_arrival', 1);
        }

        $products = $products->latest()->paginate();
        // dd($products);
        // $products = $products->load(['sizes', 'categories', 'images']);

        return view('livewire.back-office.product.index', [
            'products' => $products,
        ]);
    }

    public function isBestSeller(Product $product)
    {
        if (!auth()->user()->is_super_admin ) {
            abort(403);
        }
    
        if ($product->is_best_seller == 1) {
            $product->update([
                'is_best_seller' => 0
            ]);
        } else {
            $product->update([
                'is_best_seller' => 1
            ]);
        }
        
        session()->flash('success-message', 'Succes to add best seller Product');
    }
    public function isNewArrival(Product $product)
    {
        if (!auth()->user()->is_super_admin ) {
            abort(403);
        }
    
        if ($product->is_new_arrival == 1) {
            $product->update([
                'is_new_arrival' => 0
            ]);
        } else {
            $product->update([
                'is_new_arrival' => 1
            ]);
        }
        
        session()->flash('success-message', 'Succes to add best seller Product');
    }

}
