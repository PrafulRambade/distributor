@extends('layouts.app')

@section('title', 'Add Distributor')

@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        @include("layouts.topbar")

        <!-- Begin Page Content -->
        <div class="container-fluid">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
          	<!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h4 class="m-0 font-weight-bold text-primary"><i class="fa fa-users"></i> Users</h4>
                    <a class="btn btn-primary float-right" href="{{ route('users.create') }}"><i class="fas fa fa-plus"></i> Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    @if(Auth::user()->company_id == 0)
                                    <th>Company</th>
                                    @endif
                                    <th>User Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @if($users)
                            <tbody class="text-center">
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    @if(Auth::user()->company_id == 0)
                                    <td>{{$user->company['name']}}</td>
                                    @endif
                                    <td>@if($user->user_role_details){{ $user->user_role_details['name'] }}@else{{ "-" }}@endif</td>
                                    <td>{{ $user->status ? "Active" : "Inactive" }}</td>
                                    <td><a href="{{ url('users/edit/'.$user->id) }}" data-id="{{$user->id}}" class="btn btn-primary"><i class="fas fa-edit"></i></a> <a href="{{ url('users/delete/'.$user->id) }}" data-id="{{$user->id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fas fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                            @endif
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    @if(Auth::user()->company_id == 0)
                                    <th>Company</th>
                                    @endif
                                    <th>User Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

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
<!-- End of Content Wrapper -->
@endsection