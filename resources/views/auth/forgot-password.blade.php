<x-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg border border-primary">
            <h1 class="text-xl font-semibold mb-6 text-center">
                Reset your password
            </h1>

            @if (session('status'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
                    {{ session('status') }}
                </div>
            @endif
    
            <x-forms.form method="POST" action="{{ route('password.email') }}">
                <x-forms.input label="Email" name="email" type="email" :value="request('email')" />
                <x-forms.button>
                    Send Reset Link
                </x-forms.button>
            </x-forms.form>
        </div>
    </div>
</x-layout>
