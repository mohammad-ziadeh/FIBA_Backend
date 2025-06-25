{{-- resources/views/admin/tables/matchups/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl" style="color: #3b1e54;">{{ __('Event Matchups') }}</h2>
        @include('components.breadcrumbs', [
            'breadcrumbs' => ['Dashboard' => route('dashboard'), 'Matchups' => route('matchups.index')],
        ])
    </x-slot>

    @include('components.alerts')

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" style="margin-top: 50px;">
        <!-- Filters -->
        <form method="GET" action="{{ route('matchups.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="title" class="form-control" placeholder="Search Event Title"
                        value="{{ request('title') }}">
                </div>
                <div class="col-md-2">
                    <select name="event_code" class="form-control">
                        <option value="">All Event Codes</option>
                        <option value="#3X3WT" {{ request('event_code') == '#3X3WT' ? 'selected' : '' }}>#3X3WT</option>
                        <option value="#SUMMER" {{ request('event_code') == '#SUMMER' ? 'selected' : '' }}>#SUMMER
                        </option>
                        <option value="#FINAL" {{ request('event_code') == '#FINAL' ? 'selected' : '' }}>#FINAL</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort" class="form-control">
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Sort ASC</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Sort DESC</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="filter" class="form-control">
                        <option value="">All Dates</option>
                        <option value="upcoming" {{ request('filter') == 'upcoming' ? 'selected' : '' }}>Upcoming
                        </option>
                        <option value="past" {{ request('filter') == 'past' ? 'selected' : '' }}>Past</option>
                        <option value="ongoing" {{ request('filter') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2" style="gap: 10px;">
                    <button type="submit" class="btn btn-primary flex-grow-1">Filter</button>
                    <a href="{{ route('matchups.index') }}" class="btn btn-secondary flex-grow-1">Reset</a>
                </div>

            </div>
        </form>

        @forelse ($events as $event)
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center"
                    style="color: white; background-color:rgb(61, 61, 61)">
                    <div>
                        <h5 class="mb-0">{{ $event->title }}</h5>
                        <small style="color: #eeeeee">{{ $event->event_code }} | {{ $event->location }} |
                            {{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') }} -
                            {{ \Carbon\Carbon::parse($event->end_date)->format('Y-m-d') }}</small>
                    </div>
                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#createMatchupModal{{ $event->id }}">
                        + Create Matchup
                    </button>
                </div>
                <div class="card-body">
                    @if ($event->matchups->isEmpty())
                        <p class="text-muted">No matchups yet for this event.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Team A</th>
                                        <th>VS</th>
                                        <th>Team B</th>
                                        <th>Match Time</th>
                                        <th>Round</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($event->matchups as $matchup)
                                        <tr>
                                            <td>{{ $matchup->teamA->name }}</td>
                                            <td class="text-center fw-bold">VS</td>
                                            <td>{{ $matchup->teamB->name }}</td>
                                            <td>{{ $matchup->match_time ? \Carbon\Carbon::parse($matchup->match_time)->format('Y-m-d H:i') : '—' }}
                                            </td>
                                            <td>{{ $matchup->round ?? '—' }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#editMatchupModal{{ $matchup->id }}">
                                                    Edit
                                                </button>
                                                <form method="POST" id="delete-form-{{ $matchup->id }}"
                                                    action="{{ route('matchups.destroy', $matchup->id) }}"
                                                    class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="confirmDelete({{ $matchup->id }})" type="button"
                                                        class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        @include('admin.tables.matchups.matchup-edit-modal', [
                                            'matchup' => $matchup,
                                            'teams' => $event->teams,
                                        ])
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            @foreach ($events as $event)
                @include('admin.tables.matchups.matchup-create-modal', [
                    'event' => $event,
                    'teams' => $event->teams,
                ])
            @endforeach
        @empty
            <p class="text-muted">No events with matchups found.</p>
        @endforelse


        @include('components.pagination', ['pag' => $events])

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">

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
        </script>
</x-app-layout>
