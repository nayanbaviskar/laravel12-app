<nav class="border-b border-border px-6">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div>
            <a href="/">Idea</a>
        </div>
        <div flex gap-x-5 items-center>
            @guest
                <a href="/login">Sign In</a>
                <a href="/register" class="btn">Register</a>
            @endguest
            @auth
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="btn">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>