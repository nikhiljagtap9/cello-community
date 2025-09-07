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
                           <!-- <div class="col-md-4" bis_skin_checked="1"> 
                              <label class="form-label" >Selected Plot</label> 
                               <input type="text" id="selectedPlotName" class="form-control projct_detl" readonly 
           value="">
                           </div> -->
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
                                                      <option value="">-- Select Wing --</option>
                                                      @foreach($wings as $index => $wing)
                                                         <option value="{{ $wing->id }}" data-name="{{ ucfirst($wing->plot_label) }}" {{ $index === 0 ? 'selected' : '' }}>
                                                               {{ ucfirst($wing->plot_label) }}
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
                           <!-- <div id="freelancerList"></div> -->
                           <div class="clear"></div>
                        </form>
                      
                        <!-- invited user -->
                        <div class="card-body">
                           <div class="table-responsive">
                              <table id="row-callback1" class="table table-striped table-bordered nowrap">
                                 <thead>
                                    <tr>
                                       <th>First Name</th>
                                       <th>Last Name</th>
                                       <th>Address</th>
                                       <th>Phone</th>
                                       <th>Email ID</th>
                                       <th>Invited By </th>
                                       <th>Invitee Name </th>
                                       <th>Assign Plot</th>     
                                    </tr>
                                 </thead>
                                 <tbody >
                                    
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <!-- invited user -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('freelance/assets/js/plugins/dataTables.min.js')}}"></script>
<script src="{{ asset('freelance/assets/js/plugins/dataTables.bootstrap5.min.js')}}"></script>
<script>
$(document).ready(function() {
    let projectId = "{{ $project->id }}";
    let availablePlots = []; // Will store plots for current wing

    // Initialize DataTable
    let table = $('#row-callback1').DataTable({
        processing: true,
        serverSide: false,
        searching: true,
        paging: true,
        info: true,
        columns: [
            { data: 'first_name' },
            { data: 'last_name' },
            { data: 'address' },
            { data: 'phone' },
            { data: 'email' },
            { data: 'invited_by_type' },
            { data: 'invited_by' },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data) {
                    if (data.plot_id) {
                        // User already has a plot assigned
                        return `<span class="text-success">Assigned: ${data.plot_name}</span>`;
                     }
                    let options = '<option value="">Select Plot</option>';
                    availablePlots.forEach(plot => {
                        options += `<option value="${plot.id}">${plot.plot_name}</option>`;
                    });
                    return `
                        <form action="{{ route('user.assignPlot') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="${data.id}">
                            <select name="plot_id" class="form-control" required>
                                ${options}
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary mt-1">Assign</button>
                        </form>
                    `;
                }
            }
        ]
    });

    function loadAssignmentsByWing(wingId) {
        if (!wingId) {
            table.clear().draw();
            return;
        }

        fetch(`/user/project/${projectId}/assignments/${wingId}`)
            .then(res => res.json())
            .then(data => {
                // Save plots for current wing
                availablePlots = data.plots;

                // Populate DataTable with users
                table.clear().rows.add(data.users).draw();
            })
            .catch(err => console.error(err));
    }

    // Load first wing data on page load
    let firstWing = $('#plotSelect').val();
    if (firstWing) loadAssignmentsByWing(firstWing);

    // Load table on wing change
    $('#plotSelect').on('change', function() {
        let wingId = $(this).val();
        loadAssignmentsByWing(wingId);
    });
});
</script>


<script>
   // [ DOM/jquery ]
   var total, pageTotal;
   var table = $('#dom-jqry').DataTable();
   // [ column Rendering ]
   $('#colum-render').DataTable({
     columnDefs: [
       {
         render: function (data, type, row) {
           return data + ' (' + row[3] + ')';
         },
         targets: 0
       },
       {
         visible: false,
         targets: [3]
       }
     ]
   });
   // [ Multiple Table Control Elements ]
   $('#multi-table').DataTable({
     dom: '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'
   });
   // [ Complex Headers With Column Visibility ]
   $('#complex-header').DataTable({
     columnDefs: [
       {
         visible: false,
         targets: -1
       }
     ]
   });
   // [ Language file ]
   $('#lang-file').DataTable({
     language: {
       url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json'
     }
   });
   // [ Setting Defaults ]
   $('#setting-default').DataTable();
   // [ Row Grouping ]
   var table1 = $('#row-grouping').DataTable({
     columnDefs: [
       {
         visible: false,
         targets: 2
       }
     ],
     order: [[2, 'asc']],
     displayLength: 25,
     drawCallback: function (settings) {
       var api = this.api();
       var rows = api
         .rows({
           page: 'current'
         })
         .nodes();
       var last = null;
   
       api
         .column(2, {
           page: 'current'
         })
         .data()
         .each(function (group, i) {
           if (last !== group) {
             $(rows)
               .eq(i)
               .before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
   
             last = group;
           }
         });
     }
   });
   // [ Order by the grouping ]
   $('#row-grouping tbody').on('click', 'tr.group', function () {
     var currentOrder = table.order()[0];
     if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
       table.order([2, 'desc']).draw();
     } else {
       table.order([2, 'asc']).draw();
     }
   });
   // [ Footer callback ]
   $('#footer-callback').DataTable({
     footerCallback: function (row, data, start, end, display) {
       var api = this.api(),
         data;
   
       // Remove the formatting to get integer data for summation
       var intVal = function (i) {
         return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
       };
   
       // Total over all pages
       total = api
         .column(4)
         .data()
         .reduce(function (a, b) {
           return intVal(a) + intVal(b);
         }, 0);
   
       // Total over this page
       pageTotal = api
         .column(4, {
           page: 'current'
         })
         .data()
         .reduce(function (a, b) {
           return intVal(a) + intVal(b);
         }, 0);
   
       // Update footer
       $(api.column(4).footer()).html('$' + pageTotal + ' ( $' + total + ' total)');
     }
   });
   // [ Custom Toolbar Elements ]
   $('#c-tool-ele').DataTable({
     dom: '<"toolbar">frtip'
   });
   // [ Custom Toolbar Elements ]
   $('div.toolbar').html('<b>Custom tool bar! Text/images etc.</b>');
   // [ custom callback ]
   // $('#row-callback').DataTable({
   //   createdRow: function (row, data, index) {
   //     if (data[5].replace(/[\$,]/g, '') * 1 > 150000) {
   //       $('td', row).eq(5).addClass('highlight');
   //     }
   //   }
   // });
</script>
@endsection