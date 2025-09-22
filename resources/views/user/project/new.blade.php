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
                                    {{ Str::words(ucwords($project->description), 50, '...') }}
                                </div>

                                <div class="clear"></div>
                                <a class="btn btn-sm btn-primary plot_ad_new" href="{{URL('user/projects/view/'.en_de_crypt($project->id))}}">
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
@endsection