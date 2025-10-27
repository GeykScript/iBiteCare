<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\ClinicUser;
use App\Models\ClinicUserRole;
use App\Models\ClinicUserLogs;

class ClinicUserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'account_id' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];  
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $accountId = $this->input('account_id');
        $password = $this->input('password');

        // 1. Try to find the user by account_id
        $clinic_user = ClinicUser::where('account_id', $accountId)->first();

        if (! $clinic_user) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'account_id' => 'This account ID is not registered.',
            ]);
        }

        // 2. Check if account is disabled
        if ($clinic_user->is_disabled) {
            throw ValidationException::withMessages([
                'account_id' => 'This account is currently unavailable.',
            ]);
        }

        // 3. If found, check password manually
        if (! Hash::check($password, $clinic_user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'password' => 'Incorrect password.',
            ]);
        }

        ClinicUserLogs::create([
            'user_id' => $clinic_user->id,
            'role_id' => $clinic_user->role,
            'action' => 'Login to system',
            'details' => 'Clinic user logged in.',
            'date_and_time' => now(),
        ]);
        // 4. If all checks pass, log in
        Auth::guard('clinic_user')->login($clinic_user, $this->boolean('remember'));

        RateLimiter::clear($this->throttleKey());
    }



    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'account_id' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('account_id')) . '|' . $this->ip());
    }
}
