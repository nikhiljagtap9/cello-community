@extends('user.main')

@section('content')
<style type="text/css">
   .activ_dash {
   background: #f4f7fa;
   border-radius: 10px;
   }
   body{
   background:#fff;
   }
</style>
<!-- [ Main Content ] start -->
<div class="pc-container">
   <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
         <div class="page-block">
            <div class="row align-items-center">
               <div class="col-md-12">
                  <div class="page-header-title">
                     <h2 class="mb-0">🌞 Hello, {{ $user->details->first_name }} {{ $user->details->last_name }}
                        <span class="super_admn" > ({{ ucfirst($user->user_type) }}) </span> </h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
            <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
         <div class="row" bis_skin_checked="1">
            
            <div class="new_prjct_titl">New Projects for You</div>
            <div class="clear"></div>
            <div class="col-sm-6 col-xl-4" bis_skin_checked="1">
               <div class="card statistics-card-1" bis_skin_checked="1">
                   
                  <div class="card-body" bis_skin_checked="1">
                     <img src="assets/images/aa.jpg" alt="img" class="img-fluid img-bg h-100 img_map_ind">
                     <div class="" bis_skin_checked="1">
                        <h3 class="f-w-300 d-flex align-items-center m-b-0">
                           Lorem Project
                        </small></h3>

                     </div>

                     <div class="clear"></div> 
                        <div class="projct_desc">
                           Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        </div>
                        <div class="clear"></div>


                     <a class="btn btn-sm btn-primary plot_ad_new" href="project_detail.php">
                     View Project
                     </a>
                     <div class="clear"></div>
                  </div>
               </div>
            </div>

            <div class="col-sm-6 col-xl-4" bis_skin_checked="1">
               <div class="card statistics-card-1" bis_skin_checked="1">
                   
                  <div class="card-body" bis_skin_checked="1">
                     <img src="assets/images/aa.jpg" alt="img" class="img-fluid img-bg h-100 img_map_ind">
                     <div class="" bis_skin_checked="1">
                        <h3 class="f-w-300 d-flex align-items-center m-b-0">
                           Lorem Project
                        </small></h3>

                     </div>

                     <div class="clear"></div> 
                        <div class="projct_desc">
                           Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        </div>
                        <div class="clear"></div>


                     <a class="btn btn-sm btn-primary plot_ad_new" href="project_detail.php">
                     View Project
                     </a>
                     <div class="clear"></div>
                  </div>
               </div>
            </div>

            <div class="col-sm-6 col-xl-4" bis_skin_checked="1">
               <div class="card statistics-card-1" bis_skin_checked="1">
                   
                  <div class="card-body" bis_skin_checked="1">
                     <img src="assets/images/aa.jpg" alt="img" class="img-fluid img-bg h-100 img_map_ind">
                     <div class="" bis_skin_checked="1">
                        <h3 class="f-w-300 d-flex align-items-center m-b-0">
                           Lorem Project
                        </small></h3>

                     </div>

                     <div class="clear"></div> 
                        <div class="projct_desc">
                           Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        </div>
                        <div class="clear"></div>


                     <a class="btn btn-sm btn-primary plot_ad_new" href="project_detail.php">
                     View Project
                     </a>
                     <div class="clear"></div>
                  </div>
               </div>
            </div>

            <div class="col-sm-6 col-xl-4" bis_skin_checked="1">
               <div class="card statistics-card-1" bis_skin_checked="1">
                   
                  <div class="card-body" bis_skin_checked="1">
                     <img src="assets/images/aa.jpg" alt="img" class="img-fluid img-bg h-100 img_map_ind">
                     <div class="" bis_skin_checked="1">
                        <h3 class="f-w-300 d-flex align-items-center m-b-0">
                           Lorem Project
                        </small></h3>

                     </div>

                     <div class="clear"></div> 
                        <div class="projct_desc">
                           Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        </div>
                        <div class="clear"></div>


                     <a class="btn btn-sm btn-primary plot_ad_new" href="project_detail.php">
                     View Project
                     </a>
                     <div class="clear"></div>
                  </div>
               </div>
            </div>
            
         </div>
          
      </div>
    
      <!-- [ Row 2 ] end -->
   </div>
   <!-- [ Main Content ] end -->
</div>
</div>
<!-- [ Main Content ] end -->


@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('user/assets/js/plugins/dataTables.min.js')}}"></script>
<script src="{{ asset('user/assets/js/plugins/dataTables.bootstrap5.min.js')}}"></script>
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
   $('.row-callback').DataTable({
     createdRow: function (row, data, index) {
       if (data[5].replace(/[\$,]/g, '') * 1 > 150000) {
         $('td', row).eq(5).addClass('highlight');
       }
     }
   });
</script>
@endsection