@extends('admin.main')

@section('content')
<section class="pc-container">
   <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <!-- [ breadcrumb ] end -->
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
               </div>
               @if(session('error'))
                    <div class="alert alert-danger">
                    {{ session('error') }}
                    </div>
               @endif
                 <div class="card-body" bis_skin_checked="1">
                  <div class="row" bis_skin_checked="1">
                     <div class="col-md-12 comn_md comn_md" bis_skin_checked="1">
                        <form action="{{ route('admin.plot.update', $plot->id) }}" method="POST" enctype="multipart/form-data">
                           @csrf
                           @method('PUT')

                           <div class="row">
                              <!-- Project Name -->
                              <div class="col-md-4">
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

                              <div class="col-md-4">
                                 <label class="form-label">Plot Label</label>
                                 <input type="text" name="plot_label" class="form-control" 
                                       value="{{ $plot->wing?->plot_label }}" placeholder="Enter Plot Label">
                                 @error('plot_label')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                 @enderror
                              </div>

                              <!-- Image Upload -->
                              <div class="col-md-4 mb-3">
                                    <label class="form-label">Upload Plot Image</label>
                                    <input type="file" name="image" class="form-control" id="imageInput" onchange="previewImage(event)">
                                    @error('image')<small class="text-danger">{{ $message }}</small>@enderror

                                    @if($project->image)
                                       <img id="imagePreview" src="{{ asset('storage/' . $plot->wing->image) }}" style="width:100px; margin-top:10px;">
                                    @else
                                       <img id="imagePreview" src="#" style="display:none; width:100px; margin-top:10px;">
                                    @endif
                              </div>


                              <!-- Plot Details -->
                              <div class="col-md-12 mb-3">
                                    <label class="form-label">Plot Details</label>
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
                                                   <td>
                                                      <input type="hidden" name="plots[{{ $index }}][id]" value="{{ $plot->id }}">
                                                      <input type="text" name="plots[{{ $index }}][plot_name]" value="{{ $plot->plot_name }}" class="form-control">
                                                      @error('plots.0.plot_name')
                                                         <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                      @enderror
                                                   </td>
                                                   <td><input type="text" name="plots[{{ $index }}][plot_size]" value="{{ $plot->plot_size }}" class="form-control"></td>
                                                   <td><input type="text" name="plots[{{ $index }}][plot_location]" value="{{ $plot->plot_location }}" class="form-control"></td>
                                                   <td><input type="text" name="plots[{{ $index }}][plot_dimensions]" value="{{ $plot->plot_dimensions }}" class="form-control"></td>
                                                </tr>
                                          @endforeach
                                       </tbody>
                                    </table>
                                    <button type="button" id="add-plot-row" class="btn btn-sm btn-secondary">Add More Plot</button>
                              </div>

                              <!-- Select User -->
                              <div class="col-md-4 mb-3">
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

                              <div class="col-md-12">
                                 <button type="submit" class="btn btn-success">Update Plot</button>
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
      <!-- [ Main Content ] end -->
   </div>
</section>
@endsection
@section('scripts')
<script>
    let plotIndex = {{ count($plot->project->plots) }};  // use actual count to avoid overwriting
    console.log("plotIndex " + plotIndex);
    document.getElementById('add-plot-row').addEventListener('click', function () {
        const row = `
            <tr>
                <td><input type="text" name="plots[${plotIndex}][plot_name]" class="form-control" /></td>
                <td><input type="text" name="plots[${plotIndex}][plot_size]" class="form-control" /></td>
                <td><input type="text" name="plots[${plotIndex}][plot_location]" class="form-control" /></td>
                <td><input type="text" name="plots[${plotIndex}][plot_dimensions]" class="form-control" /></td>
            </tr>`;
        document.getElementById('plot-rows').insertAdjacentHTML('beforeend', row);
        plotIndex++;
    });
</script>
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