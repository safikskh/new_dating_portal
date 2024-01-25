<!-- Developed By CBS -->
	<!-- Setting Sidebar -->
	<div class="col-lg-4 col-md-12">
			<div class="card custom-card">
				<nav class="nav nav-pills flex-column">
					<a style="font-weight: bold; text-transform: uppercase;" class="nav-link {{ Request::is('profileprivacy') ? 'active' : '' }}" href="{{ route('privacy.setting.show') }}"><i class="fas fa-user-secret"></i> Privatliv</a>
					<a style="font-weight: bold; text-transform: uppercase;" class="nav-link {{ Request::is('pushnotification') ? 'active' : '' }}" href="{{ route('push.setting.show') }}"><i class="far fa-bell"></i> Push Notifikationer</a>
					<a style="font-weight: bold; text-transform: uppercase;" class="nav-link {{ Request::is('email_settings') ? 'active' : '' }}" href="{{ route('email.setting.show') }}"><i class="fas fa-envelope-open-text"></i> Email Notifikationer</a>
					<a style="font-weight: bold; text-transform: uppercase;" class="nav-link {{ Request::is('transations') ? 'active' : '' }}" href="{{ route('trx.setting.show') }}"><i class="fas fa-search-dollar"></i> Betalingshistorik</a>
					<a style="font-weight: bold; text-transform: uppercase;" class="nav-link {{ Request::is('profile_security') ? 'active' : '' }}" href="{{ route('security.setting.show') }}"><i class="fas fa-cubes"></i> Medlemskab</a>
				</nav>
			</div>
		</div>
	<!-- Setting Sidebar -->
<!-- Developed By CBS -->