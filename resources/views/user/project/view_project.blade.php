@extends('user.main')
@section('content')
<section class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-md-12" >
                <div class="card" >
                    <div class="card-header" >
                        <h5>
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
                        </svg>
                        View {{ ucwords($project->name) }}
                        </h5>
                    </div>
                    <div class="card-body" >
                        <div class="row" >
                            <div class="col-md-12 comn_md comn_md" >
                                <input type="hidden" class="selected_proj_name" value="{{ $project->name }}">
                                <input type="hidden" class="selected_proj_id" name="project_id" value="{{ $project->id }}">
                                <div class="col-md-4">
                                    <label class="form-label">Project Name</label>
                                    <input type="text" class="form-control proj_name projct_detl" readonly value="{{ $project->name }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Plot Label</label>
                                    <select class="form-control plot_lbel" id="wingSelect" name="project_wing_id">
                                        <option value="">Select Plot Label</option>
                                        @foreach($wings as $index => $wing)
                                        <option value="{{ $wing->id }}"
                                            data-name="{{ ucfirst($wing->plot_label) }}"
                                            data-image="{{ asset('' . $wing->image) }}"
                                            {{ $index === 0 ? 'selected' : '' }}>
                                            {{ ucfirst($wing->plot_label) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="clear"></div>
                                <div id="plotTooltip" class="plot-tooltip"></div>
                                <div class="map_wrap">
                                </div>
                                @include('plot-modal')
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card" >
                    <div class="card-header" >
                        <h5>Invite Freelances</h5>
                    </div>
                    <div class="card-body" >
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <form id="freelancerForm">
                                @csrf
                                <input type="hidden" class="action_url" value="{{URL('user/create_freelancers')}}">
                                <input type="hidden" class="selected_proj_id" name="project_id" value="{{ $project->id }}">

                                <!-- Freelancers Table (hidden by default) -->
                                <div id="freelancerTableWrap" class="mb-3" style="display:none;"></div>
                                <!-- Freelancer Form Tabs -->
                                <div id="freelancerFormWrap">
                                    <ul class="nav nav-tabs" id="freelancerTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="freelancer-a-tab" data-bs-toggle="tab"
                                            data-bs-target="#freelancerA" type="button" role="tab">
                                            Invite  Freelancer A</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="freelancer-b-tab" data-bs-toggle="tab"
                                            data-bs-target="#freelancerB" type="button" role="tab">
                                            Invite Freelancer B
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content border border-top-0 p-3 rounded-bottom" id="freelancerTabsContent">
                                        <!-- Freelancer A -->
                                        <div class="tab-pane fade show active" id="freelancerA" role="tabpanel">
                                            <input type="hidden" id="f_a_id" name="freelancer_a_id" value="">
                                            <div class="card shadow-sm border mb-3">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-6 mb-2">
                                                            <label class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="freelancer_a_first_name" name="freelancer_a_first_name">
                                                        </div>
                                                        <div class="col-sm-6 mb-2">
                                                            <label class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="freelancer_a_last_name" name="freelancer_a_last_name">
                                                        </div>
                                                        <div class="col-sm-6 mb-2">
                                                            <label class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="freelancer_a_email" name="freelancer_a_email">
                                                        </div>
                                                        <div class="col-sm-6 mb-2">
                                                            <label class="form-label">Phone</label>
                                                            <input type="text" class="form-control" id="freelancer_a_phone" name="freelancer_a_phone">
                                                        </div>
                                                        <div class="col-12 mb-2">
                                                            <label class="form-label">Address</label>
                                                            <textarea class="form-control" id="freelancer_a_address" name="freelancer_a_address" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Freelancer B -->
                                        <div class="tab-pane fade" id="freelancerB" role="tabpanel">
                                            <input type="hidden" id="f_b_id" name="freelancer_b_id" value="">
                                            <div class="card shadow-sm border mb-3">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-6 mb-2">
                                                            <label class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="freelancer_b_first_name" name="freelancer_b_first_name">
                                                        </div>
                                                        <div class="col-sm-6 mb-2">
                                                            <label class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="freelancer_b_last_name" name="freelancer_b_last_name">
                                                        </div>
                                                        <div class="col-sm-6 mb-2">
                                                            <label class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="freelancer_b_email" name="freelancer_b_email">
                                                        </div>
                                                        <div class="col-sm-6 mb-2">
                                                            <label class="form-label">Phone</label>
                                                            <input type="text" class="form-control" id="freelancer_b_phone" name="freelancer_b_phone">
                                                        </div>
                                                        <div class="col-12 mb-2">
                                                            <label class="form-label">Address</label>
                                                            <textarea class="form-control" id="freelancer_b_address" name="freelancer_b_address" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary mt-3" type="submit">Invite</button>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<link rel="stylesheet" href="{{ asset('css/admin/demo.css') }}">
@section('scripts')
<script>
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
<script src="{{ asset('js/view_project.js') }}"></script>
@endsection