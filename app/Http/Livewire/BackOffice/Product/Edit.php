<?php

namespace App\Http\Livewire\BackOffice\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class Edit extends Component
{
    public $sizes = [];
    public $product;

    public function mount($product)
    {
        foreach ($this->product->sizes as $index => $product) {
            $this->sizes[] = [
                'id' => $product->id, 
                'size' => $product->size, 
                'price' => $product->price,
                'carts' => $product->carts->count(),
                'orders' => $product->orders->where('done', null)->where('canceled', null)->count(),
            ];
        }
    }

    public function render()
    {
        $categories = Category::whereNull('category_id')->with('subCategories.subCategories')->get();

        return view('livewire.back-office.product.edit', [
            'categories' => $categories,
        ]);
    }

    public function addSize()
    {
        $this->sizes[] = ['id' => '', 'size' => '', 'price' => ''];
    }

    public function removeSize($index)
    {
        unset($this->sizes[$index]);
        $this->sizes = array_values($this->sizes);
    }
}
