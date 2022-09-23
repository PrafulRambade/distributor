@extends('layouts.app')

@section('title', 'Add Distributor')

@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        {{-- @include("layouts.topbar") --}}

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
                    <h4 class="m-0 font-weight-bold text-primary"><i class="fa fa-user-tie"></i> User Roles</h4>
                    <button class="btn btn-primary float-right add_userrole" type="button" data-toggle="modal" data-target="#addUserRolesModal"><i class="fas fa fa-plus"></i> Add</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    
                                   
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @if($user_roles)
                            <tbody class="text-center">
                            @foreach($user_roles as $key => $user_role)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$user_role->name}}</td>
                                   
                                    <td>{{ $user_role->status ? "Active" : "Inactive" }}</td>
                                    <td>{{ date("d-m-Y",strtotime($user_role->created_at)) }}</td>
                                    <td><a href="{{url('userrole_permissions/'.$user_role->id)}}" class="btn btn-info" data-id="{{$user_role->id}}"><i class="fas fa-user-lock"></i></a> <button type="button" data-id="{{$user_role->id}}" class="btn btn-primary edit_userrole"><i class="fas fa-edit"></i></button> <a href="{{ url('user_roles/delete/'.$user_role->id) }}" data-id="{{$user_role->id}}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                            @endif
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                   
                                    <th>Status</th>
                                    <th>Date</th>
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
<!-- Modal -->
<div class="modal fade" id="addUserRolesModal" tabindex="-1" role="dialog" aria-labelledby="addUserRoleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{ Form::open(array('url' => 'user_roles/store','method' => 'post')) }}
        <div class="form-group">
            {{Form::hidden('userrole_id', $value = null, $attributes = array('class' => 'form-control form-control-user', 'id' => 'roleId'))}}
            <label>Name</label>
            {{ Form::text('name', $value = null, $attributes = array('class' => 'form-control form-control-user', 'id' => 'roleName', 'placeholder' => 'Enter Role Name')) }}
        </div>
        <div class="form-group">
            <label>Status</label>
            <div class="form-check">
                {{ Form::radio('status', 1, true, ['class' => 'form-check-input']); }}<label class="form-check-label">Active</label>
            </div>
            <div class="form-check">
                {{ Form::radio('status', 0, false, ['class' => 'form-check-input']); }}<label class="form-check-label">Inactive</label>
            </div>
        </div> 
        <div class="col-md-4"> 
            {{ Form::submit('Submit', $attributes = array('class' => 'btn btn-primary btn-user btn-block')) }}
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("click",".edit_userrole",function(){
            userrole_id = $(this).data('id');
            $.ajax({
               type:'POST',
               url:'user_roles/edit',
               data:{'_token' : '<?php echo csrf_token() ?>','userrole_id':userrole_id},
               success:function(data) {
                    data = $.parseJSON(data);
                    if(data.status == 'success'){
                        $("#roleId").val(data.userrole_id);
                        $("#roleName").val(data.userrole_name);
                        $("#addUserRolesModal").modal('show');   
                    }
                    else{
                        alert("something went wrong!");
                    }
               }
            });
        });

        $(document).on("click",".add_userrole",function(){
            $("#roleId").val('');
            $("#roleName").val('');
        });
    });
</script>
@endsection