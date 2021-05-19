<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\ActiveCode;
use App\Models\User;
use App\Notifications\ActiveCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->validate($request,[
            'phone' => Rule::unique('users', 'phone')->ignore($user->id)
        ]);

        $user->update([
           'first_name' => $request->first_name,
           'last_name' => $request->last_name,
        ]);

        if($user->phone != $request->phone){
            // create a new code
            $code = ActiveCode::generateCode($request->user());
            $request->session()->flash('phone' , $request->phone);
            // send the code to user phone number
        $request->user()->notify(new ActiveCodeNotification($code , $request->phone));

            return redirect(route('auth.verify-phone'));
        }

        return redirect()->back()->with('status', 'Profile Updated.');
    }

    /**
     * Change Password
     */
    public function changePassword(ChangePasswordRequest $request,User $user)
    {
        if (! Auth::guard('web')->validate([
            'email' => $user->email,
            'password' => $request->current_password,
        ])){
            return redirect()->back()->withErrors('Please enter the password correctly');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('status', 'Password Updated Correctly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request,User $user)
    {
        $this->validate($request,[
            'password' => 'required|string'
        ]);

        if (! Auth::guard('web')->validate([
            'email' => $user->email,
            'password' => $request->password,
        ])){
            return redirect()->back()->withErrors('Please enter the password correctly');
        }

        $user->delete();

        return redirect('/');
    }
}
