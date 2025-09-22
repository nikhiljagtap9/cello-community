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
                            Add Plot
                        </h5>
                    </div>
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="card-body" bis_skin_checked="1">
                        <form action="{{ route('admin.plot.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="row" bis_skin_checked="1">
                                @csrf
                                <div class="col-md-3">
                                    <label class="form-label">Project Name</label>
                                    <select name="project_id" class="form-control">
                                        <option value="">-- Select Project --</option>
                                        @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('project_id')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Plot Label</label>
                                    <input type="text" name="plot_label" class="form-control" placeholder="Enter Plot Label">
                                    @error('plot_label')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Upload Plot Image</label>
                                    <input type="file" name="image" class="form-control" id="imageInput">
                                    @error('image')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                    <img id="imagePreview" src="#" style="display:none; width:100px; margin-top:10px;" />
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Select User</label>
                                    <select name="user_id" class="form-control">
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->details->first_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-primary mb-4">Add Plot</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
// Image Preview Before Upload
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