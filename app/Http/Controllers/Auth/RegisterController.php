<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\ActiveCode;
use App\Models\User;
use App\Notifications\ActiveCodeNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function store(RegisterRequest $request)
    {
        Auth::login($user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]));

        // create a new code
        $code = ActiveCode::generateCode($request->user());
        $request->session()->flash('phone' , $request->phone);
        // send the code to user phone number
        $request->user()->notify(new ActiveCodeNotification($code , $request->phone));

        event(new Registered($user));

        return redirect(route('auth.verify-phone'));
    }
}
