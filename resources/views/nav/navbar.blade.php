<ul class="nav-profile">
    <li class="profile dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user icon"></i>
            <span class="name">{{ Auth::user()->name }}</span>
        </a>
        <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
            <!-- <a class="dropdown-item" href="#"> <i class="fa fa-user icon"></i> Profile </a> -->
            <!-- <div class="dropdown-divider"></div> -->
            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off icon"></i> Se déconnecter
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </li>
</ul>
<div class="auth">
    <div class="auth-container">
        <div class="card">
            <header class="auth-header">
                <h1 class="auth-title">
                    <div class="logo"> <span class="l l1"></span> <span class="l l2"></span> <span class="l l3"></span> <span class="l l4"></span> <span class="l l5"></span> </div> ModularAdmin </h1>
            </header>
            <div class="auth-content">
                <p class="text-xs-center">LOGIN TO CONTINUE</p>
                <form id="login-form" action="/index.html" method="GET" novalidate="">
                    <div class="form-group"> <label for="username">Username</label> <input type="email" class="form-control underlined" name="username" id="username" placeholder="Your email address" required> </div>
                    <div class="form-group"> <label for="password">Password</label> <input type="password" class="form-control underlined" name="password" id="password" placeholder="Your password" required> </div>
                    <div class="form-group"> <label for="remember">
                            <input class="checkbox" id="remember" type="checkbox">
                            <span>Remember me</span>
                        </label> <a href="reset.html" class="forgot-btn pull-right">Forgot password?</a> </div>
                    <div class="form-group"> <button type="submit" class="btn btn-block btn-primary">Login</button> </div>
                    <div class="form-group">
                        <p class="text-muted text-xs-center">Do not have an account? <a href="signup.html">Sign Up!</a></p>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-xs-center">
            <a href="index.html" class="btn btn-secondary rounded btn-sm"> <i class="fa fa-arrow-left"></i> Back to dashboard </a>
        </div>
    </div>
</div>