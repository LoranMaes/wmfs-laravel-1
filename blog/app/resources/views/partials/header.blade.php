<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
            <div style="display:flex; flex-direction: column; align-items: flex-start; gap: 1.2rem;">
                @auth
                <p style="margin: 0; font-weight: bold;">Welcome {{ Auth::user()->first_name }}</p>
                <a class="link-secondary" href="{{ url('/blogposts/create') }}">Add a blogpost</a>
                @endauth
            </div>
        </div>
        <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="{{ url('/') }}">Blogotopia</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
            <a class="link-secondary" href="{{ url('/blogposts/search/') }}" aria-label="Search">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img"
                    viewBox="0 0 24 24">
                    <title>Search</title>
                    <circle cx="10.5" cy="10.5" r="7.5" />
                    <path d="M21 21l-5.2-5.2" />
                </svg>
            </a>
            @guest
            <a class="btn btn-sm btn-outline-secondary" href="{{ url('register') }}">Sign up</a>
            <a class="btn btn-sm btn-outline-secondary ml-1" href="{{ url('login') }}">Sign in</a>
            @endguest
            @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-secondary">Logout</button>
            </form>
            @endauth
        </div>
    </div>
</header>
<div class="container">
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            @foreach ($categories as $category)
            <a class="p-2 link-secondary" href="{{ url('/categories/' . $category->id) }}">{{ $category->title }}</a>
            @endforeach
        </nav>
    </div>
</div>