<div class="modal fade" id="createMatchupModal{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="createMatchupModalLabel{{ $event->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Matchup</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="POST" action="{{ route('matchups.store') }}">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">

                <div class="modal-body">
                    <div class="form-group">
                        <label>Team A</label>
                        <select name="team_a_id" class="form-control" required>
                            <option value="">Select Team A</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Team B</label>
                        <select name="team_b_id" class="form-control" required>
                            <option value="">Select Team B</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Match Time (optional)</label>
                        <input type="datetime-local" name="match_time" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Location (optional)</label>
                        <input type="text" name="location" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Round (e.g., Semi Final)</label>
                        <input type="text" name="round" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Matchup</button>
                </div>
            </form>
        </div>
    </div>
</div>
