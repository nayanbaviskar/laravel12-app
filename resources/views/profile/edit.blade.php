<x-layout>
    <x-form title="Edit your Profile" description="Need to make some tweak?">
        @if (session('success'))
            <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50/80 p-4 text-sm text-emerald-800 shadow-xs backdrop-blur-xs flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="post" class="mt-8 space-y-5">
            @csrf
            @method('PATCH')
            <x-form.field name="name" label="Full Name" type="text" autocomplete="name" :value="$user->name" required />
            <x-form.field name="email" label="Email Address" type="email" autocomplete="email" :value="$user->email"
                required />
            <x-form.field name="password" label="New Password" type="password" autocomplete="new-password" />

            <button type="submit" class="btn btn-primary w-full py-2.5">
                Update Account
            </button>
        </form>
    </x-form>
</x-layout>
