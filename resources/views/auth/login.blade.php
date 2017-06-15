
<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-4 col-form-label">E-Mail Address</label>

        <div class="col-8">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-4 col-form-label">Password</label>

        <div class="col-8">
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <div class="col align-self-start">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
            </div>
        </div>
        <div class="col align-self-end">
            <button type="submit" class="btn btn-secondary">
                <i class="fa fa-sign-in" aria-hidden="true"></i> Login
            </button>
        </div>
    </div>
</form>
