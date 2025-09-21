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
                            Edit Plot
                        </h5>
                        <a href="{{url('admin/wings/plot?project_id=' . en_de_crypt($plot->project->id) . '&wing_id=' . en_de_crypt($plot->wing->id))}}" class="back_btn btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> Add Plots
                        </a>
                    </div>
                    
                    <div class="card-body" bis_skin_checked="1">

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif


                        <div class="row" bis_skin_checked="1">
                            <div class="col-md-12 comn_md comn_md" bis_skin_checked="1">
                                <form action="{{ route('admin.plot.update', $plot->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Project Name</label>
                                            <select name="project_id" class="form-control">
                                                <option value="">-- Select Project --</option>
                                                @foreach($projects as $project)
                                                <option value="{{ $project->id }}" {{ $plot->project_id == $project->id ? 'selected' : '' }}>
                                                    {{ $project->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('project_id')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Plot Label</label>
                                            <input type="text" name="plot_label" class="form-control"
                                            value="{{ $plot->wing->plot_label }}" placeholder="Enter Plot Label">
                                            @error('plot_label')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Select User</label>
                                            <select name="user_id" class="form-control">
                                                <option value="">Select User</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ $plot->project?->user_id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->details->first_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('user_id')<small class="text-danger">{{ $message }}</small>@enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Upload Plot Image</label>
                                            <input type="file" name="image" class="form-control" id="imageInput" onchange="previewImage(event)">
                                            @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                                            @if (!empty($plot->wing->image))
                                            <a href="{{ URL('' . $plot->wing->image) }}" target="_blank"><img id="imagePreview" src="{{ URL('' . $plot->wing->image) }}" style="width:100px; margin-top:10px;"></a>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="{{ route('admin.plot.index') }}" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            View Plot
                        </h5>
                    </div>
                    <div class="card-body" bis_skin_checked="1">
                        <div class="row" bis_skin_checked="1">
                            <div class="col-md-12 comn_md comn_md" bis_skin_checked="1">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Plot Name</th>
                                                    <th>Plot Size</th>
                                                    <th>Plot Location</th>
                                                    <th>Plot Dimensions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="plot-rows">
                                                @foreach($relatedPlots as $index => $plot)
                                                <tr>
                                                    <td>{{ $plot->plot_name }}</td>
                                                    <td>{{ $plot->plot_size }}</td>
                                                    <td>{{ $plot->plot_location }}</td>
                                                    <td>{{ $plot->plot_dimensions }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
@endsection