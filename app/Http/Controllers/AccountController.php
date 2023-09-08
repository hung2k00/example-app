<?php

namespace App\Http\Controllers;

use App\Mail\RandomPasswordMail;
use App\Models\Account;
use App\Models\LoyalCustomer;
use App\Rules\UniqueEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|min:8',
        ]);
        $arr = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        // $remember = $request->has('remember');
        if (Auth::attempt($arr)) {
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.'])->withInput();
        }
    }
    public function indexRegister()
    {
        return view('account.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => ['required','max:255','email', new UniqueEmail],
        ]);
        $randomPassword = Str::random(10);

        $user = new LoyalCustomer();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($randomPassword);
        $user->save();
        return redirect('/login')->with('success', 'Đăng ký thành công! Vui lòng kiểm tra email để lấy mật khẩu.');

    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
