<x-layout>
    <x-form title="Login" description="Glad to have you back!">
        <form action="/login" method="post" class="mt-8 space-y-5">
            @csrf
            <x-form.field name="email" label="Email Address" type="email" autocomplete="email" required />
            <x-form.field name="password" label="Password" type="password" autocomplete="current-password" required />

            <button type="submit" class="inline-flex w-full items-center justify-center rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-900 transition-colors cursor-pointer" data-test = "login-button">
                Sign In
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-zinc-500">
            Don't have an account?
            <a href="/register" class="font-medium text-zinc-900 hover:underline">
                Register
            </a>
        </p>
    </x-form>
</x-layout>
