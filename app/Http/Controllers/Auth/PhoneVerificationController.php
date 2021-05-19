<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Notifications\ActiveCodeNotification;
use Illuminate\Http\Request;


class PhoneVerificationController extends Controller
{
    /**
     * Display the phone verification view.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function notice(Request $request)
    {
        $request->session()->reflash();
        return view('auth.verify-phone');
    }


    /**
     * Mark the authenticated user's phone number as verified.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        if(! $request->session()->has('phone')) {
            return redirect('profile');
        }


        $status = ActiveCode::verifyCode($request->code , $request->user());

        if($status) {
            $request->user()->activeCode()->delete();
            $request->user()->update([
                'phone' => $request->session()->get('phone'),
            ]);
        } else {
            $request->session()->reflash();
            return back()->withErrors('The code is invalid or has expired');
        }

        return redirect('profile')->with('status', 'Profile Updated.');
    }

    /**
     * Send a new sms verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request)
    {
        // create a new code
        $code = ActiveCode::generateCode($request->user());
        $phone = $request->session()->get('phone');
        $request->session()->reflash();
        // send the code to user phone number
        $request->user()->notify(new ActiveCodeNotification($code , $phone));

        return redirect(route('auth.verify-phone'));
    }
}
