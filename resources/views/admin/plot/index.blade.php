@extends('admin.main')

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
                @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="row-callback" class="table table-striped table-bordered nowrap">
                      <thead>
                          <tr>
                              <th>Project Name</th>
                              <th>Plot Label</th>
                              <th>Added User</th>
                              <th>Plots</th>
                              <th>Edit</th>
                              <th>Delete</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($projects as $project)
                              @foreach($project->wings as $wing)
                                  <tr>
                                      <td>{{ $project->name }}</td>
                                      <td><span class="badge bg-primary">{{ $wing->plot_label }}</span></td>
                                      <td>
                                          {{ optional(optional($project->user)->details)->first_name ?? 'N/A' }}
                                          {{ optional(optional($project->user)->details)->last_name ?? '' }}
                                      </td>
                                      <td>
                                          @forelse($wing->plots as $plot)
                                              <span class="badge bg-info">{{ $plot->plot_name }}</span>
                                          @empty
                                              <span class="text-muted">No Plots</span>
                                          @endforelse
                                      </td>
                                      <td>
                                          @if($wing->plots->isNotEmpty())
                                              <a href="{{route('admin.plot.edit', $wing->plots->first()->id) }}" class="edit_movie" > 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> 
                                                  <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /> 
                                                  <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                  <path d="M16 5l3 3" /> 
                                                </svg> 
                                              </a>
                                          @else
                                              <span class="text-muted">N/A</span>
                                          @endif
                                      </td>
                                      <td>
                                          @if($wing->plots->isNotEmpty())
                                              <button type="button" class="btn btn-link p-0 m-0 border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $wing->plots->first()->id }}"> 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash text-danger"> 
                                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <path d="M4 7l16 0" /> 
                                                  <path d="M10 11l0 6" /> 
                                                  <path d="M14 11l0 6" /> 
                                                  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /> <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /> 
                                                </svg> 
                                              </button>
                                              {{$wing->plots->first()->id}}
                                              <!-- Delete Modal -->
                                              <div class="modal fade" id="deleteModal{{ $wing->plots->first()->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $wing->plots->first()->id}}" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h5 class="modal-title" id="deleteModalLabel{{ $wing->plots->first()->id }}">Confirm Delete</h5>
                                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <div class="modal-body">
                                                              Are you sure you want to delete <strong>{{ $project->name }} - {{ $wing->plot_label }}</strong>?
                                                          </div>
                                                          <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                              <form action="{{ route('admin.plot.destroy', $wing->plots->first()->id) }}" method="POST">
                                                                  @csrf
                                                                  @method('DELETE')
                                                                  <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                              </form>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          @else
                                              <span class="text-muted">N/A</span>
                                          @endif
                                      </td>
                                  </tr>
                              @endforeach
                          @endforeach
                      </tbody>
                  </table>

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
<script src="{{ asset('admin/assets/js/plugins/dataTables.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/plugins/dataTables.bootstrap5.min.js')}}"></script>
<script>
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

