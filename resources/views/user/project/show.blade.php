@extends('user.main')

@section('content')
<style>
   .booked_mrk {
    pointer-events: none;
    cursor: default; /* shows not clickable */
    opacity: 0.7; /* optional, visually distinct */
   }
</style>
<section class="pc-container">
   <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <!-- [ breadcrumb ] end -->
      <div class="row">
         <div class="col-md-12" bis_skin_checked="1">
            <div class="card" bis_skin_checked="1">
               <div class="card-header" bis_skin_checked="1">
                  <h5>
                     <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
                     </svg>
                     {{ ucwords($project->name) }}
                  </h5>
               </div>
               @if ($errors->any())
                  <div class="alert alert-danger">
                     <ul>
                           @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                           @endforeach
                     </ul>
                  </div>
               @endif

               <div class="card-body" bis_skin_checked="1">
                  <div class="row" bis_skin_checked="1">
                     <div class="col-md-12 comn_md comn_md" bis_skin_checked="1">
                        <form method="POST" action="{{ route('user.project.assignFreelancers') }}">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                           <!-- Project Name -->
                            <div class="col-md-4">
                                <label class="form-label">Project Name</label>
                                <input type="text" class="form-control projct_detl" readonly value="{{ $project->name }}">
                            </div>

                            <!-- Project Description -->
                            <div class="col-md-4">
                                <label class="form-label">Project Description</label>
                                <input type="text" class="form-control projct_detl" readonly value="{{ $project->description }}">
                            </div>

                           <div class="col-md-4" bis_skin_checked="1">
                              <label class="form-label" >Project Image</label>
                              <div class="clear"></div>
                               <a onclick="openModal_img('{{ asset('storage/' . $project->image) }}')" class="view_prdc view_prdc_2">VIEW</a>
                           </div>
                           <div class="clear"></div>
                             

                           <div class="map_wrap 603">
                              <div class="map_wrap_inner">
                                 <div class="map_pointer">
                                    
                                    <img src="" class="map_img" id="wingImage"> 
                                    <!-- Map markers -->
                                    <div class="map_pointer_main">
                                       @foreach($project->plots as $plot)
                                          @php
                                             // Determine status class
                                             $statusClass = match(strtolower($plot->status)) {
                                                   'available' => 'avlbl_mrk',
                                                   'sold' => 'sold_mrk',
                                                   'booked' => 'booked_mrk',
                                                   default => '',
                                             };

                                             // Circle class - using iteration or plot ID
                                             $circleClass = 'circl_' . ($loop->iteration); // Or $plot->id
                                          @endphp
                                          <div 
                                                class="pointer_circ {{ $circleClass }} {{ $statusClass }} {{ strtolower($plot->status) }}_mrk tooltip-container" 
                                                data-plot-id="{{ $plot->id }}" 
                                                data-wing-id="{{ $plot->project_wing_id }}"
                                                data-plot-name="{{ $plot->plot_name }}"
                                                data-plot-size="{{ $plot->plot_size }}"
                                                data-plot-location="{{ $plot->plot_location }}"
                                                data-plot-dimensions="{{ $plot->plot_dimensions }}">
                                                <div class="tooltip-text">{{ ucfirst($plot->status) }}</div>
                                          </div>
                                         
                                       @endforeach
                                    </div>
                                 </div>
                                 <!-- Hidden field for submission -->
                                 <input type="hidden" name="plot_id" id="plot_id">
                                 <div class="map_img_descrp">
                                    <div class="map_det"> Select Plot Label  </div>
                                    <select class="form-control" id="wingSelect" name="project_wing_id">
                                       <option value="">-- Select Plot Label --</option>
                                       @foreach($wings as $index => $wing)
                                          <option value="{{ $wing->id }}" 
                                          data-name="{{ ucfirst($wing->plot_label) }}" 
                                          data-image="{{ asset('storage/' . $wing->image) }}"
                                          {{ $index === 0 ? 'selected' : '' }}>
                                                {{ ucfirst($wing->plot_label) }}
                                          </option>
                                       @endforeach
                                    </select>

                                    <div style="display:none">
                                       <div class="map_det"> Select Plot  </div>
                                       <div class="card-body" bis_skin_checked="1">
                                          <div class="row" bis_skin_checked="1">
                                             <div class="col-md-12 comn_md comn_md" bis_skin_checked="1">
                                                <div>
                                                   <div class="col-md-12 plot_detl" bis_skin_checked="1">
                                                      <label class="form-label" ></label> 
                                                      <select id="plot_select" class="form-control">
                                                         <!-- @foreach($project->plots as $plot)
                                                               <option value="{{ $plot->id }}" data-wing-id="{{ $plot->project_wing_id }}">
                                                                     {{ $plot->plot_name }}
                                                               </option>
                                                         @endforeach -->
                                                      </select>
                                                   </div>


                                                   <div class="clear"></div>
                                                
                                                   
                                                   <div class="clear"></div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="clear"></div>

                                 <!-- Plot Information -->
                                 <div class="map_det">Plot Information</div>
                                 <div class="plot_info">
                                    <div><strong>Name:</strong> <span id="info_name"></span></div>
                                    <div><strong>Size:</strong> <span id="info_size"></span></div>
                                    <div><strong>Location:</strong> <span id="info_location"></span></div>
                                    <div><strong>Dimensions:</strong> <span id="info_dimensions"></span></div>
                                 </div>



                                    <div class="clear"></div>
                                    <div class="map_det"> Map Details </div>
                                    <div class="map_img_descrp_signl">
                                       <div class="available circl_map"></div>
                                       <div class="sold_titl">Available</div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="map_img_descrp_signl">
                                       <div class="booked circl_map"></div>
                                       <div class="sold_titl">Booked</div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="map_img_descrp_signl">
                                       <div class="sold circl_map"></div>
                                       <div class="sold_titl">Sold</div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="map_img_descrp_signl">
                                       <div class="other circl_map"></div>
                                       <div class="sold_titl">Other</div>
                                    </div>
                                 </div>
                                 <div class="clear"></div>

                              </div>
                           </div>

                           <div class="clear"></div>

                           <a class="check_s" onclick="costing_pop()" > check status if not subscribed then go to pricing popup </a>
                           <div class="clear"></div>
                           <div class="col-md-6 flrenc_a" bis_skin_checked="1">
                              <label class="form-label" >freelancer A</label>
                              <div class="clear"></div>
                              <div class="ad_frlncr"  onclick="frelanc_add('A')" >
                                 <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-screen"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.03 17.818a3 3 0 0 0 1.97 -2.818v-8a3 3 0 0 0 -3 -3h-12a3 3 0 0 0 -3 3v8c0 1.317 .85 2.436 2.03 2.84" /><path d="M10 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2" /></svg>
                                 <div class="clear"></div>
                                 Add freelancer A
                              </div>
                              <div id="freelancer_a_message" class="text-success mt-1"></div>
                           </div>


                           <div class="col-md-6 flrenc_a" bis_skin_checked="1">
                              <label class="form-label" >freelancer B</label>
                              <div class="clear"></div>
                              <div class="ad_frlncr"   onclick="frelanc_add('B')" >
                                 <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-screen"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.03 17.818a3 3 0 0 0 1.97 -2.818v-8a3 3 0 0 0 -3 -3h-12a3 3 0 0 0 -3 3v8c0 1.317 .85 2.436 2.03 2.84" /><path d="M10 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2" /></svg>
                                 <div class="clear"></div>
                                 Add freelancer B
                              </div>
                              <div id="freelancer_b_message" class="text-success mt-1"></div>
                           </div>

                            <!-- Hidden fields for Freelancer A -->
                            <input type="hidden" id="freelancer_a_first_name" name="freelancer_a_first_name">
                            <input type="hidden" id="freelancer_a_last_name" name="freelancer_a_last_name">
                            <input type="hidden" id="freelancer_a_email" name="freelancer_a_email">
                            <input type="hidden" id="freelancer_a_phone" name="freelancer_a_phone">
                            <input type="hidden" id="freelancer_a_address" name="freelancer_a_address">
                            <!-- <input type="hidden" id="freelancer_a_referral_code" name="freelancer_a_referral_code"> -->

                            <!-- Hidden fields for Freelancer B -->
                            <input type="hidden" id="freelancer_b_first_name" name="freelancer_b_first_name">
                            <input type="hidden" id="freelancer_b_last_name" name="freelancer_b_last_name">
                            <input type="hidden" id="freelancer_b_email" name="freelancer_b_email">
                            <input type="hidden" id="freelancer_b_phone" name="freelancer_b_phone">
                            <input type="hidden" id="freelancer_b_address" name="freelancer_b_address">
                           <!-- <input type="hidden" id="freelancer_b_referral_code" name="freelancer_b_referral_code"> -->


                           <div class="clear"></div>

                           <button type="submit" class="btn btn-primary mb-4 submi_movi"  >Submit</button>
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
   document.addEventListener("DOMContentLoaded", function () {
    const plotSelect = document.getElementById("plot_select");
    const plotIdInput = document.getElementById("plot_id");

    const infoName = document.getElementById("info_name");
    const infoSize = document.getElementById("info_size");
    const infoLocation = document.getElementById("info_location");
    const infoDimensions = document.getElementById("info_dimensions");

    function updatePlotInfo(id, name, size, location, dimensions) {
        plotIdInput.value = id;
        infoName.textContent = name;
        infoSize.textContent = size;
        infoLocation.textContent = location;
        infoDimensions.textContent = dimensions;
    }

    // Default: select first plot
    if (plotSelect.options.length > 0) {
        let firstOpt = plotSelect.options[0];
        updatePlotInfo(
            firstOpt.value,
            firstOpt.dataset.plot_name,
            firstOpt.dataset.size,
            firstOpt.dataset.location,
            firstOpt.dataset.dimensions
        );
    }

    // Dropdown change
    plotSelect.addEventListener("change", function () {
        let opt = plotSelect.options[plotSelect.selectedIndex];
        updatePlotInfo(
            opt.value,
            opt.dataset.name,
            opt.dataset.size,
            opt.dataset.location,
            opt.dataset.dimensions
        );
    });

    // Marker click
    document.querySelectorAll(".pointer_circ").forEach(marker => {
        marker.addEventListener("click", function () {
           //  console.log("this.dataset " + JSON.stringify(this.dataset));
            let plotId = this.dataset.plotId;
            let plotName = this.dataset.plotName;
            let plotSize = this.dataset.plotSize;
            let plotLocation = this.dataset.plotLocation;
            let plotDimensions = this.dataset.plotDimensions;

            plotSelect.value = plotId;
            updatePlotInfo(plotId, plotName, plotSize, plotLocation, plotDimensions);
        });
    });
});



