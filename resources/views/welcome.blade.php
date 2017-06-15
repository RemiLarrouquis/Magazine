@extends('layouts.app')

@section('app')
    <div class="auth">
        <div class="auth-container">
            @include('auth.login')
        </div>
    </div>
@endsection