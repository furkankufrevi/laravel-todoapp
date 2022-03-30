<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom" style="background-color: #7fc900;">
    <a href="/" class="d-flex align-items-star mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4 m-2 fw-bold">ToDoApp</span>
    </a>
    <ul class="nav nav-pills m-2">
        <li class="nav-item"><a href="{{route('listing')}}" class="nav-link {{ Illuminate\Support\Facades\Route::is('listing') ? 'active' : '' }}" aria-current="page">List</a></li>
        <li class="nav-item"><a href="{{route('listing.edit')}}" class="nav-link {{ Illuminate\Support\Facades\Route::is('listing.edit') ? 'active' : '' }}">Edit List</a></li>
    </ul>
</header>
