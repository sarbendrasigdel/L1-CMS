<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\LoginRequest;
use App\Library\CaptchaChecker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use CaptchaChecker;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {

        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        try {
            $response = $this->checkCaptcha($request);
            if ($response->success) {
                if ($request->ajax()) {
                    $username = $request->input('username');
                    $password = $request->input('password');
                    $rememberMe = $request->input('remember_me', 0);
                    if (Auth::guard('admin-user')->attempt(['username' => $username, 'password' => $password], $rememberMe)) {
                        $user = Auth::guard('admin-user')->user();
                        if ($user->active_status) {
                            $data['url'] = route('admin.dashboard');
                            $data['status'] = 'true';
                            $data['title'] = 'Admin Dashboard';
                            $data['message'] = 'Welcome To Admin Dashboard.';
                            $request->session()->put(array(
                                'title' => $data['title'],
                                'success_message' => $data['message']
                            ));
                        } else {
                            $data['status'] = 'false';
                            $data['message'] = 'Sorry ! Your account is disabled. please contact administrator.';
                        }
                    } else {
                        $data['status'] = 'false';
                        $data['message'] = 'Sorry ! Username or Password does not match.';
                    }
                }
            } else {
                $data['status'] = 'false';
                $data['message'] = 'Captcha error';
            }
        } catch (\Exception $e) {
            $data['status'] = 'false';
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    public function logout()
    {
        if (Auth::guard('admin-user')->check()) {
            Auth::guard('admin-user')->logout();
        }
        return redirect(route('admin.login'));
    }
}
