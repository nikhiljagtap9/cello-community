@extends('admin.main')

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
                     <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                     Add User
                  </h5>
               </div>
               <div class="card-body" bis_skin_checked="1">
                  <div class="row" bis_skin_checked="1">
                     <div class="col-md-12 comn_md comn_md" bis_skin_checked="1">
                        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-4" bis_skin_checked="1">
                                        <label class="form-label" >First Name</label>
                                        <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control"  placeholder="Enter First Name">
                                        @error('first_name')
                                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                </div>
                                <div class="col-md-4" bis_skin_checked="1">
                                        <label class="form-label" >Last Name</label>
                                        <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control"  placeholder="Enter Last Name">
                                        @error('last_name')
                                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                </div>
                                <div class="col-md-4" bis_skin_checked="1">
                                    <label class="form-label" >Address</label>
                                    <input type="text" name="address" value="{{old('address')}}" class="form-control"  placeholder="Enter Address">
                                    @error('address')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>   
                            <div class="row mb-3"> 
                                <div class="col-md-4" bis_skin_checked="1">
                                    <label class="form-label" >Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{old('phone')}}" placeholder="Enter Phone">
                                    @error('phone')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4" bis_skin_checked="1">
                                    <label class="form-label" >Email ID</label>
                                    <input type="text" name="email" class="form-control" value="{{old('email')}}" placeholder="Enter Email ID">
                                    @error('email')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>    
                           <div class="clear"></div>

                           <div class="col-md-4" bis_skin_checked="1">
                                <label class="form-label" >Passport/Identification Card </label>
                                <input type="file" name="passport"  class="form-control"  placeholder="Upload Passport/Identification Card">
                                @error('passport')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                           <div class="col-md-4" bis_skin_checked="1">
                                <label class="form-label" >Pictures</label>
                                <input type="file" name="picture"  class="form-control"  placeholder="Upload Pictures">
                                @error('picture')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                           <div class="clear"></div>
                           <div class="col-md-4">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" value="{{old('password')}}" class="form-control" placeholder="Enter Password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                           
                           <div class="clear"></div>

                           <button type="submit" class="btn btn-primary mb-4 submi_movi"  >Add User</button>
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