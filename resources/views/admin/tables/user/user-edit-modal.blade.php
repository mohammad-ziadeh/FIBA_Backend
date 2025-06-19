<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #ffffff; border-radius: 8px;">
            <div class="modal-header border-bottom-0" style="padding: 1.5rem 1.5rem 0;">
                <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}"
                    style="color: #000000; font-weight: 600;">
                    Edit User
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #000000;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body" style="padding: 0 1.5rem 1rem;">
                    <!-- First Name -->
                    <div class="form-group mb-3">
                        <label for="first_name" class="form-label" style="color: #000000;">First Name</label>
                        <input type="text" class="form-control" name="first_name"
                            value="{{ old('first_name', $user->first_name) }}" required
                            style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                    </div>

                    <!-- Last Name -->
                    <div class="form-group mb-3">
                        <label for="last_name" class="form-label" style="color: #000000;">Last Name</label>
                        <input type="text" class="form-control" name="last_name"
                            value="{{ old('last_name', $user->last_name) }}" required
                            style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label for="email" class="form-label" style="color: #000000;">Email</label>
                        <input type="email" class="form-control" name="email"
                            value="{{ old('email', $user->email) }}" required
                            style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-3">
                        <label for="password" class="form-label" style="color: #000000;">
                            Password <small class="text-muted">(leave blank to keep current)</small>
                        </label>
                        <input type="password" class="form-control" name="password" placeholder="••••••••"
                            style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                    </div>

                    <!-- Phone -->
                    <div class="form-group mb-3">
                        <label for="phone" class="form-label" style="color: #000000;">Phone</label>
                        <input type="text" class="form-control" name="phone"
                            value="{{ old('phone', $user->phone) }}"
                            style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                    </div>

                    <div class="form-group">
                        <label for="birth_date">Birth Date</label>
                        <input type="date" class="form-control" name="birth_date"
                            value="{{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d') : '' }}"
                            style="border-radius: 5px;">
                    </div>

                    <!-- Gender -->
                    <div class="form-group mb-3">
                        <label for="gender" class="form-label" style="color: #000000;">Gender</label>
                        <select name="gender" class="form-control" required
                            style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <!-- Role -->
                    <div class="form-group mb-3">
                        <label for="role" class="form-label" style="color: #000000;">Role</label>
                        <select name="role" class="form-control" required
                            style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                            <option value="player" {{ $user->role == 'player' ? 'selected' : '' }}>Player</option>
                            <option value="coach" {{ $user->role == 'coach' ? 'selected' : '' }}>Coach</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer border-top-0 d-flex justify-content-end gap-2"
                    style="padding: 0 1.5rem 1.5rem;">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"
                        style="color: #495057; border-color: #ced4da; background: transparent; border-radius: 4px;">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary"
                        style="background-color: #007bff; color: white; border: none; border-radius: 4px;">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .form-control {
        font-size: 1rem;
        color: #000;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
    }

    .btn {
        font-weight: 500;
    }
</style>
