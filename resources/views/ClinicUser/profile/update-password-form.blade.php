<section>


    @if (session('status') === 'password-updated')
    <div class="bg-green-200 p-4 rounded-md">
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-green-500 font-bold">{{ __('Your password has been updated successfully.') }}</p>
    </div>
    @endif


    <form method="post" action="{{ route('clinic.password.update') }}" class="mt-6 space-y-4">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_clinic_current_password" :value="__('Current Password')" />
            <x-text-input id="update_clinic_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="bg-red-200 px-4 py-2 mt-2" />

        </div>

        <div>
            <x-input-label for="update_clinic_password" :value="__('New Password')" />
            <x-text-input id="update_clinic_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="bg-red-200 px-4 py-2 mt-2" />
        </div>

        <div>
            <x-input-label for=" update_clinic_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_clinic_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="bg-red-200 px-4 py-2 mt-2" />
        </div>

        <div class="flex items-center justify-end gap-4">
            <button class="bg-sky-500 shadow-lg px-6 py-2 rounded text-white font-bold hover:bg-sky-400">{{ __('Update Password') }}</button>
        </div>
    </form>
</section>