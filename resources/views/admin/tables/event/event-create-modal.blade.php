<!-- resources/views/admin/tables/event/event-create-modal.blade.php -->

<div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background-color: #ffffff; border-radius: 8px;">
            <div class="modal-header border-bottom-0" style="padding: 1.5rem 1.5rem 0;">
                <h5 class="modal-title" id="createEventModalLabel" style="color: #000000; font-weight: 600;">
                    Create New Event
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #000000;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="modal-body" style="padding: 0 1.5rem 1rem;">
                    <!-- Title -->
                    <div class="form-group mb-3">
                        <label for="title" class="form-label" style="color: #000000;">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                    </div>

                    <!-- Location -->
                    <div class="form-group mb-3">
                        <label for="location" class="form-label" style="color: #000000;">Location</label>
                        <input type="text" class="form-control" name="location" value="{{ old('location') }}"
                            required>
                    </div>

                    <!-- Date Range -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label" style="color: #000000;">Start Date</label>
                            <input type="text" class="form-control" name="start_date" value="{{ old('start_date') }}"
                                required placeholder="YYYY-MM-DD">
                        </div>

                        <div class="col-md-6">
                            <label for="end_date" class="form-label" style="color: #000000;">End Date</label>
                            <input type="text" class="form-control" name="end_date" value="{{ old('end_date') }}"
                                required placeholder="YYYY-MM-DD">
                        </div>


                    </div>

                    <!-- Event Code -->
                    <div class="form-group mb-3">
                        <label for="event_code" class="form-label" style="color: #000000;">Event Code</label>
                        <input type="text" class="form-control" name="event_code" value="{{ old('event_code') }}"
                            required>
                    </div>

                    <!-- Image Upload -->
                    <div class="form-group mb-3">
                        <label for="image" class="form-label" style="color: #000000;">Upload Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                     <small class="form-text text-muted" style="font-size: 0.85rem; margin-top: 0.25rem;">
                                Please upload an image with max width 330px and max height 220px.( <a style="color: #007bff" href="https://imageresizer.com/" target="_blank">you can do it here </a>)
                            </small>
                </div>

                <div class="modal-footer border-top-0 d-flex justify-content-end gap-2"
                    style="padding: 0 1.5rem 1.5rem;">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Create Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
