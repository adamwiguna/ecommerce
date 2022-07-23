<?php

namespace App\Http\Livewire\BackOffice\Product;

use Livewire\Component;
use App\Models\Category;

class Create extends Component
{
    public $sizes = [['size' => 'One Size', 'price' => '']];

    public $name;


    public function render()
    {
    
        $categories = Category::whereNull('category_id')->with('subCategories.subCategories')->get();
   
        return view('livewire.back-office.product.create', [
            'categories' => $categories,
        ]);
    }

    
    public function addSize()
    {
        $this->sizes[] = ['size' => '', 'price' => ''];
    }

    public function removeSize($index)
    {
        unset($this->sizes[$index]);
        $this->sizes = array_values($this->sizes);
    }
}
