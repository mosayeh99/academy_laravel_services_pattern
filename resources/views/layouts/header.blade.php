<header class="navbar navbar-expand-md navbar-light d-print-none">
    <div class="container-xl">
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/home">
                <img src="{{asset('assets/static/logo.svg')}}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm bg-transparent rounded-5" style="background-image: url({{asset('assets/static/avatars/user.png')}})"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <p class="dropdown-item">مرحباً </p>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button class="dropdown-item">تسجيل خروج</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
