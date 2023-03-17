<?php

namespace App\Http\Controllers\Backend;

use App\Rules\Backend\CheckRoleRule;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/backend';
    protected $redirect_name = 'backend.orders.index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->redirectTo = '/'.env('BACKEND_URI');
        $this->middleware('guest:admin')->except('logout');
    }

	/**
	 * Show form for admins login
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	 */
    public function showLoginForm(){
	    if (auth('admin')->user()) {
		    return redirect(route($this->redirect_name));
	    }
        return view('backend.auth.login');
    }

	/**
	 * Check activity and role for admin
	 * @param Request $request
	 */
	protected function validateLogin(Request $request)
	{
		$this->validate($request, [
			$this->username() => ['required',
			                      'exists:users,' . $this->username() . ',active,1',
                                  new CheckRoleRule()
			],
			'password' => 'required',

		], [
			$this->username() . '.exists' => __('backend.disabled_user')
		]);
	}

	/**
	 * Login for admins
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function login(Request $request)
	{
		$this->validateLogin($request);

		if (Auth::guard('admin')
			->attempt(
				[
					'email'    => $request->email,
					'password' => $request->password,
					'active' => 1
				], $request->remember
			)) {
			return redirect(route($this->redirect_name));
		}

		return back()->with('danger', __('backend.auth_failed'));
	}

	/**
	 * Logout for admins
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function logout(Request $request)
	{
		Auth::guard('admin')->logout();

		return redirect()->route($this->redirect_name);
	}
}
