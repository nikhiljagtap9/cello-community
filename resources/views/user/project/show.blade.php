@extends('user.main')

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
                     <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
                     </svg>
                     {{ ucwords($project->name) }}
                  </h5>
               </div>
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
                                    
                                    <img src="{{ asset('storage/' . $project->image) }}" class="map_img" > 
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
                                                   <select class="form-control" >
                                                      <option>PLot A</option>
                                                      <option>PLot B</option>
                                                      <option>PLot C</option>
                                                      <option>PLot D</option>
                                                   </select>
                                                </div>


                                                <div class="clear"></div>
                                               
                                                
                                                <div class="clear"></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="clear"></div>

                                    <div class="map_det"> Plot Dimensions </div>
                                    <div class="width_dismn">
                                       <div class="width_1">Width</div>
                                       <div class="width_1">Height</div>
                                       <div class="clear"></div>
                                       <div class="ans_width">120 Foot</div>
                                       <div class="ans_width">120 Foot</div>

                                       <div class="clear"></div>
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
                           </div>


                           <div class="col-md-6 flrenc_a" bis_skin_checked="1">
                              <label class="form-label" >freelancer B</label>
                              <div class="clear"></div>
                              <div class="ad_frlncr"   onclick="frelanc_add('B')" >
                                 <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-screen"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.03 17.818a3 3 0 0 0 1.97 -2.818v-8a3 3 0 0 0 -3 -3h-12a3 3 0 0 0 -3 3v8c0 1.317 .85 2.436 2.03 2.84" /><path d="M10 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2" /></svg>
                                 <div class="clear"></div>
                                 Add freelancer B
                              </div>
                           </div>

                            <!-- Hidden fields for Freelancer A -->
                            <input type="hidden" id="freelancer_a_first_name" name="freelancer_a_first_name">
                            <input type="hidden" id="freelancer_a_last_name" name="freelancer_a_last_name">
                            <input type="hidden" id="freelancer_a_email" name="freelancer_a_email">
                            <input type="hidden" id="freelancer_a_phone" name="freelancer_a_phone">
                            <input type="hidden" id="freelancer_a_address" name="freelancer_a_address">
                            <input type="hidden" id="freelancer_a_referral_code" name="freelancer_a_referral_code">

                            <!-- Hidden fields for Freelancer B -->
                            <input type="hidden" id="freelancer_b_first_name" name="freelancer_b_first_name">
                            <input type="hidden" id="freelancer_b_last_name" name="freelancer_b_last_name">
                            <input type="hidden" id="freelancer_b_email" name="freelancer_b_email">
                            <input type="hidden" id="freelancer_b_phone" name="freelancer_b_phone">
                            <input type="hidden" id="freelancer_b_address" name="freelancer_b_address">
                            <input type="hidden" id="freelancer_b_referral_code" name="freelancer_b_referral_code">


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