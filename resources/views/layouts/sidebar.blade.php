<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Menu</div>
            <a class="nav-link 
            
            @if (Request::is('/')) active @endif

            "
                href="/">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            @auth
                <div class="sb-sidenav-menu-heading">nasabah</div>
                <a class="nav-link collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Data Nasabah
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link @if (Request::is('setoran')) active @endif"
                            href="{{ url('setoran') }}"> List Setoran </a>
                        <a class="nav-link @if (Request::is('data-nasabah')) active @endif" href="{{ url('data-nasabah') }}">Data Diri</a>
                    </nav>
                </div>
            @endauth

        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        @auth
            {{ Auth::user()->role }}
        @else
            Guest
        @endauth
    </div>
</nav>
