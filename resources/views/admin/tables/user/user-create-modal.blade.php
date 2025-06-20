<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Added modal-lg -->
        <div class="modal-content" style="background-color: #ffffff; border-radius: 8px;">
            <div class="modal-header border-bottom-0" style="padding: 1.5rem 1.5rem 0;">
                <h5 class="modal-title" id="createUserModalLabel" style="color: #000000; font-weight: 600;">
                    Add New User
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #000000;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="modal-body" style="padding: 0 1.5rem 1rem;">
                    <!-- First Name & Last Name -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label" style="color: #000000;">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"
                                required style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label" style="color: #000000;">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"
                                required style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label for="email" class="form-label" style="color: #000000;">Email Address</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required
                            style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-3">
                        <label for="password" class="form-label" style="color: #000000;">Password</label>
                        <input type="password" class="form-control" name="password" required
                            placeholder="••••••••"
                            style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                    </div>

                    <!-- Phone & Birth Date -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="phone" class="form-label" style="color: #000000;">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required
                                style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                        </div>
                        <div class="col-md-6">
                            <label for="birth_date" class="form-label" style="color: #000000;">Birth Date</label>
                            <input type="date" class="form-control" name="birth_date"
                                style="border-radius: 5px;">
                        </div>
                    </div>

                    <!-- Gender & Role -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="gender" class="form-label" style="color: #000000;">Gender</label>
                            <select name="gender" class="form-control" required
                                style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label" style="color: #000000;">Role</label>
                            <select name="role" class="form-control" required
                                style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                                <option value="player">Player</option>
                                <option value="coach">Coach</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top-0 d-flex justify-content-end gap-2"
                    style="padding: 0 1.5rem 1.5rem;">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"
                        style="color: #495057; border-color: #ced4da; background: transparent; border-radius: 4px;">
                        Close
                    </button>
                    <button type="submit" class="btn btn-success"
                        style="background-color: #28a745; color: white; border: none; border-radius: 4px;">
                        Create User
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