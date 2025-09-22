@extends('admin.main')
@section('content')


<section class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-md-12" bis_skin_checked="1">
                <div class="card" bis_skin_checked="1">
                    <div class="card-header" bis_skin_checked="1">
                        <h5>
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-map">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 7l6 -3l6 3l6 -3v13l-6 3l-6 -3l-6 3v-13" />
                                <path d="M9 4v13" />
                                <path d="M15 7v13" />
                            </svg>
                            Add Plot Under {{$wing_name}}
                        </h5>
                        <a href="{{URL('admin/plot')}}" class="btn back_btn">Back to plot listing</a>
                    </div>
                    <div class="card-body" bis_skin_checked="1">
                        <div class="row" bis_skin_checked="1">
                            <div class="col-md-12 comn_md comn_md" bis_skin_checked="1">
                                <!-- Search -->
                                <span class="form-control">Project name - {{$project_record->name}}</span>
                                <br>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Search / Filter Plots</h5>
                                        <div class="row g-2">
                                            <div class="col-md-3">
                                                <input type="text" id="searchNumber" class="form-control" placeholder="Plot Number">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" id="searchLocation" class="form-control" placeholder="Location">
                                            </div>
                                            <div class="col-md-3">
                                                <select id="searchStatus" class="form-select">
                                                    <option value="">All Status</option>
                                                    <option value="Available">Available</option>
                                                    <option value="Booked">Booked</option>
                                                    <option value="Reserved">Reserved</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <button id="applySearch" class="btn btn-primary w-100">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Map -->
                                <div id="map-container">
                                    <img src="{{URL($wing_image)}}" alt="Map" id="lot-map">
                                    <div id="plotTooltip" class="plot-tooltip"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal" id="plotModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="plotModalTitle">Edit Plot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="plotIndex">
                <input type="hidden" class="wid" name="wing_id" value="{{$wid}}">
                <input type="hidden" class="pid" name="project_id" value="{{$pid}}">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Plot Number</label>
                        <input type="text" id="plotNumber" class="form-control" pattern="[0-9]+" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Plot Size</label>
                        <input type="text" id="plotSize" class="form-control" placeholder="(m²)">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Plot Location</label>
                        <input type="text" id="plotLocation" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Plot Dimensions</label>
                        <input type="text" id="plotDimensions" class="form-control" placeholder="e.g. 10x20">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <select id="plotStatus" class="form-select">
                            <option value="Available">Available</option>
                            <option value="Booked">Booked</option>
                            <option value="Reserved">Reserved</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3" style="display:none;">
                        <label class="form-label">Plot Type</label>
                        <select id="plotType" class="form-select">
                            <option value="default">Default</option>
                            <option value="house">House</option>
                            <option value="parking">Parking</option>
                            <option value="green">Green Space</option>
                            <option value="commercial">Commercial</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" id="savePlotBtn" class="btn btn-primary">Save</button>
                <button type="button" id="deletePlotBtn" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<br>
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/demo.css') }}">
@endsection
@section('scripts')
<script>
    window.plots = @json($plots);
    window.plotIcons = {
        available: "{{ URL('images/orange.png') }}",
        booked:    "{{ URL('images/red.png') }}",
        reserved:  "{{ URL('images/green.png') }}",
        house:     "{{ URL('images/house.png') }}",
        parking:   "{{ URL('images/parking.png') }}",
        green:     "{{ URL('images/tree.png') }}",
        commercial:"{{ URL('images/shop.png') }}"
    };
</script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/admin/add_edit_plot.js') }}"></script>
@endsection
