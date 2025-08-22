@extends('prospect.main')

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
      @forelse($subFreelancers as $sub)
          <div class="row">
              <div class="clear"></div>
              <div class="new_prjct_titl">Sub Freelancer {{ $loop->iteration == 1 ? 'A' : 'B' }}</div>

              {{-- Left side table --}}
              <div class="col-8">
                  <div class="card table-card">
                      <div class="card-header d-flex align-items-center justify-content-between py-3">
                          <h5 class="mb-0">Prospects added by Freelancer {{ $loop->iteration == 1 ? 'A' : 'B' }}</h5>
                          <a href="{{ route('prospect.allProspects', $sub->id) }}" class="btn btn-sm btn-link-primary">View All</a>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <th>First Name</th>
                                          <th>Last Name</th>
                                          <th>Address</th>
                                          <th>Phone</th>
                                          <th>Email ID</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @forelse($sub->prospects as $prospect)
                                          <tr>
                                              <td>{{ $prospect->details->first_name ?? '' }}</td>
                                              <td>{{ $prospect->details->last_name ?? '' }}</td>
                                              <td>{{ $prospect->details->address ?? '' }}</td>
                                              <td>{{ $prospect->details->phone ?? '' }}</td>
                                              <td>{{ $prospect->email }}</td>
                                          </tr>
                                      @empty
                                          <tr>
                                              <td colspan="5" class="text-center">No prospects found.</td>
                                          </tr>
                                      @endforelse
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>

              {{-- Right side stats --}}
              <div class="col-xl-4 col-md-4">
                  <div class="card social-res-card">
                      <div class="card-header">
                          <h5>Prospects by Freelancer {{ $loop->iteration == 1 ? 'A' : 'B' }}</h5>
                      </div>
                      <div class="card-body invtd_wrp">
                          <p class="m-b-10">Invited Prospects</p>
                          <div class="count_main">{{ $sub->totalInvited }}</div>
                          <div class="clear"></div>
                          <div class="progress m-b-25" style="height: 6px">
                              <div class="progress-bar bg-primary" style="width: {{ $sub->totalInvited > 0 ? ($sub->totalInvited / max($sub->totalInvited,1)) * 100 : 0 }}%"></div>
                          </div>

                          <p class="m-b-10">Added Prospects</p>
                          <div class="count_main">{{ $sub->addedProspects }}</div>
                          <div class="clear"></div>
                          <div class="progress m-b-25" style="height: 6px">
                              <div class="progress-bar bg-primary" style="width: {{ $sub->totalInvited > 0 ? ($sub->addedProspects / $sub->totalInvited) * 100 : 0 }}%"></div>
                          </div>

                          <p class="m-b-10">Pending Prospects</p>
                          <div class="count_main">{{ $sub->pendingProspects }}</div>
                          <div class="clear"></div>
                          <div class="progress" style="height: 6px">
                              <div class="progress-bar bg-primary" style="width: {{ $sub->totalInvited > 0 ? ($sub->pendingProspects / $sub->totalInvited) * 100 : 0 }}%"></div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      @empty
          <div class="col-12">
              <div class="alert alert-warning text-center">
                  No sub-freelancers available.
              </div>
          </div>
      @endforelse
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
<script src="{{ asset('prospect/assets/js/plugins/dataTables.min.js')}}"></script>
<script src="{{ asset('prospect/assets/js/plugins/dataTables.bootstrap5.min.js')}}"></script>
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