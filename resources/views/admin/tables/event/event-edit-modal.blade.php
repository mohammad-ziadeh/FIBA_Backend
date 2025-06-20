<!-- resources/views/admin/tables/event/event-edit-modal.blade.php -->
@if (isset($event))
    <div class="modal fade" id="editEventModal{{ $event->id ?? '' }}" tabindex="-1" role="dialog"
        aria-labelledby="editEventModalLabel{{ $event->id ?? '' }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background-color: #ffffff; border-radius: 8px;">
                <div class="modal-header border-bottom-0" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="modal-title" id="editEventModalLabel{{ $event->id }}"
                        style="color: #000000; font-weight: 600;">
                        Edit Event
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="color: #000000;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" action="{{ route('events.update', $event->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body" style="padding: 0 1.5rem 1rem;">

                        <!-- Title -->
                        <div class="form-group mb-3">
                            <label for="title" class="form-label" style="color: #000000;">Title</label>
                            <input type="text" class="form-control" name="title"
                                value="{{ old('title', $event->title) }}" required
                                style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.4rem 0.75rem;">
                        </div>

                        <!-- Location -->
                        <div class="form-group mb-3">
                            <label for="location" class="form-label" style="color: #000000;">Location</label>
                            <input type="text" class="form-control" name="location"
                                value="{{ old('location', $event->location) }}" required
                                style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                        </div>

                        <!-- Date Range -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label" style="color: #000000;">Start Date</label>
                                <input type="date" class="form-control" name="start_date"
                                    value="{{ old('start_date', optional($event->start_date)->format('Y-m-d')) }}"
                                    required
                                    style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label" style="color: #000000;">End Date</label>
                                <input type="date" class="form-control" name="end_date"
                                    value="{{ old('end_date', optional($event->end_date)->format('Y-m-d')) }}" required
                                    style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                            </div>
                        </div>

                        <!-- Event Code -->
                        <div class="form-group mb-3">
                            <label for="event_code" class="form-label" style="color: #000000;">Event Code</label>
                            <input type="text" class="form-control" name="event_code"
                                value="{{ old('event_code', $event->event_code) }}" required
                                style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                        </div>

                        <!-- Image Upload -->
                        <div class="form-group mb-3">
                            <label for="image" class="form-label" style="color: #000000;">Upload New Image
                                (Optional)</label>
                            <input type="file" class="form-control" name="image"
                                style="border: 1px solid #ced4da; border-radius: 4px; padding: 0.375rem 0.75rem;">
                            <small class="form-text text-muted" style="font-size: 0.85rem; margin-top: 0.25rem;">
                                Please upload an image with max width 330px and max height 220px.( <a
                                    style="color: #007bff" href="https://imageresizer.com/" target="_blank">you can do it here </a>)
                            </small>
                            @if ($event->image_url)
                                <div class="mt-2">
                                    <p>Current Image:</p>
                                    <img src="{{ $event->image_url }}" alt="Current Image" width="100">
                                </div>
                            @endif
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
                            Update Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endif
