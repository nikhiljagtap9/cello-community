@extends('user.main')

@section('content')
<section class="pc-container">
   <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <!-- [ breadcrumb ] end -->
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header">
                  <h5>
                     <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
                     </svg>
                     New Project
                  </h5>
               </div>
               <div class="row new_prjct_wrp" bis_skin_checked="1">
                    <div class="clear"></div>
                    @forelse($projects as $project)
                            <div class="col-sm-6 col-xl-4" bis_skin_checked="1">
                                <div class="card statistics-card-1" bis_skin_checked="1">
                                    <div class="card-body" bis_skin_checked="1">
                                    <img src="{{ asset('user/assets/images/aa.jpg')}}" alt="img" class="img-fluid img-bg h-100 img_map_ind">
                                    <div class="" bis_skin_checked="1">
                                        <h3 class="f-w-300 d-flex align-items-center m-b-0">
                                            {{ ucwords($project->name) }}
                                            </small>
                                        </h3>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="projct_desc">
                                        {{ ucwords($project->description) }}
                                    </div>
                                    <div class="clear"></div>
                                    <a class="btn btn-sm btn-primary plot_ad_new" href="{{route('user.project.show',$project->id)}}">
                                    View Project
                                    </a>
                                    <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                    @empty
                        <p>No new projects available.</p>
                    @endforelse
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
   $('#row-callback').DataTable({
     createdRow: function (row, data, index) {
       if (data[5].replace(/[\$,]/g, '') * 1 > 150000) {
         $('td', row).eq(5).addClass('highlight');
       }
     }
   });
</script>
@endsection
