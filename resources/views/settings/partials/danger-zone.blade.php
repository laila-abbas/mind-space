<section class="space-y-6">
    <x-section-header description="{{ __('settings.danger_zone_desc') }}" h2color="text-red-600" pcolor='text-gray-600'>
        {{ __('settings.danger_zone') }}
    </x-section-header>

    <div x-data="{ confirm: false }">
        <div class="flex flex-col lg:flex-row justify-start pt-4 gap-3">
            <div>
                <button
                    type="button"
                    @click="confirm = true"
                    class="px-4 py-2 border border-red-500 text-red-600 rounded-lg hover:bg-red-100 cursor-pointer"
                >
                    {{ __('settings.delete_account_button') }}
                </button>
            </div>
            <p class="text-sm text-gray-600 max-w-xl">
                {{ __('settings.delete_account_desc') }}
            </p>
        </div>

        <div
            x-show="confirm"
            x-cloak
            class="fixed inset-0 flex items-center justify-center bg-bg-overlay z-50"
        >
            <div class="bg-bg-surface rounded-xl p-6 max-w-md w-full">
                <h3 class="text-lg font-semibold text-red-600">
                    {{ __('settings.delete_account_confirm_title') }}
                </h3>

                <p class="mt-3 text-sm text-gray-500">
                    {{ __('settings.delete_account_confirm_text') }}
                </p>

                <div class="mt-6 flex justify-center gap-4">
                    <button
                        type="button"
                        @click="confirm = false"
                        class="w-35 px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors cursor-pointer font-medium"
                    >
                        {{ __('settings.cancel') }}
                    </button>

                    <x-forms.form method="POST" action="{{ route('account.destroy') }}">
                        @csrf
                        @method('DELETE')

                        <button
                            class="px-4 py-2 text-red-600 hover:text-red-700 hover:underline cursor-pointer font-medium"
                        >
                            {{ __('settings.delete_account_confirm_button') }}
                        </button>
                    </x-forms.form>
                </div>
            </div>
        </div>
    </div>
    {{-- add deactivate account later --}}
</section>
