<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname'    => 'required|max:255',
            'lname'    => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'pword'    => 'required|min:6|confirmed',
            'bdate'    => 'required|date',
            // 'gender'   => 'required',
            // 'address'  => 'required',
            // 'saddress' => 'required',
            // 'phone'    => 'required',
            // 'mobile'   => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name'       => $data['fname'],
            'last_name'        => $data['lname'],
            'email'            => $data['email'],
            'password'         => Hash::make($data['pword']),
            'birthdate'        => $data['bdate'],
            'gender'           => $data['gender'],
            'address'          => $data['address'],
            'shipping_address' => $data['saddress'],
            'phone'            => $data['phone'],
            'mobile'           => $data['mobile']
        ]);
    }

    protected function authenticated($request, $user)
    {
        if ($user->is_admin === '1') {
            return redirect()->intended('/admin/home');
            exit();
        }

        return redirect()->intended('/');
    }
}
