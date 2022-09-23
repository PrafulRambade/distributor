@extends('layouts.app')

@section('title', 'Add Distributor')

@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        

        <!-- Begin Page Content -->
        <div class="container-fluid">

          	<div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h4 class="m-0 font-weight-bold text-primary"><i class="fa fa-user-tie"></i> {{ $user_role['name'] }} Permissions</h4>
                    <a class="float-right" href="{{ route('user_roles') }}">All User Roles</a>
                </div>
                <div class="card-body">
                @if($userrole_permissions)
                <form class="form" id="userrole_permissionsForm" method="POST" action="{{ route('store_userrole_permissions') }}">  
                @csrf
                <input type="hidden" name="user_role_id" value="{{$user_role['id']}}">
                <input type="hidden" name="company_id" value="{{$user_role['company_id']}}">
                <div class="d-flex justify-content-between flex-wrap"> 
                @foreach($userrole_permissions as $module => $userrole_permission)
                    <div class="card shadow mb-4 pl-4 pt-2 mr-2" style="width:24%">
                        <div class="form-group">
                            <label for="email" class="text-uppercase"><small>{{$module}}</small></label>
                            @foreach($userrole_permission as $key => $single_userrole_permission)
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="permissions[]" class="custom-control-input" id="switch-{{$module}}-{{$key}}" value="{{$single_userrole_permission['id']}}" @if(in_array($single_userrole_permission['id'],$saved_permissions)){{ ' checked' }}@endif>
                                <label class="custom-control-label" for="switch-{{$module}}-{{$key}}">{{$single_userrole_permission['permission_name']}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                </div>  
                <button class="btn btn-primary" type="submit">Submit</button>
                </form>
                @endif
                </div>
            </div>

        </div>

    </div>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; ZamaOrganics 2022</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
@endsection