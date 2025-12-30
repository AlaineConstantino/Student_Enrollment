<section>
    <header style="margin-bottom: 1.5rem;">
        <h2 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 0.5rem;">
            {{ __('Delete Account') }}
        </h2>

        <p style="font-size: 0.875rem; color: #6b7280; line-height: 1.5;">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button 
        type="button"
        class="btn btn-danger"
        onclick="document.getElementById('deleteModal').style.display='flex'"
    >
        {{ __('Delete Account') }}
    </button>

    <!-- Delete Modal -->
    @if($errors->userDeletion->isNotEmpty())
        <style>
            #deleteModal { display: flex !important; }
        </style>
    @endif
    <div 
        id="deleteModal" 
        style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5); align-items: center; justify-content: center; z-index: 9999; padding: 1rem; display: none;"
    >
        <div style="
            background: white;
            border-radius: 1rem;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        ">
            <form method="post" action="{{ route('profile.destroy') }}" style="padding: 2rem;">
                @csrf
                @method('delete')

                <h2 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 0.75rem;">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p style="font-size: 0.875rem; color: #6b7280; line-height: 1.5; margin-bottom: 1.5rem;">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="form-group">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input
                        id="password" 
                        name="password" 
                        type="password" 
                        class="form-control" 
                        placeholder="{{ __('Password') }}"
                        required
                    />
                    @error('password', 'userDeletion')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                    <button 
                        type="button" 
                        class="btn btn-secondary"
                        onclick="document.getElementById('deleteModal').style.display='none'"
                    >
                        {{ __('Cancel') }}
                    </button>

                    <button type="submit" class="btn btn-danger">
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Close modal when clicking outside
        document.getElementById('deleteModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('deleteModal');
                if (modal) modal.style.display = 'none';
            }
        });
    </script>
</section>