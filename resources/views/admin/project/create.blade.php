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
                     Add Project
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
                        <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-4">
                                <label class="form-label">Project Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Project Name">
                                @error('name')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Upload Project Image</label>
                                <input type="file" name="image" class="form-control" id="imageInput">
                                @error('image')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Project Description</label>
                                <input type="text" name="description" class="form-control" placeholder="Enter Project Description">
                                @error('description')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                           <div class="clear"></div>

                           <img id="imagePreview" src="#" style="display:none; width:100px; margin-top:10px;" />
                           <!-- <img src="assets/images/map_1.jpg" class="map_img_1" style="float: left; width: 100%; " > -->
                             
                            <div class="clear"></div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mb-4">Add Project</button>
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
    let plotIndex = 1;
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