@extends('layouts.app')

@section('content')
<div class="container" style="padding: 100px 20px;">
    <h2 style="font-family: var(--font-heading); font-size: 32px; margin-bottom: 30px;">My Account</h2>
    <p>Welcome, {{ auth()->user()->name }}!</p>
</div>
@endsection
