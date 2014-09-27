<?php namespace Pingpong\Admin\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Pingpong\Admin\Validation\Auth\Login;

class LoginController extends Controller {

    /**
     * @var Login
     */
    protected $validator;

    /**
     * @param Login $validator
     */
    public function __construct(Login $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @return mixed
     */
    public function getIndex()
    {
        return aview('auth.login');
    }

    /**
     * @return mixed
     */
    public function postIndex()
    {
        $this->validator->validate();

        if (Auth::attempt(Input::only('username', 'password'), Input::has('remember')))
        {
            return app('redirect')->route('admin.home')->withSuccess('Login success');
        }

        return app('redirect')->back()->withError("Login failed");
    }

} 