<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Blogpost;
use App\Models\Category;
use App\Models\Author;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
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
        return view('login', ['categories' => $this->getCategories(), 'recent_posts' => $this->getRecents()]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
