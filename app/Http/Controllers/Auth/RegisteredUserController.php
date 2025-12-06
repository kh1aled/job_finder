<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imageName = time() . '.' . $request->avatar->extension();
    $request->avatar->move(public_path('storage/images'), $imageName);

    $validatedData['avatar'] = $imageName;
    $validatedData['password'] = Hash::make($request->password);

    $validatedData['email_verified_at'] = null;



    $user = User::create($validatedData);

    event(new Registered($user));

    Auth::login($user, false);

    return redirect()->route('jobs.index');
}

}
