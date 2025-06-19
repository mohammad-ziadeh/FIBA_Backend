<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl" style="color: #3b1e54;">{{ __('Users') }}</h2>
        @include('components.breadcrumbs')
    </x-slot>

    @include('components.alerts')

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" style="margin-top: 50px">
        <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
            <form method="GET" action="{{ route('users.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="name" class="form-control" placeholder="Search Name"
                            value="{{ request('name') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="role" class="form-control">
                            <option value="all">All Roles</option>
                            <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student
                            </option>
                            <option value="trainer" {{ request('role') == 'trainer' ? 'selected' : '' }}>Trainer
                            </option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="gender" class="form-control">
                            <option value="all">All Genders</option>
                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="deleted" class="form-control">
                            <option value="">Active Users</option>
                            <option value="only" {{ request('deleted') == 'only' ? 'selected' : '' }}>Deleted Users
                            </option>
                            <option value="with" {{ request('deleted') == 'with' ? 'selected' : '' }}>All Users
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>

            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#createUserModal">
                Add New User
            </button>

            <div class="table-responsive">
                <table class="table table-bordered border-primary">
                    <thead>
                        <tr>
                            <th><a
                                    href="{{ route('users.index', array_merge(request()->except('sort'), ['sort' => 'desc'])) }}">#
                                    ↓</a></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Birth Date</th>
                            <th>Joining Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{!! $user->gender === 'male' ? '<i class="fa-solid fa-mars"></i>' : '<i class="fa-solid fa-venus"></i>' !!} {{ $user->first_name . ' ' . $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge badge-{{ $user->role_badge }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>{{ $user->birth_date }}</td>
                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @if (!$user->trashed())
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#editUserModal{{ $user->id }}">Edit</button>
                                        <form id="delete-form-{{ $user->id }}"
                                            action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $user->id }})">Delete</button>
                                        </form>
                                    @else
                                        <form action="{{ route('users.restore', $user->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm">Restore</button>
                                        </form>
                                        <form id="perDelete-form-{{ $user->id }}"
                                            action="{{ route('users.deletePermanently', $user->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmPerDelete({{ $user->id }})">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>

                            @include('admin.tables.user.user-edit-modal', ['user' => $user])
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    @include('admin.tables.user.user-create-modal')


<!-- External Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script src="https://cdn.jsdelivr.net/npm/intro.js@4/intro.min.js"></script> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intro.js@4/themes/introjs.css"> 

<!-- Custom Scripts -->
<script>
    // Confirm Delete (Soft Delete)
    function confirmDelete(id) {
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Confirm Permanent Delete
    function confirmPerDelete(id) {
        Swal.fire({
            title: "Delete permanently?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('perDelete-form-' + id).submit();
            }
        });
    }

    // Fade alerts after 3 seconds
    $(document).ready(function () {
        setTimeout(() => {
            $('#successMessage').fadeOut('slow');
            $('#errorMessage').fadeOut('slow');
        }, 3000);
    });

    // Optional: Tour Button
    function startTour() {
        introJs().start();
    }
</script>
</x-app-layout>
