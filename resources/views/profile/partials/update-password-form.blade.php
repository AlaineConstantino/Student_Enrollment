<!-- File: resources/views/profile/partials/update-password-form.blade.php -->
<section>
    <header style="margin-bottom: 1.5rem;">
        <h2 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 0.5rem;">
            {{ __('Update Password') }}
        </h2>

        <p style="font-size: 0.875rem; color: #6b7280; line-height: 1.5;">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
            <input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="form-control" 
                autocomplete="current-password"
            />
            @error('current_password', 'updatePassword')
                <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
            <input 
                id="update_password_password" 
                name="password" 
                type="password" 
                class="form-control" 
                autocomplete="new-password"
            />
            @error('password', 'updatePassword')
                <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="form-control" 
                autocomplete="new-password"
            />
            @error('password_confirmation', 'updatePassword')
                <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
            @enderror
        </div>

        <div style="display: flex; align-items: center; gap: 1rem;">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p 
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    style="font-size: 0.875rem; color: #059669; font-weight: 500;"
                >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>