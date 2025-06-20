<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl" style="color: #3b1e54;">{{ __('Events') }}</h2>
        @include('components.breadcrumbs', [
            'breadcrumbs' => ['Dashboard' => route('dashboard'), 'Events' => route('events.index')],
        ])
    </x-slot>

    @include('components.alerts')

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" style="margin-top: 50px">
        <div class="p-4 sm:p-8 bg-white shadow rounded-lg">

            <!-- Filters -->
            <form method="GET" action="{{ route('events.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="title" class="form-control" placeholder="Search Title"
                            value="{{ request('title') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="event_code" class="form-control">
                            <option value="all">All Codes</option>
                            <option value="#3X3WT" {{ request('event_code') == '#3X3WT' ? 'selected' : '' }}>#3X3WT
                            </option>
                            <option value="#SUMMER" {{ request('event_code') == '#SUMMER' ? 'selected' : '' }}>#SUMMER
                            </option>
                            <option value="#FINAL" {{ request('event_code') == '#FINAL' ? 'selected' : '' }}>#FINAL
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="deleted" class="form-control">
                            <option value="">Active Events</option>
                            <option value="only" {{ request('deleted') == 'only' ? 'selected' : '' }}>Deleted Events
                            </option>
                            <option value="with" {{ request('deleted') == 'with' ? 'selected' : '' }}>All Events
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sort" class="form-control">
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Sort ASC</option>
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Sort DESC</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-5" style="gap: 10px;">
                        <button type="submit" class="btn btn-primary w-20">Filter</button>

                        <a href="{{ route('events.index') }}" class="btn btn-secondary w-20">Reset</a>
                    </div>
                </div>
            </form>

            <!-- Add New Event Button -->
            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#createEventModal">
                Add New Event
            </button>

            <!-- Cards Grid -->
            <div class="d-flex flex-wrap gap-4 justify-content-start">
                @forelse ($events as $event)
                    <div class="card position-relative shadow-sm" style="width: 330px;">
                        <img style="width: 330px; height: 220px;"
                            src="{{ !empty($event->image_url) ? $event->image_url : 'https://via.placeholder.com/600x220' }}"
                            class="card-img-top" alt="Event Image">


                        <!-- Event Code Badge -->
                        <div class="position-absolute" style="top: -15px; left: 10px;">
                            <span class="badge badge-dark px-3 py-2"
                                style="font-size: 1.25rem; padding: 0.75rem 1.25rem;">{{ $event->event_code }}</span>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text">
                                <strong>Location:</strong> {{ $event->location }}<br>
                                <strong>Dates:</strong>
                                {{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') }} to
                                {{ \Carbon\Carbon::parse($event->end_date)->format('Y-m-d') }}

                            </p>

                            <!-- Actions -->
                            <div class="d-flex justify-content-between mt-3">
                                @if (!$event->trashed())
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#editEventModal{{ $event->id }}">
                                        Edit
                                    </button>
                                    <form id="delete-form-{{ $event->id }}"
                                        action="{{ route('events.destroy', $event->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmDelete({{ $event->id }})">Delete</button>
                                    </form>
                                @else
                                    <form action="{{ route('events.restore', $event->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-info text-white">Restore</button>
                                    </form>
                                    <form id="perDelete-form-{{ $event->id }}"
                                        action="{{ route('events.deletePermanently', $event->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-secondary"
                                            onclick="confirmPerDelete({{ $event->id }})">Delete Forever</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No events found.</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $events->links() }}
            </div>
        </div>
    </div>

    <!-- Include Modals Once -->
    @include('admin.tables.event.event-create-modal')


    @foreach ($events as $event)
        <!-- Your event card or table row -->
        @include('admin.tables.event.event-edit-modal', ['event' => $event])
    @endforeach



    <!-- External Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">

    <!-- SweetAlert Confirmation Scripts -->
    <script>
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
                    document.querySelector('#delete-form-' + id).submit();
                }
            });
        }

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
                    document.querySelector('#perDelete-form-' + id).submit();
                }
            });
        }

        // Fade alerts after 3 seconds
        $(document).ready(function() {
            setTimeout(() => {
                $('#successMessage').fadeOut('slow');
                $('#errorMessage').fadeOut('slow');
            }, 3000);
        });

        // Datepicker
        $(function() {
            $('input[name="start_date"]').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true
            });

            $('input[name="end_date"]').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
</x-app-layout>
