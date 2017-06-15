<div class="card">
    <header class="auth-header">
        <h1 class="auth-title">
            Magazine
        </h1>
    </header>
    <div class="auth-content">
        <form id="login-form" action="{{ route('login') }}" role="form" method="POST" novalidate="">
            {{ csrf_field() }}

            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">Username</label>
                <input type="email" class="form-control underlined" name="email" id="email" placeholder="Your email address" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="has-error">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password</label>
                <input type="password" class="form-control underlined" name="password" id="password" placeholder="Your password" required>

                @if ($errors->has('password'))
                    <span id="password-error" class="has-error">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="remember">
                    <input class="checkbox" id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                    <span>Remember me</span>
                </label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>