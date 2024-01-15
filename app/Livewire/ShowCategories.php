<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCategories extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'code';
    public $sortDirection = 'desc';

    public function reboot()
    {
        $this->search='';
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
        $categories = Category::leftJoin('users', 'categories.user_id', '=', 'users.id')
            ->where(function ($query) use ($search) {
                $query->where('categories.name', 'LIKE', '%' . $search . '%')
                      ->orWhere('categories.code', 'LIKE', '%' . $search. '%')
                      ->orWhere('users.name', 'LIKE', '%' . $search . '%');
            })
            ->select(
                'categories.*',
                'users.name as user_name',
            )
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(5);
        return view('livewire.show-categories',[
            'categories' => $categories,
        ]);
    }
}
