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
               <div class="card-body" bis_skin_checked="1">
                  <div class="row" bis_skin_checked="1">
                     <div class="col-md-12 comn_md comn_md" bis_skin_checked="1">
                         <form action="{{ route('admin.plot.update', $plot->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-4">
                                    <label>Plot Name</label>
                                    <input type="text" name="plot_name" value="{{ old('plot_name', $plot->plot_name) }}" class="form-control">
                                    @error('plot_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label>Plot Size</label>
                                    <input type="text" name="plot_size" value="{{ old('plot_size', $plot->plot_size) }}" class="form-control">
                                    @error('plot_size') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label>Plot Location</label>
                                    <input type="text" name="plot_location" value="{{ old('plot_location', $plot->plot_location) }}" class="form-control">
                                    @error('plot_location') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label>Project Name</label>
                                    <input type="text" name="project_name" value="{{ old('project_name', $plot->project_name) }}" class="form-control">
                                    @error('project_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">Update Plot</button>
                                <a href="{{ route('admin.plot.index') }}" class="btn btn-secondary">Cancel</a>
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