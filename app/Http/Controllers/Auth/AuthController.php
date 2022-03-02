<?php namespace Phpleaks\Http\Controllers\Auth;

use Phpleaks\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Phpleaks\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers;

    protected $redirectPath = '/';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|alpha_num|max:50|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

}
