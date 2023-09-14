<?php

namespace App\Http\Controllers;

use App\Jobs\SendForgotPass;
use App\Models\LoyalCustomer;
use App\Rules\CheckPass;
use App\Rules\UniqueEmail;
use App\Rules\CheckEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Jobs\SendRegistrationEmail;
use Mews\Captcha\Facades\Captcha;

class AccountController extends Controller
{
    public function index()
    {
        $captcha = Captcha::create('default', true);
        return view('account.login', compact('captcha'));
    }
    public function login(Request $request)
    {
        $loginAttempts = session('login_attempts', 0);

        if (session('login_attempts') >= 3) {
            $request->validate([
                'email' => 'required|email|max:100',
                'password' => 'required|min:8',
                'captcha' => 'required|captcha',
            ]);
        } else {
            $request->validate([
                'email' => 'required|email|max:100',
                'password' => 'required|min:8',
            ]);
        }

        $arr = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($arr)) {
            if (auth()->user()->password_change_required) {
                return redirect('/change_password');
            } else if (auth()->user()->detail_change) {
                return redirect('/user_detail');
            }
            session(['login_attempts' => 0]);
            return redirect()->route('dashboard');
        } else {
            $loginAttempts++;
            session(['login_attempts' => $loginAttempts]);

            if ($loginAttempts >= 3) {
                return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.'])->withInput()->withErrors(['captcha' => 'Xác thực CAPTCHA không chính xác.']);
            } else {
                return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.'])->withInput();
            }
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

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->flush();
        return redirect('/');
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
    public function userDetail(Request $request)
    {
        $request->validate([
            'gender' => 'required',
            'birth_date' => 'required',
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
    public function forgotPassword()
    {
        return view('account.forgotPassword');
    }
    public function updateForgotPass(Request $request)
    {
        $request->validate([
            'email' => ['required', 'max:255', 'email', new CheckEmail],
        ]);
        $user = LoyalCustomer::where('email', $request->input('email'))->first();
        $randomPassword = Str::random(10);
        $user->password = bcrypt($randomPassword);
        $user->password_change_required = true;
        $user->time_forgot = now();
        SendForgotPass::dispatch($user->email, $randomPassword, $user->name);
        $user->save();
        return redirect('/login');
    }
    public function viewChange()
    {
        $user = auth()->user();
        return view('account.change', compact('user'));
    }
    public function updateChange(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'min:8', new CheckPass],
            'new_password' => ['required', 'min:8'],
        ]);
        $user = auth()->user();
        $user->password = bcrypt($request->input('new_password'));
        $user->save();
        return redirect('/');
    }
}
