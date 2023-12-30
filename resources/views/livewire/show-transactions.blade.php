<div>
    <div class="row g-2 mb-4">
        <div class="col col-md-6">
            <h4 class="text-light">Transactions List</h4>

            <p class="text-light">Sales enables you to effectively control sales KPIs and monitor them in one central
                place while helping teams to reach sales goals.
            </p>
        </div>
        <div class="col col-md-6">

        </div>

    </div>

    <div class="row no-gutters flex-lg-nowrap mb-3">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 btn-group me-0">
            <select class="form-control" wire:model.live='sortBy' id="select">
                <option value="order_id">Order No.</option>
                <option value="transac_amount">Total Amount</option>
                <option value="paid_amount">Paid Amount</option>
                <option value="balance">Change</option>
                <option value="transac_date">Date</option>
            </select>
            <button class="btn btn btn-primary" wire:click='sortASC'><i class="fa-solid fa-arrow-up"></i></button>
            <button class="btn btn btn-primary" wire:click='sortDESC'><i class="fa-solid fa-arrow-down"></i></button>

        </div>
        <div class='col-lg-4'>
            <div class="btn-group ms-5 me-0" >
                <input type="search" wire:model.live="search"  class="form-control" placeholder="Searh....">
                <button class="btn btn-sm btn-primary" wire:click='reboot'>Reset</button>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">

            <table class="table">
                <thead class="text-center">
                    <tr class="h5">
                        <th>Order No.</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Change</th>
                        <th>Type</th>
                        <th>Charged by</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($transacs as $tran )
                    <tr wire:key='{{ $tran->key }}'>
                        <td>{{$tran->order_id}}</td>
                        <td>{{$tran->transac_amount}}</td>
                        <td class="text-success">{{$tran->paid_amount}}</td>
                        <td class="text-danger">{{$tran->balance}}</td>
                        <td>{{$tran->payment_method}}</td>
                        <td>{{$tran->user->name}}</td>
                        <td>{{$tran->transac_date}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                {{ $transacs->links() }}
            </div>
        </div>
    </div>

</div>



