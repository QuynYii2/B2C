<?php

namespace App\Http\Controllers;

use App\Enums\StatisticStatus;
use App\Libraries\GeoIP;
use App\Models\StatisticAccess;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function saveLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $geoIp = new GeoIP();
        $locale = $geoIp->get_country_from_ip($request->ip());

        if (Auth::attempt($credentials)) {
            $statistic = [
                'user_id' => Auth::user()->id,
                'numbers' => 1,
                'country' => $locale
            ];
            StatisticAccess::create($statistic);
            return redirect()->intended('/');
        } else {
            return redirect()->route('login')->with('error', 'Email hoặc mật khẩu không chính xác');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function saveRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => ['required', 'string', 'regex:/^\d{10}$/'],
            'address' => 'required|min:6',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công!');
    }
}
