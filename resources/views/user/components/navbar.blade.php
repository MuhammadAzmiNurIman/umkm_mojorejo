<header class="header" data-header>
    <div class="nav-wrapper">
      <div class="container">
        <h1 class="h1">
          <a href="./index.html" class="logo">Kuliner Rakyat <span class="span">Mojorejo</span></a>
        </h1>

        <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
          <ion-icon name="menu-outline"></ion-icon>
        </button>

        <nav class="navbar" data-navbar>
          <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>

          <ul class="navbar-list">
            <li><a href="{{ route('user.dashboard') }}" class="navbar-link">Beranda</a></li>
            <li><a href="{{ route('user.about') }}" class="navbar-link">Tentang</a></li>
            <li><a href="{{ route('store.list') }}" class="navbar-link">Warung</a></li>
            <li><a href="{{ route('user.contact') }}" class="navbar-link">Kontak</a></li>
            <li><a href="{{ route('user.paketWisata') }}" class="navbar-link">Paket Wisata</a></li>
            {{-- <li>
                <a class="navbar-link" href="{{ url('/blogs') }}">Blog</a>
            </li> --}}

          </ul>
        </nav>

        <div class="header-action">
          <div class="search-wrapper" data-search-wrapper>
            <button class="header-action-btn" aria-label="Toggle search" data-search-btn>
              <ion-icon name="search-outline" class="search-icon"></ion-icon>
              <ion-icon name="close-outline" class="close-icon"></ion-icon>
            </button>
            <div class="input-wrapper">
              <input type="search" name="search" placeholder="Search here" class="search-input">
              <button class="search-submit" aria-label="Submit search">
                <ion-icon name="search-outline"></ion-icon>
              </button>
            </div>
          </div>

          @php
          $cartCount = Auth::check() ? App\Models\Cart::where('user_id', Auth::id())->sum('quantity') : 0;
        @endphp

        <button class="header-action-btn" aria-label="Open shopping cart" data-panel-btn="cart">
            <ion-icon name="basket-outline"></ion-icon>
            <data class="btn-badge" value="{{ $cartCount }}">{{ str_pad($cartCount, 2, '0', STR_PAD_LEFT) }}</data>
        </button>


          @auth
          <form action="{{ route('account.logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn"
              style="margin-left: 20px; display: flex; align-items: center; gap: 5px; font-size: 16px;">
              <ion-icon name="log-out-outline"></ion-icon> Keluar
            </button>
          </form>
          @endauth
        </div>
      </div>
    </div>
  </header>
