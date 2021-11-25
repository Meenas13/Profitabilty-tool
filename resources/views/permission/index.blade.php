@extends('layouts.main') 
@section('title', 'Permission')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-unlock bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Permissions')}}</h5>
                            <span>{{ __('Define permissions of user')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../index.html"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Permissions')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
           
            <!-- only those have manage_permission permission will get access -->
            @can('manage_permission')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ __('Add Permission')}}</h3></div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{url('permission/create')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="permission">{{ __('Permission')}}<span class="text-red">*</span></label>
                                        <input type="text" class="form-control" id="permission" name="permission" placeholder="Permission Name" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="exampleInputEmail3">&nbsp;</label>
                                    <div class="form-group">
                                        <input type="hidden" name="roleId" value="{{$roleId}}">
                                        <button type="submit" class="btn btn-primary btn-rounded">{{ __('Save')}}</button>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{url('permission/update')}}">
                        @csrf
                        <table id="permission_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('#')}}</th>
                                    <th>{{ __('Permission')}}</th>
                                    <th>{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($permissions as $key => $permission){
                                    $listChecked = ""; 
                                    if(!empty($data[$key])){
                                        $listChecked = 'checked';
                                    }
                                    
                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="lists[{{$key}}]"  value="1" {{$listChecked}}>
                                        
                                    </td>
                                    <td>{{$permission}}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="{{url('permission/delete/')}}{{$key}}">
                                                <i class="ik ik-trash-2 f-16 text-red"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                               <?php } ?>
                            </tbody>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                <br/><br/>
                                 <input type="hidden" name="roleId" value="{{$roleId}}">
                                 <button type="submit" class="btn btn-primary waves-effect waves-light me-1">{{ __('Update')}}</button>
                                 
                                <a href="{{url('roles')}}" class="btn btn-secondary waves-effect back">{{ __('Back')}}</a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    

    @endpush
@endsection
