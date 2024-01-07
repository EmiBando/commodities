@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header border-light align-self-center bg-transparent lead">{{ __('ユーザーログイン画面') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- <div class="row mb-3"> -->
                        <div class="row m-2">
                            <!-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> -->

                            <!-- <div class="col-md-6"> -->
                            <div class="col">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="アドレス">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="row mb-3"> -->
                        <div class="row m-2">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> -->

                            <!-- <div class="col-md-6"> -->
                            <div class="col">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="パスワード">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row m-2">
                            <div class="col justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row m-2 justify-content-center">
                                <div class="col-4 text-center">
                                    <button type="button" class="btn btn-warning rounded-pill "  onclick="location.href='{{route('register')}}'">
                                            {{ __('新規登録') }}
                                        </button>
                                </div>

                                <div class="col-4 text-center">
                                    <button type="submit" class="btn btn-info rounded-pill">
                                            {{ __('ログイン') }}
                                    </button>
                                    
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                        </div>
                        <!-- <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
