<header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-archery-brown ">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('img/LOGO KK AC 3.png') }}" alt="Logo" height="70"
                    class="d-inline-block align-text-top me-2">
                KKU Archery Club
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @auth
                        {{-- Shared dropdown: Admin & Member --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="sharedMenu" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                เมนูหลัก
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="sharedMenu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">แดชบอร์ด</a></li>
                                <li><a class="dropdown-item" href="{{ route('equipLoan') }}">ยืม-คืนอุปกรณ์</a></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('member.loans.history') }}">
                                        ประวัติการยืม-คืนของฉัน
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('global-logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'super-admin')
                            {{-- Admin-only dropdown (also visible to super-admin) --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminMenu" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    เมนูผู้ดูแล
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="adminMenu">
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">แดชบอร์ด</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.equip') }}">จัดการอุปกรณ์-หมวดหมู่</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('admin.item') }}">จัดการสต็อกอุปกรณ์</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('admin.loans.pending') }}">ตรวจสอบการคืนอุปกรณ์</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('admin.loanHistory') }}">ประวัติการยืม-คืนทั้งหมด</a></li>
                                    @if(Auth::user()->role === 'super-admin')
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('users.index') }}">เพิ่ม-ถอนกรรมการ</a></li>
                                    @endif

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('global-logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <form id="global-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <div class="banner-container">
        <img src="{{ asset('img/head.png') }}" alt="KKU Archery Club Banner" class="img-fluid">
    </div>
</header>