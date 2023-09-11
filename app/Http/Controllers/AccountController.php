<?php

namespace App\Http\Controllers;

use App\Models\LoyalCustomer;
use App\Rules\UniqueEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\JustTesting;
use App\Jobs\SendRegistrationEmail;

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

        if (Auth::attempt($arr)) {
            if (auth()->user()->password_change_required) {
                return redirect('/change_password');
            }
            else if (auth()->user()->detail_change) {
                return redirect('/user_detail');
            }
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
            'email' => ['required', 'max:255', 'email', new UniqueEmail],
        ]);
        $randomPassword = Str::random(10);

        $user = new LoyalCustomer();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($randomPassword);
        SendRegistrationEmail::dispatch($user->email, $randomPassword, $user->name);
        $user->save();
        return redirect('/login')->with('success', 'Đăng ký thành công! Vui lòng kiểm tra email để lấy mật khẩu.');

    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    public function change_password()
    {
        $user = auth()->user();
        return view('account.change_password', compact('user'));
    }
    public function updatePass(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'password' => 'required|min:8',
        ]);
        $user->password = bcrypt($request->input('password'));
        $user->password_change_required = false;
        $user->save();
        auth()->login($user);
        return redirect('/');
    }
    public function showDetail()
    {
        $user = auth()->user();
        return view('account.user_detail', compact('user'));
    }
    public function userDetail(Request $request) {
        $request->validate([
            'gender' => 'required',
            'birth_date' =>'required',
            'address' => 'required|string|max:255',
        ]);
        $detail = auth()->user();
        $detail->gender = $request->input('gender');
        $detail->birth_date = $request->input('birth_date');
        $detail->address = $request->input('address');
        $detail->detail_change = false;
        $detail->save();
        auth()->login($detail);
        return redirect('/');
    }
}
