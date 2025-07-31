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
                     <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-map">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 7l6 -3l6 3l6 -3v13l-6 3l-6 -3l-6 3v-13" />
                        <path d="M9 4v13" />
                        <path d="M15 7v13" />
                     </svg>
                     Edit User
                  </h5>
               </div>
               <div class="card-body" bis_skin_checked="1">
                  <div class="row" bis_skin_checked="1">
                     <div class="col-md-12 comn_md comn_md" bis_skin_checked="1">
                         <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-4" bis_skin_checked="1">
                                        <label class="form-label" >First Name</label>
                                        <input type="text" name="first_name" value="{{old('first_name', $user->details->first_name)}}" class="form-control"  placeholder="Enter First Name">
                                        @error('first_name')
                                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                </div>
                                <div class="col-md-4" bis_skin_checked="1">
                                        <label class="form-label" >Last Name</label>
                                        <input type="text" name="last_name" value="{{old('last_name', $user->details->last_name)}}" class="form-control"  placeholder="Enter Last Name">
                                        @error('last_name')
                                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                </div>
                                <div class="col-md-4" bis_skin_checked="1">
                                    <label class="form-label" >Address</label>
                                    <input type="text" name="address" value="{{old('address', $user->details->address)}}" class="form-control"  placeholder="Enter Address">
                                    @error('address')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>   
                            <div class="row mb-3"> 
                                <div class="col-md-4" bis_skin_checked="1">
                                    <label class="form-label" >Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{old('phone', $user->details->phone)}}" placeholder="Enter Phone">
                                    @error('phone')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4" bis_skin_checked="1">
                                    <label class="form-label" >Email ID</label>
                                    <input type="text" name="email" class="form-control" value="{{old('email', $user->email)}}" placeholder="Enter Email ID">
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

                              {{-- Passport Preview --}}
                              @if($user->details->passport)
                                 <div class="mb-2">
                                    <label class="form-label">Current Passport</label><br>
                                    @if(Str::endsWith($user->details->passport, ['.jpg', '.jpeg', '.png']))
                                          <img src="{{ asset('storage/' . $user->details->passport) }}" alt="Passport" width="150" class="img-thumbnail">
                                    @elseif(Str::endsWith($user->details->passport, ['.pdf']))
                                          <a href="{{ asset('storage/' . $user->details->passport) }}" target="_blank" class="btn btn-sm btn-outline-secondary">View Passport PDF</a>
                                    @endif
                                 </div>
                              @endif
                           </div>
                           <div class="col-md-4" bis_skin_checked="1">
                              <label class="form-label" >Pictures</label>
                              <input type="file" name="picture"  class="form-control"  placeholder="Upload Pictures">
                              @error('picture')
                                       <small class="text-danger d-block mt-1">{{ $message }}</small>
                              @enderror

                                {{-- Picture Preview --}}
                              @if($user->details->picture)
                                 <div class="mb-2">
                                    <label class="form-label">Current Picture</label><br>
                                    <img src="{{ asset('storage/' . $user->details->picture) }}" alt="Picture" width="150" class="img-thumbnail">
                                 </div>
                              @endif
                            </div>

                           <div class="clear"></div>
                           <div class="col-md-4">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
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

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">Update User</button>
                                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
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