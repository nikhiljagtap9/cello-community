@extends('prospect.main')

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
                       Add Freelancer           
                  </h5>
               </div>

               <div class="card-body" bis_skin_checked="1">
                  <div class="row" bis_skin_checked="1">
                     <div class="col-md-12 comn_md comn_md" bis_skin_checked="1">
                        @if(session('success'))
                           <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                           <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        
                        <form method="POST" action="{{ route('prospect.addFreelancer') }}">
                            @csrf
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

</script>
@endsection