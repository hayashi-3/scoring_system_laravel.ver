<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo() {
        $admin_flag = $this->guard()->user()->admin_flag;
        if($admin_flag === 1) {
            return 'admin/user';
        } else {
            return 'user/user';
        }
    } 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * email→idに認証を変更
     */
    public function username()
    {
        return 'id';
    }

    /**
     * ログアウトしたときの画面遷移先
     */
    protected function loggedOut(\Illuminate\Http\Request $request)
    {
        return redirect(route('login'));
    }
}
