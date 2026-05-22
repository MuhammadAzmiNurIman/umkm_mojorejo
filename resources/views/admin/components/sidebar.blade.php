	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AdminHub</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="{{ route('admin.dashboard')}}">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="{{route('store.index')}}">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Store</span>
				</a>
			</li>
			<li>
				<a href="{{ route('admin.produk.index') }}">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Produk</span>
				</a>
			</li>
			<li>
				<a href="{{ route( 'admin.orders.history' ) }}">
                    <i class='bx bx-archive'></i>
					<span class="text">History Orders</span>
				</a>
			</li>
			<li>
				<a href="{{ route( 'admin.reservations.index' ) }}">
                    <i class='bx bx-bookmark'></i>
					<span class="text">Reservasi</span>
				</a>
			</li>
			<li>
                <a href="{{ route( 'admin.paketWisata' ) }}">
                    <i class='bx bx-map'></i>
                    <span class="text">Paket Wisata</span>
                </a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
            <li>
                <form id="logout-form" action="{{ route('account.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
		</ul>
	</section>
	<!-- SIDEBAR -->
