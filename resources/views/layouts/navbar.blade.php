
<nav class="navbar is-fixed-top is-fluid is-info">
    <div class="container">
  <div class="navbar-brand">
      @auth
    <a class="navbar-item" href="/home">
        <span class="icon"><i class="fa fa-tachometer"></i></span>
        <span>Dashboard</span>
    </a>
    @endauth
    @guest
    <a class="navbar-item" href="/">
        <span class="icon"><i class="fa fa-home"></i></span>
        <span>    Home</span>
    </a>
    @endguest
    <a class="navbar-item" href="/forums">
        <span class="icon">
            <i class="fa fa-book"></i>
        </span>
        <span>Forum</span>
    
      </a>
    <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
            <span></span>
            <span></span>
            <span></span>
    </div>
  </div>

  <div id="navbarExampleTransparentExample" class="navbar-menu">
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="field is-grouped">
          <p class="control">
            
          </p>
          <p class="control">
            @guest
            <p class="control">
                <a class="button is-info" href="/login">
                <span class="icon">
                    <i class="fa fa-lock"></i>
                </span>
                    <span>Login</span>
                </a>
                <a class="button is-info" href="/register">
                <span class="icon">
                    <i class="fa fa-user"></i>
                </span>
                    <span>Register</span>
                </a>
            </p>
        @endguest
        @auth

                            <div class="navbar-item has-dropdown is-hoverable control">
                                <a class="button is-info" href="">
                                    <span class="icon">
                                        {{--<img class="is-circle nav-image" src="" alt="Image">--}}
                                        <i class="fa fa-wrench"></i>
                                    </span> Settings
                                    <span></span>
                                </a>
                                <div class="navbar-dropdown ">
                                    <a class="navbar-item " href="">
                                        <p><strong>My Profile</strong></p>
                                    </a>
                                    <a class="navbar-item " href="">
                                        <p><strong>My Settings</strong></p>
                                    </a>
                                </div>
                            </div>
                            <p>
                                <a href="{{ route('logout') }}" class="button is-danger"
                                   onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <span class="icon"><i class="fa fa-user"></i></span>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </a>
                            </p>
                        @endauth
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
</nav>
