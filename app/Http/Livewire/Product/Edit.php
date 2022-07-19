<?php

namespace App\Http\Livewire\Product;

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
            $this->sizes[] = ['size' => $product->size, 'price' => $product->price];
        }

        if ($this->product->sizes->count() == 0) {
            $this->sizes[] = ['size' => $this->product->size, 'price' => $this->product->price];
        }
    }

    public function render()
    {
        $categories = Category::whereNull('category_id')->with('subCategories.subCategories')->get();

        return view('livewire.product.edit', [
            'categories' => $categories,
        ]);
    }

    public function addSize()
    {
        $this->sizes[] = ['size' => '', 'price' => ''];
        // dd( $this->sizes);
    }

    public function removeSize($index)
    {
        unset($this->sizes[$index]);
        $this->sizes = array_values($this->sizes);
    }
}
