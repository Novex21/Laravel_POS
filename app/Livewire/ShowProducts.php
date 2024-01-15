<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'name';
    public $sortDirection = 'desc';
    public $selectCategory = null;

    public function reboot()
    {
        $this->search='';
        $this->selectCategory = null;
        $this->render();
    }


    public function sortASC()
    {
        $this->sortDirection = 'asc';
    }
    public function sortDESC()
    {
        $this->sortDirection = 'desc';
    }
    public function render()
    {
        $search = $this->search;
        $products = Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where(function ($query) use ($search) {
                $query->where('products.name', 'LIKE', '%' . $search . '%')
                      ->orWhere('products.brand', 'LIKE', '%' . $search. '%')
                      ->orWhere('products.price', 'LIKE', '%' . $search. '%')
                      ->orWhere('products.quantity', 'LIKE', '%' . $search. '%')
                      ->orWhere('products.alert_stock', 'LIKE', '%' . $search. '%')
                      ->orWhere('products.description', 'LIKE', '%' . $search. '%')
                      ->orWhere('categories.name', 'LIKE', '%' . $search . '%');
            })
            ->when($this->selectCategory, function ($query) {
                $query->where('categories.id', $this->selectCategory);
            })
            ->select(
                'products.*',
                'categories.name as category_name',
            )
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(5);

            $categories = Category::all();
        return view('livewire.show-products',[
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
