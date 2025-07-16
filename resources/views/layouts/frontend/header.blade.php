<!-- Top Bar Start -->
<div class="top-bar">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="tb-contact">
          <p><i class="fas fa-envelope"></i>{{ $getsetting->email }}</p>
          <p><i class="fas fa-phone-alt"></i>{{ $getsetting->phone  }}</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="tb-menu">
          @auth
        <a href="javascript:void(0)"
        onclick="if(confirm('Do you want to logout')){document.getElementById('formlogout').submit()}return false">Logout</a>
      @endauth
          @guest
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
      @endguest

        </div>
        <form action="{{ route('logout') }}" method="post" id='formlogout'>@csrf</form>
      </div>
    </div>
  </div>
</div>
<!-- Top Bar Start -->

<!-- Brand Start -->
<div class="brand">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-3 col-md-4">
        <div class="b-logo">
          <a href="{{ route('frontend.index') }}">
            <img src="{{ asset('assets/frontend/') }}{{ $getsetting->logo }}" alt="Logo" />
          </a>
        </div>
      </div>
      <div class="col-lg-6 col-md-4">
        {{-- here was add --}}
      </div>
      <div class="col-lg-3 col-md-4">
        <form action="{{ route('frontend.search') }}" method='post'>
          @csrf
          <div class="b-search">
            <input type="text" name="search" placeholder="Search" />
            <button type="submit"><i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Brand End -->

<!-- Nav Bar Start -->
<div class="nav-bar">
  <div class="container">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
      <a href="#" class="navbar-brand">MENU</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto">
          <a href="{{ route('frontend.index') }}"
            class="nav-item nav-link {{ request()->routeIs('frontend.index') ? 'active' : '' }}">Home</a>
          <div class="nav-item dropdown">
            <a href="#"
              class="nav-link dropdown-toggle {{ request()->routeIs('frontend.category.posts') ? 'active' : '' }}"
              data-toggle="dropdown">Categories</a>
            <div class="dropdown-menu">
              @foreach ($categories as $category)

          <a href="{{ route('frontend.category.posts', $category->slug) }}" class="dropdown-item"
          title='{{ $category->name }}'>{{ $category->name }}</a>
        @endforeach

            </div>
          </div>
          <a href="{{ route('frontend.contact.index') }}"
            class="nav-item nav-link {{ request()->routeIs('frontend.contact.index') ? 'active' : '' }}">Contact Us</a>
          @auth('web')
        <a href="{{ route('frontend.dashboard.profile') }}" class="nav-item nav-link">ACCOUNT</a>
      @endauth
        </div>
        <div class="social ml-auto">
          <!-- Notification Dropdown -->
          <a href="#" class="nav-link dropdown-toggle" id="notificationDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell"></i>
            @if (auth()->check())
        <span id="count-notification" class="badge badge-danger">
          {{ auth()->user()->unreadNotifications->count() }}
        </span>
      @endif
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown" style="width: 300px;">
            <h6 class="dropdown-header">Notifications <a class='dropdown-header'
                href="{{ route('frontend.dashboard.notification.markRead') }}"> Mark All As Read</a></h6>

            @auth('web')
            @forelse (auth()->user()->unreadNotifications as $notify)
          <div id="push-notification">
            <div class="dropdown-item d-flex justify-content-between align-items-center ">
            <span>Post Comment:
            {{ substr($notify->data['post_title'], 0, 9) }}...</span>
            <a href="{{ $notify->data['link'] }}?notify={{ $notify->id }}"><i class="fa fa-eye"></i></a>
            </div>
          </div>
          @empty

          <div class="dropdown-item text-center">No notifications</div>
          @endforelse
      @endauth


          </div>
          <a href="{{ $getsetting->X }}" title="X" target="_blank"><i class="fab fa-twitter"></i></a>
          <a href="{{ $getsetting->facebook }}" title="Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
          <a href="{{ $getsetting->linkedin }}" title="LinkedIn" target="_blank"><i class="fab fa-linkedin-in"></i></a>
          <a href="{{ $getsetting->instagram }}" title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
          <a href="{{ $getsetting->youtube }}" title="Youtube" target="_blank"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </nav>
  </div>
</div>
<!-- Nav Bar End -->