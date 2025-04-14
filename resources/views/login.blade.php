@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
        @if ($errors->any())
            <div class="alert alert-danger text-center mb-3 w-100">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" style="background-color: #FFFFFF; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px;">
            @csrf
            <div class="form-outline mb-4">
                <label class="form-label" for="form1Example1">Email address</label>
                <input type="email" id="form1Example1" name="email" class="form-control" required />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="form1Example2">Password</label>
                <input type="password" id="form1Example2" name="password" class="form-control" required />
            </div>

            <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                        <label class="form-check-label" for="form1Example3"> Remember me </label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
    </div>
@endsection
