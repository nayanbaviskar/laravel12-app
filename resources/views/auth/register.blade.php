<x-layout>
    <x-form title="Register an account" description="Create an account to get started.">
        <form action="/register" method="post" class="mt-8 space-y-5">
            @csrf
            <x-form.field name="name" label="Full Name" type="text" autocomplete="name" required />
            <x-form.field name="email" label="Email Address" type="email" autocomplete="email" required />
            <x-form.field name="password" label="Password" type="password" autocomplete="new-password" required />

            <button type="submit" class="btn btn-primary w-full py-2.5">
                Create Account
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-zinc-500">
            Already have an account?
            <a href="/login" class="font-medium text-zinc-900 hover:underline">
                Sign In
            </a>
        </p>
    </x-form>
</x-layout>
