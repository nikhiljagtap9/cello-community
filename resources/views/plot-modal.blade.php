<div class="modal fade" id="plotModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form id="assign_plot">
                <div class="modal-header">
                    <h5 class="modal-title" id="plotModalTitle">Edit Plot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="plot_id" id="plotIndex">
                    <input type="hidden" class="selected_proj_id" name="project_id" value="{{ $project->id }}">
                    <div class="col-sm-3 mb-3">
                        <label class="form-label">Project Name</label>
                        <input type="text" class="form-control selected_proj_name" value="{{ $project->name }}" readonly>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <label class="form-label">Plot Label (Wing)</label>
                        <input type="text" class="form-control" id="plotWingName" readonly>
                        <input type="hidden" name="wing_id" class="form-control" id="plotWingId" readonly>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <label class="form-label">Plot Number</label>
                        <input type="text" class="form-control" id="plotNumber" readonly>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <label class="form-label">Size</label>
                        <input type="text" class="form-control" id="plotSize" readonly>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-control" id="plotLocation" readonly>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <label class="form-label">Dimensions</label>
                        <input type="text" class="form-control" id="plotDimensions" readonly>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" id="plotStatus" readonly>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <label class="form-label">Users</label>
                        <select class="form-control" id="plotUsers" name="assign_id">
                            <option value="">-- Select User --</option>
                            @foreach($freel_list as $user)
                            <option value="{{ $user->id }}" 
                                {{ isset($assignedUserId) && $assignedUserId == $user->id ? 'selected' : '' }}>
                                {{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})
                            </option>
                            @endforeach
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    {{-- <button type="button" id="deletePlotBtn" class="btn btn-danger">Delete</button> --}}
                    <button type="submit" id="savePlotBtn" class="btn btn-primary">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>