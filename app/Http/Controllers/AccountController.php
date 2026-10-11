<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index');
    }

    public function orders()
    {
        return view('account.orders');
    }

    public function quotes()
    {
        return view('account.quotes');
    }

    public function wishlist()
    {
        return view('account.wishlist');
    }

    public function addresses()
    {
        return view('account.addresses');
    }

    public function settings()
    {
        return view('account.settings');
    }
}
