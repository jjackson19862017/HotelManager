<x-admin.login.login>
@section('content')
<div class="col-lg-5">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                    @csrf
                <div class="form-group">
                    <label class="small mb-1" for="username">{{ __('Username') }}</label>
                    <input class="form-control py-4 @error('username') is-invalid @enderror"
                    id="username"
                    type="username"
                    name="username"
                    value="{{ old('username') }}"
                    required
                    autocomplete="username"
                    autofocus />

                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="small mb-1" for="password">{{ __('Password') }}</label>
                    <input class="form-control py-4 @error('password') is-invalid @enderror"
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password" />

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" id="remember" type="checkbox" />
                        <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                    </div>
                </div>
                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                    <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                    <button type="submit" class="btn btn-primary float-right">{{ __('Login') }}</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center">
            <!--<div class="small"><a href="{{ route('register') }}">Need an account? Sign up!</a></div> -->
        </div>
    </div>
</div>
@endsection
</x-admin.login.login>