// 
document.addEventListener("DOMContentLoaded", function () {
    const wingSelect = document.getElementById("wingSelect");
    const plotSelect = document.getElementById("plot_select");

    // Function to fetch plots and update dropdown
    function loadPlots(wingId) {
        fetch(`/user/plots-by-wing/${wingId}`)
            .then(response => response.json())
            .then(plots => {
                plotSelect.innerHTML = '<option value="">-- Select Plot --</option>';
                plots.forEach(plot => {
                    let option = document.createElement("option");
                    option.value = plot.id;
                    option.textContent = plot.plot_name;
                    plotSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching plots:', error);
            });
    }

    // Initial load — get plots for selected wing (e.g., Wing A by default)
    if (wingSelect.value) {
        loadPlots(wingSelect.value);
    }

    // Load plots when wing selection changes
    wingSelect.addEventListener("change", function () {
        if (this.value) {
            loadPlots(this.value);
        } else {
            plotSelect.innerHTML = '<option value="">-- Select Plot --</option>';
        }
    });
});


// display image depend on wigns select
document.addEventListener("DOMContentLoaded", function () {
    const wingSelect = document.getElementById("wingSelect");
    const wingImage = document.getElementById("wingImage");

    wingSelect.addEventListener("change", function () {
        const selectedOption = wingSelect.options[wingSelect.selectedIndex];
        const newImageUrl = selectedOption.getAttribute("data-image");

        if (newImageUrl && wingImage) {
            wingImage.src = newImageUrl;
        }
    });
});

// To make plot markers show/hide based on selected wing
document.addEventListener("DOMContentLoaded", function () {
    const wingSelect = document.getElementById("wingSelect");

    function filterPlotMarkers(wingId) {
        document.querySelectorAll(".pointer_circ").forEach(marker => {
            if (marker.dataset.wingId === wingId) {
                marker.style.display = "block";
            } else {
                marker.style.display = "none";
            }
        });
    }

    // Initial filter on page load
    if (wingSelect && wingSelect.value) {
        filterPlotMarkers(wingSelect.value);
    }

    // On wing select change
    wingSelect.addEventListener("change", function () {
        filterPlotMarkers(this.value);
    });
});

</script>
@endsection