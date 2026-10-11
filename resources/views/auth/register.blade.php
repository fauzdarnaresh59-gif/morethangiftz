@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 500px; padding: 100px 20px;">
    <h2 style="font-family: var(--font-heading); font-size: 32px; margin-bottom: 30px; text-align: center;">Register</h2>

    @if ($errors->any())
        <div style="background: #f44336; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            @foreach ($errors->all() as $error)
                <p style="margin: 0;">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
        @csrf

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autofocus
                   style="width: 100%; padding: 12px; border: 2px solid #e3e3e3; border-radius: 8px; font-size: 14px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   style="width: 100%; padding: 12px; border: 2px solid #e3e3e3; border-radius: 8px; font-size: 14px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Password</label>
            <input type="password"
                   name="password"
                   required
                   style="width: 100%; padding: 12px; border: 2px solid #e3e3e3; border-radius: 8px; font-size: 14px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Confirm Password</label>
            <input type="password"
                   name="password_confirmation"
                   required
                   style="width: 100%; padding: 12px; border: 2px solid #e3e3e3; border-radius: 8px; font-size: 14px;">
        </div>

        <button type="submit"
                style="width: 100%; padding: 14px; background: var(--black); color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer;">
            Register
        </button>
    </form>

    <p style="text-align: center; margin-top: 20px;">
        Already have an account? <a href="{{ route('login') }}" style="color: var(--black); text-decoration: underline;">Login</a>
    </p>
</div>
@endsection
