<x-layout>
    <x-page-heading>Register</x-page-heading>
    <x-forms.form method='POST' action="{{ route('register.store') }}" x-data="{ isAuthor: {{ old('is_author') ? 'true' : 'false' }} }">
        <x-forms.input label='First Name' name='first_name' req />
        <x-forms.input label='Last Name' name='last_name' placeholder="Last Name (Optional)" />
        <x-forms.input label='Email' name='email' type='email' req />
        <x-forms.input label='Password' name='password' type='password' req strength />
        <x-forms.input label='Password Confirmation' name='password_confirmation' type='password' req placeholder='Re-enter your password' />

        <x-forms.checkbox name='is_author' label='Sign up as an Author' x-model='isAuthor' />

        <div x-show="isAuthor" x-transition class="space-y-4 mt-4">
            <x-forms.input label='Pen Name' name='pen_name' placeholder='Pen Name (Optional)' />
            <x-forms.input label='Biography' name='biography' type='textarea' placeholder='Biography... (Optional)' />
            <x-forms.input label='Website URL' name='website_url' type='url' placeholder='Website URL (Optional)' />
        </div>

        <x-forms.button>Create Account</x-forms.button>
    </x-forms.form>
</x-layout>