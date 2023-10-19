<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Blogpost;
use App\Models\Category;
use App\Models\Author;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */

    private static function getRecents()
    {
        return Blogpost::orderByDesc('created_at')->limit(10)->get()->pluck('title', 'id');
    }

    private static function getCategories()
    {
        return Category::orderBy('id')->get();
    }

    private static function getAuthors()
    {
        return Author::orderBy('id')->get();
    }
    public function create(): View
    {
        return view('register', ['categories' => $this->getCategories(), 'recent_posts' => $this->getRecents()]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Author::class],
            'website' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Author::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'website' => $request->website,
            'location' => $request->location,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
