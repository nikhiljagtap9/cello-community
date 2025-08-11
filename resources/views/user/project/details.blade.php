@extends('user.main')

@section('content')
<section class="pc-container">
   <div class="pc-content">
      <!-- [ breadcrumb ] start --> <!-- [ breadcrumb ] end --> 
      <div class="row">
         <div class="col-md-12" bis_skin_checked="1">
            <div class="card" bis_skin_checked="1">
               <div class="card-header" bis_skin_checked="1">
                  <h5>
                     <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
                     </svg>
                     Lorem Project 
                  </h5>
               </div>
               <div class="card-body" bis_skin_checked="1">
                  <div class="" bis_skin_checked="1">
                     <div class="comn_md comn_md" bis_skin_checked="1">
                        <form>
                           <div class="col-md-4" bis_skin_checked="1"> 
                              <label class="form-label" >Selected Plot</label> 
                               <input type="text" id="selectedPlotName" class="form-control projct_detl" readonly 
           value="">
                           </div>
                           <div class="map_wrap 603">
                              <div class="map_wrap_inner">
                                 <div class="map_pointer">
                                    
                                    <img src="{{ asset('user/assets/images/map_1.jpg')}}" class="map_img" > 
                                    <div class="map_pointer_main">
                                       <div class="pointer_circ circl_1 avlbl_mrk tooltip-container">
                                          <div class="tooltip-text">Available</div>
                                       </div>
                                       <div class="pointer_circ circl_2 sold_mrk tooltip-container">
                                          <div class="tooltip-text">Sold</div>
                                       </div>
                                       <div class="pointer_circ circl_3 avlbl_mrk tooltip-container">
                                          <div class="tooltip-text">Available</div>
                                       </div>
                                       <div class="pointer_circ circl_4 sold_mrk tooltip-container">
                                          <div class="tooltip-text">Sold</div>
                                       </div>
                                       <div class="pointer_circ circl_6 booked_mrk tooltip-container">
                                          <div class="tooltip-text">Booked</div>
                                       </div>
                                       <div class="pointer_circ circl_7 sold_mrk tooltip-container">
                                          <div class="tooltip-text">Sold</div>
                                       </div>
                                       <div class="pointer_circ circl_8 avlbl_mrk tooltip-container">
                                          <div class="tooltip-text">Available</div>
                                       </div>
                                       <div class="pointer_circ circl_9 sold_mrk tooltip-container">
                                          <div class="tooltip-text">Sold</div>
                                       </div>
                                       <div class="pointer_circ circl_10 booked_mrk tooltip-container">
                                          <div class="tooltip-text">Booked</div>
                                       </div>
                                       <div class="pointer_circ circl_11 avlbl_mrk tooltip-container">
                                          <div class="tooltip-text">Available</div>
                                       </div>
                                       <div class="pointer_circ circl_12 booked_mrk tooltip-container">
                                          <div class="tooltip-text">Booked</div>
                                       </div>







                                       <div class="pointer_circ circl_13 avlbl_mrk tooltip-container">
                                          <div class="tooltip-text">Available</div>
                                       </div>
                                       <div class="pointer_circ circl_14 sold_mrk tooltip-container">
                                          <div class="tooltip-text">Sold</div>
                                       </div>
                                       <div class="pointer_circ circl_15 avlbl_mrk tooltip-container">
                                          <div class="tooltip-text">Available</div>
                                       </div>
                                       <div class="pointer_circ circl_16 sold_mrk tooltip-container">
                                          <div class="tooltip-text">Sold</div>
                                       </div>
                                       <div class="pointer_circ circl_17 booked_mrk tooltip-container">
                                          <div class="tooltip-text">Booked</div>
                                       </div>
                                       <div class="pointer_circ circl_18 sold_mrk tooltip-container">
                                          <div class="tooltip-text">Sold</div>
                                       </div>
                                       <div class="pointer_circ circl_19 avlbl_mrk tooltip-container">
                                          <div class="tooltip-text">Available</div>
                                       </div>
                                       <div class="pointer_circ circl_20 sold_mrk tooltip-container">
                                          <div class="tooltip-text">Sold</div>
                                       </div>
                                       <div class="pointer_circ circl_21 booked_mrk tooltip-container">
                                          <div class="tooltip-text">Booked</div>
                                       </div>
                                       <div class="pointer_circ circl_22 avlbl_mrk tooltip-container">
                                          <div class="tooltip-text">Available</div>
                                       </div>
                                       <div class="pointer_circ circl_23 booked_mrk tooltip-container">
                                          <div class="tooltip-text">Booked</div>
                                       </div>

                                       <div class="clear"></div>
                                    </div>

                                 </div>
                                 <div class="map_img_descrp">
                                    <div class="map_det"> Select Plot  </div>
                                    <div class="card-body" bis_skin_checked="1">
                                       <div class="row" bis_skin_checked="1">
                                          <div class="col-md-12 comn_md comn_md" bis_skin_checked="1">
                                             <div>
                                                 

                                                  <div class="col-md-12 plot_detl" bis_skin_checked="1">
                                                   <label class="form-label" ></label> 
                                                   <select class="form-control" id="plotSelect">
                                                      <option value="">-- Select Plot --</option>
                                                         @foreach($project->plots as $index => $plot)
                                                            <option value="{{ $plot->id }}" data-name="{{ ucfirst($plot->plot_name) }}" {{ $index === 0 ? 'selected' : '' }}>
                                                               {{ ucfirst($plot->plot_name) }}
                                                            </option>
                                                         @endforeach
                                                   </select>
                                                </div>


                                                <div class="clear"></div>
                                               
                                                
                                                <div class="clear"></div>
                                             </div>
                                          </div>
                                       </div>
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
                           <div id="freelancerList">
                             
                           </div>
                           <div class="clear"></div>
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
document.addEventListener('DOMContentLoaded', function () {
    let plotSelect = document.getElementById('plotSelect');
    let container = document.getElementById('freelancerList');
    let selectedPlotNameInput = document.getElementById('selectedPlotName');
    let projectId = "{{ $project->id }}";

    function loadAssignments(plotId, plotName) {
        // Update plot name in readonly field
        selectedPlotNameInput.value = plotName || '';

        if (!plotId) {
            container.innerHTML = '';
            return;
        }

        fetch(`/user/project/${projectId}/plot/${plotId}/assignments`)
            .then(res => res.json())
            .then(data => {
                if (!data.length) {
                    container.innerHTML = '<p>No freelancers assigned for this plot.</p>';
                    return;
                }

                let html = '';
                data.forEach(assignment => {
                    html += `
                        <div class="col-md-6 flrenc_a flrenc_a_detl">
                            <label class="form-label">
                                ${assignment.freelancer?.details?.first_name || ''} (freelancer ${assignment.role})
                            </label> 
                            <div class="ad_frlncr">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-screen">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M19.03 17.818a3 3 0 0 0 1.97 -2.818v-8a3 3 0 0 0 -3 -3h-12a3 3 0 0 0 -3 3v8c0 1.317 .85 2.436 2.03 2.84"></path>
                                    <path d="M10 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M8 21a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2"></path>
                                 </svg>
                                  <div class="clear"></div>
                                ${assignment.invited_users_count} User Invited By 
                                <b>${assignment.freelancer?.details?.first_name || ''}</b> 
                                <div class="clear"></div>
                                <a class="invitd_users" href="#">View Invited Users</a> 
                            </div>
                        </div>
                    `;
                });
                container.innerHTML = html;
            })
            .catch(err => {
                console.error(err);
                container.innerHTML = '<p>Error loading data.</p>';
            });
    }

    // Load first plot on page load
    let firstOption = plotSelect.options[plotSelect.selectedIndex];
    loadAssignments(firstOption.value, firstOption.dataset.name);

    // Load on change
    plotSelect.addEventListener('change', function () {
        let selectedOption = this.options[this.selectedIndex];
        loadAssignments(selectedOption.value, selectedOption.dataset.name);
    });

});
</script>

@endsection