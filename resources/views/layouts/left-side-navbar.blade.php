<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard') ? 'text-primary' : '' }}"
        href="{{ route('dashboard') }}">Dashboard </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('articles.*') ? 'text-primary' : '' }}"
        href="{{ route('articles.index') }}">Artikel</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('programs.*') || request()->routeIs('program_activities.*') ? 'text-primary' : '' }}"
        href="{{ route('programs.index') }}">Program</a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Dropdown
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Something else here</a>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link disabled" href="#">Disabled</a>
</li>
