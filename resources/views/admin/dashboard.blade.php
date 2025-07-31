@extends('admin.main')

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
                     <h2 class="mb-0">🌞 Hello, Stephanie S. <span class="super_admn" > (Super Admin) </span> </h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
         <div class="row" bis_skin_checked="1">
            <!-- [ Row 1 ] start -->
            <div class="col-sm-6 col-xl-4" bis_skin_checked="1">
               <div class="card statistics-card-1" bis_skin_checked="1">
                  <div class="card-header d-flex align-items-center justify-content-between py-3 plot_remn" bis_skin_checked="1">
                     <h5>Total Plot </h5>
                     <div class="clear"></div>
                  </div>
                  <div class="card-body" bis_skin_checked="1">
                     <img src="assets/images/widget/img-status-1.svg" alt="img" class="img-fluid img-bg h-100">
                     <div class="d-flex align-items-center" bis_skin_checked="1">
                        <h3 class="f-w-300 d-flex align-items-center m-b-0">30 Plot's</small></h3>
                        <span class="badge bg-light-success ms-2">5 New Plots</span>
                     </div>
                     <a class="btn btn-sm btn-primary plot_ad_new" href="add_plot.php">
                     + Add New Plot
                     </a>
                     <div class="clear"></div>
                  </div>
               </div>
            </div>
            <div class="col-sm-6 col-xl-4" bis_skin_checked="1">
               <div class="card statistics-card-1" bis_skin_checked="1">
                  <div class="card-header d-flex align-items-center justify-content-between py-3 plot_remn" bis_skin_checked="1">
                     <h5>Total User </h5>
                     <div class="clear"></div>
                  </div>
                  <div class="card-body" bis_skin_checked="1">
                     <img src="assets/images/widget/img-status-1.svg" alt="img" class="img-fluid img-bg h-100">
                     <div class="d-flex align-items-center" bis_skin_checked="1">
                        <h3 class="f-w-300 d-flex align-items-center m-b-0">45 User's</small></h3>
                        <span class="badge bg-light-success ms-2">15 New User</span>
                     </div>
                     <a class="btn btn-sm btn-primary plot_ad_new" href="add_user.php">
                     + Add New User
                     </a>
                     <div class="clear"></div>
                  </div>
               </div>
            </div>
            <div class="col-sm-6 col-xl-4" bis_skin_checked="1">
               <div class="card statistics-card-1" bis_skin_checked="1">
                  <div class="card-header d-flex align-items-center justify-content-between py-3 plot_remn" bis_skin_checked="1">
                     <h5>Total Project </h5>
                     <div class="clear"></div>
                  </div>
                  <div class="card-body" bis_skin_checked="1">
                     <img src="assets/images/widget/img-status-1.svg" alt="img" class="img-fluid img-bg h-100">
                     <div class="d-flex align-items-center" bis_skin_checked="1">
                        <h3 class="f-w-300 d-flex align-items-center m-b-0">24 Project's</small></h3>
                        <span class="badge bg-light-success ms-2">5 New Projects</span>
                     </div>
                     <a class="btn btn-sm btn-primary plot_ad_new" href="add_project.php">
                     + Add New Project
                     </a>
                     <div class="clear"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header">
                     <h5>
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                           <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
                        </svg>
                        View Project  
                     </h5>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table  class="table table-striped table-bordered nowrap row-callback">
                           <thead>
                              <tr>
                                 <th>Project Name</th>
                                 <th>Selected Plot</th>
                                 <th>Added User</th>
                                 <th>Project Image</th>
                                 <th>Edit</th>
                                 <th>Delete</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>Lorem Project </td>
                                 <td>Lorem Plot</td>
                                 <td>Stephanie</td>
                                 <td> <a  onclick="openModal_img()" class="view_prdc"> VIEW </a> </td>
                                 <td>
                                    <a href="" class="edit_movie" >
                                       <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                          <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                          <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                          <path d="M16 5l3 3" />
                                       </svg>
                                    </a>
                                 </td>
                                 <td>
                                    <a href="" class="edit_movie delet_trsh" >
                                       <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                          <path d="M4 7l16 0" />
                                          <path d="M10 11l0 6" />
                                          <path d="M14 11l0 6" />
                                          <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                          <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                       </svg>
                                    </a>
                                 </td>
                              </tr>
                              <tr>
                                 <td>Lorem Project </td>
                                 <td>Lorem Plot</td>
                                 <td>Stephanie</td>
                                 <td> <a  onclick="openModal_img()" class="view_prdc"> VIEW </a> </td>
                                 <td>
                                    <a href="" class="edit_movie" >
                                       <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                          <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                          <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                          <path d="M16 5l3 3" />
                                       </svg>
                                    </a>
                                 </td>
                                 <td>
                                    <a href="" class="edit_movie delet_trsh" >
                                       <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                          <path d="M4 7l16 0" />
                                          <path d="M10 11l0 6" />
                                          <path d="M14 11l0 6" />
                                          <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                          <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                       </svg>
                                    </a>
                                 </td>
                              </tr>
                              <tr>
                                 <td>Lorem Project </td>
                                 <td>Lorem Plot</td>
                                 <td>Stephanie</td>
                                 <td> <a  onclick="openModal_img()" class="view_prdc"> VIEW </a> </td>
                                 <td>
                                    <a href="" class="edit_movie" >
                                       <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                          <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                          <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                          <path d="M16 5l3 3" />
                                       </svg>
                                    </a>
                                 </td>
                                 <td>
                                    <a href="" class="edit_movie delet_trsh" >
                                       <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                          <path d="M4 7l16 0" />
                                          <path d="M10 11l0 6" />
                                          <path d="M14 11l0 6" />
                                          <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                          <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                       </svg>
                                    </a>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header">
                  <h5>
                     <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-map">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 7l6 -3l6 3l6 -3v13l-6 3l-6 -3l-6 3v-13" />
                        <path d="M9 4v13" />
                        <path d="M15 7v13" />
                     </svg>
                     View Plot
                  </h5>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table  class="table table-striped table-bordered nowrap row-callback">
                        <thead>
                           <tr>
                              <th>Plot Name</th>
                              <th>Plot Size</th>
                              <th>Plot Location</th>
                              <th>Plot Dimensions</th>
                              <th>Edit</th>
                              <th>Delete</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Lorem Plot</td>
                              <td>400 square feet</td>
                              <td>Lorem Location</td>
                              <td>50 Foot X 40 Foot</td>
                              <td>
                                 <a href="" class="edit_movie" >
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                       <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                       <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                       <path d="M16 5l3 3" />
                                    </svg>
                                 </a>
                              </td>
                              <td>
                                 <a href="" class="edit_movie delet_trsh" >
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                       <path d="M4 7l16 0" />
                                       <path d="M10 11l0 6" />
                                       <path d="M14 11l0 6" />
                                       <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                       <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                 </a>
                              </td>
                           </tr>
                           <tr>
                              <td>Lorem Plot</td>
                              <td>400 square feet</td>
                              <td>Lorem Location</td>
                              <td>50 Foot X 40 Foot</td>
                              <td>
                                 <a href="" class="edit_movie" >
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                       <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                       <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                       <path d="M16 5l3 3" />
                                    </svg>
                                 </a>
                              </td>
                              <td>
                                 <a href="" class="edit_movie delet_trsh" >
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                       <path d="M4 7l16 0" />
                                       <path d="M10 11l0 6" />
                                       <path d="M14 11l0 6" />
                                       <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                       <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                 </a>
                              </td>
                           </tr>
                           <tr>
                              <td>Lorem Plot</td>
                              <td>400 square feet</td>
                              <td>Lorem Location</td>
                              <td>50 Foot X 40 Foot</td>
                              <td>
                                 <a href="" class="edit_movie" >
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                       <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                       <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                       <path d="M16 5l3 3" />
                                    </svg>
                                 </a>
                              </td>
                              <td>
                                 <a href="" class="edit_movie delet_trsh" >
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                       <path d="M4 7l16 0" />
                                       <path d="M10 11l0 6" />
                                       <path d="M14 11l0 6" />
                                       <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                       <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                 </a>
                              </td>
                           </tr>
                           <tr>
                              <td>Lorem Plot</td>
                              <td>400 square feet</td>
                              <td>Lorem Location</td>
                              <td>50 Foot X 40 Foot</td>
                              <td>
                                 <a href="" class="edit_movie" >
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                       <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                       <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                       <path d="M16 5l3 3" />
                                    </svg>
                                 </a>
                              </td>
                              <td>
                                 <a href="" class="edit_movie delet_trsh" >
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                       <path d="M4 7l16 0" />
                                       <path d="M10 11l0 6" />
                                       <path d="M14 11l0 6" />
                                       <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                       <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                 </a>
                              </td>
                           </tr>
                        </tbody>
                     </table>
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
<script src="{{ asset('admin/assets/js/plugins/dataTables.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/plugins/dataTables.bootstrap5.min.js')}}"></script>
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