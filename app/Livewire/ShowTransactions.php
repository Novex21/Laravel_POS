<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTransactions extends Component
{
    use WithPagination;


    public $search = '';
    public $sortBy = 'order_id';
    public $sortDirection = 'desc';

    public function reboot()
    {
        $this->search='';
        $this->render();
    }


    public function sort()
    {
        $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
    }

    public function render()
    {
        $search = $this->search;
        $transac = Transaction::leftJoin('users', 'transactions.user_id', '=', 'users.id')
            ->where(function ($query) use ($search) {
                $query->where('transactions.order_id', 'LIKE', '%' . $search . '%')
                      ->orWhere('transactions.paid_amount', 'LIKE', '%' . $search. '%')
                      ->orWhere('transactions.balance', 'LIKE', '%' . $search. '%')
                      ->orWhere('transactions.payment_method', 'LIKE', '%' . $search. '%')
                      ->orWhere('transactions.transac_amount', 'LIKE', '%' . $search. '%')
                      ->orWhere('transactions.transac_date', 'LIKE', '%' . $search. '%')
                      ->orWhere('users.name', 'LIKE', '%' . $search . '%');
            })
            ->select(
                'transactions.*',
                'users.name as user_name',
            )
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);
        return view('livewire.show-transactions',[
            'transacs' => $transac
        ]);
    }
}

