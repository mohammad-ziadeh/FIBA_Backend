@if(isset($matchup))
<div class="modal fade" id="editMatchupModal{{ $matchup->id }}" tabindex="-1" role="dialog" aria-labelledby="editMatchupModalLabel{{ $matchup->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Matchup</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="POST" action="{{ route('matchups.update', $matchup->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-group">
                        <label>Team A</label>
                        <select name="team_a_id" class="form-control" required>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" {{ $matchup->team_a_id == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Team B</label>
                        <select name="team_b_id" class="form-control" required>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" {{ $matchup->team_b_id == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Match Time</label>
                        <input type="datetime-local" name="match_time" class="form-control"
                            value="{{ $matchup->match_time ? \Carbon\Carbon::parse($matchup->match_time)->format('Y-m-d\TH:i') : '' }}">
                    </div>

                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" value="{{ $matchup->location }}">
                    </div>

                    <div class="form-group">
                        <label>Round</label>
                        <input type="text" name="round" class="form-control" value="{{ $matchup->round }}">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Matchup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
