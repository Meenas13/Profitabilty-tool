@extends('layouts.main') 
@section('title', __('Update Profile'))
@section('content')
    

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Update Profile')}}</h5>
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12"> 
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center"> 
                           <!--  <img src="../img/user.jpg" class="rounded-circle" width="150" /> -->
                            @if(file_exists(public_path('profile_img/'.$user->profile_img)) && $user->profile_img!="")
                             <img src="{{asset('profile_img/'.$user->profile_img)}}" alt="Profile Image" class="rounded-circle" width="150">
                            @endif 
                            <h4 class="card-title mt-10">{{ $user->name}}</h4>
                            
                        </div>
                    </div>
                    <hr class="mb-0"> 
                    <div class="card-body"> 
                        <small class="text-muted d-block">{{ __('Email')}} </small>
                        <h6>{{$user->email}}</h6> 
                        <small class="text-muted d-block pt-10">{{ __('Phone No')}}</small>
                        <h6>{{$user->phone}}</h6> 
                        <small class="text-muted d-block pt-10">{{ __('Address')}}</small>
                        <h6>{{$user->address}}</h6> 

                        
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">

                   
                    <div class="tab-content" id="pills-tabContent">
                       
                       
                         <div class="tab-pane fade show active" id="profile-tab" role="tabpanel" aria-labelledby="pills-profile-tab-tab">
                            <div class="card-body">
                            <form name="frm_user" method="post" class="form-horizontal" action="{{route('user-profile')}}" enctype="multipart/form-data">
                            <input type="hidden" placeholder="Johnathan Doe" class="form-control" name="user_id" id="user_id" value="{{$user->id}}">
                                @csrf
                                    <div class="form-group">
                                        <label for="example-name">{{ __('Fullname')}}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email">{{ __('Email')}}<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="example-password">{{ __('Password')}}</label>
                                        <input type="password"  class="form-control" name="password" id="password">
                                        @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="example-phone">{{ __('Phone')}}</label>
                                        <input type="text"  id="phone" name="phone" class="form-control" value="{{$user->phone}}">

                                        @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="example-message">{{ __('Address')}}</label>
                                        <textarea name="address" name="address" rows="4" class="form-control">{{$user->address}}</textarea>
                                        @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group" {{ $errors->has('profile_img') ? 'has-error' : ''}}>
                                        <label for="example-phone">{{ __('Profile Image')}}</label>
                                        <input type="file" id="profile_img" name="profile_img" class="form-control" >
                                        {!! $errors->first('profile_img', '<span class="text-danger">:message </span>') !!}
                                        @if(file_exists(public_path('profile_img/'.$user->profile_img)) && $user->profile_img!="")
                                        <img src="{{asset('profile_img/'.$user->profile_img)}}" alt="Profile Image" width="150">
                                        @endif

                                    </div>
                                   
                                    <button class="btn btn-primary waves-effect waves-light me-1" type="submit">{{ __('Update')}} </button>
                                </form>
                            </div>
                        </div>
                  
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('script')
<script type="text/javascript" defer>
    $(document).ready(function(){

       $("form[name='frm_user']").validate({
            rules: {
                
                name: "required",
                email: "required",        
            },
            // Specify validation error messages
            messages: {
            
             name: "{{__('jquery.name')}}",
             email: "{{__('jquery.email')}}",
                          
            },
            submitHandler: function(form) {
                form.submit();
            }
        }); 
    });
</script>
@endpush    
@endsection
