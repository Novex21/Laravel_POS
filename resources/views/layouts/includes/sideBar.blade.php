<ul id="sidebar" class="nav flex-column px-3 ">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">
            <i class="fa-solid fa-house-chimney fa-lg me-2"></i>
            <span class="align-middle">Home</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.index') }}">
            <i class="fa-solid fa-cart-shopping fa-lg me-2"></i>
            <span class="align-middle">Orders</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('transactions.index') }}">
            <i class="fa-solid fa-coins fa-lg me-2"></i>
            <span class="align-middle">Transaction</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('products.index') }}">
            <i class="fa-solid fa-basket-shopping fa-lg me-2"></i>
            <span class="align-middle">Products</span>
        </a>
    </li>
    <hr class="mb-4">
</ul>

<style>

    #sidebar a {
        font-size: 1.1rem;
        padding: 10px;
        width: 30vh;
        color:#007BFF;
        font-weight: bold;

    }
    #sidebar a.active {
        background-color: #007BFF;
        color:white;
    }

    #sidebar a:hover {
        color: white;
        background-color:#007BFF;
    }

</style>
