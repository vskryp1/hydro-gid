<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Users\UpdatePassRequest;

class ChangePasswordController extends Controller
{
    /**
     * Where to redirect users after changing their password.
     *
     * @var string
     */
    protected $redirectTo = '/backend';

    /**
     * Display the password reset view for the given token.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showChangePassForm()
    {
        $user_identity = auth()->user()->email ?: auth()->user()->phone;
        return view('backend.auth.passwords.change')->with('user_identity', $user_identity);
    }

    /**
     * @param UpdatePassRequest $request
     */
    public function changePassword(UpdatePassRequest $request)
    {
        $user = auth()->user();
        if ($user->{UpdatePassRequest::getUserIdentityField()} === $request->user_identity) {
            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect()
                ->route('backend.dashboard')
                ->with('success', ['text' => 'Your password successfully updated']);
        }
        return redirect()
            ->route('backend.dashboard')
            ->with('error', ['text' => 'User identity is not confirmed, update your page re-login']);
    }
}
