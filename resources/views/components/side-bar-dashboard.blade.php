<div>
    <!-- He who is contented is rich. - Laozi -->
    <ul class="nav flex-column">
        <li class="nav-item ">
            <a class="nav-link @if (Request::is('dashboard')) {{ 'active' }} @endif" aria-current="page" href="/dashboard">
                <span data-feather="home"></span>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (Request::is('dashboard/book*')) {{ 'active' }} @endif" href="/dashboard/book">
                <span data-feather="book-open"></span>
                Book
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (Request::is('dashboard/publisher*')) {{ 'active' }} @endif" href="/dashboard/publisher">
                <span data-feather="share"></span>
                Pubhliser
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (Request::is('dashboard/author*')) {{ 'active' }} @endif" href="{{ route('indexauthordashboard') }}">
                <span data-feather="pen-tool"></span>
                Author
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (Request::is('dashboard/category*')) {{ 'active' }} @endif"" href="/dashboard/category">
                <span data-feather="git-branch"></span>
                Category
            </a>
        </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Admin</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
        </a>
    </h6>
    <ul class="nav flex-column mb-2">
        <li class="nav-item">
            <a class="nav-link @if (Request::is('dashboard/user*')) {{ 'active' }} @endif"" href="/dashboard/user">
                <span data-feather="users"></span>
                Management User
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (Request::is('dashboard/role*')) {{ 'active' }} @endif"" href="/dashboard/role">
                <span data-feather="layers"></span>
                Management Role
            </a>
        </li>
    </ul>


</div>
