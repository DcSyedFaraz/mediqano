<section>
    <header class="mb-4">
        <h2 class="fs-4 fw-semibold text-dark dark:text-light">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 small text-muted">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">
                {{ __('Current Password') }}
            </label>
            <input type="password" class="form-control" id="update_password_current_password" name="current_password"
                autocomplete="current-password" />
            <div class="text-danger small mt-1">
                <x-input-error :messages="$errors->updatePassword->get('current_password')" />
            </div>
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">
                {{ __('New Password') }}
            </label>
            <input type="password" class="form-control" id="update_password_password" name="password"
                autocomplete="new-password" />
            <div class="text-danger small mt-1">
                <x-input-error :messages="$errors->updatePassword->get('password')" />
            </div>
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">
                {{ __('Confirm Password') }}
            </label>
            <input type="password" class="form-control" id="update_password_password_confirmation"
                name="password_confirmation" autocomplete="new-password" />
            <div class="text-danger small mt-1">
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="small text-muted">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
