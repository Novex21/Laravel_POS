<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTransactions extends Component
{
    use WithPagination;
    public $search = '';

    public function reboot()
    {
        $this->search='';
        $this->render();
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
            ->orderBy('transactions.id','DESC')->paginate(10);
        return view('livewire.show-transactions',[
            'transacs' => $transac
        ]);

        // $transac = Transaction::where('order_id', 'like', '%'.$this->search.'%')
        // ->orderBy('id','DESC')->paginate(10);
        // return view('livewire.show-transactions',[
        //     'transacs' => $transac
        // ]);
    }
}
// $searchTerm = 'your_pattern';

