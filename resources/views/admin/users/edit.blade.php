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

          	<!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h4 class="m-0 font-weight-bold text-primary"><i class="fa fa-edit"></i> Edit User</h4>
                    <a class="float-right" href="{{ route('users.index') }}">All Users</a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{ Form::open(array('url' => 'users/update','method' => 'post')) }}
                    <input type="hidden" name="user_id" value="{{ $user['id'] }}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                {{ Form::text('name', $user['name'], $attributes = array('class' => 'form-control form-control-user', 'id' => 'userName', 'placeholder' => 'Enter Name')) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                {{ Form::email('email', $user['email'], $attributes = array('class' => 'form-control', 'id' => 'userEmail', 'placeholder' => 'Enter Email')) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Password</label>
                                {{ Form::password('password',  $attributes = array('class' => 'form-control', 'id' => 'userPassword', 'placeholder' => 'Enter Password')) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Company</label>
                                {{ Form::select('company_id', $companies, $user['company_id'], $attributes = array('class' => 'form-control', 'id' => 'userCompany', 'placeholder' => 'Select Company ')) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>User Role</label>
                                {{ Form::select('user_role',$user_roles,$user['user_role'], $attributes = array('class' => 'form-control', 'id' => 'userRole', 'placeholder' => 'Select User Role ')) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone</label>
                                {{ Form::tel('phone', $user['phone'], $attributes = array('class' => 'form-control', 'id' => 'companyPhone', 'placeholder' => 'Enter Company Phone')) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>PAN No</label>
                                {{ Form::text('pan_no', $user['pan_no'], $attributes = array('class' => 'form-control', 'id' => 'userPanno', 'placeholder' => 'Enter PAN No ')) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Aadhar No</label>
                                {{ Form::text('aadhar_no', $user['aadhar_no'], $attributes = array('class' => 'form-control', 'id' => 'userAadharno', 'placeholder' => 'Enter Aadhar No ')) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                {{ Form::date('dob', $user['dob'], $attributes = array('class' => 'form-control', 'id' => 'userDob', 'placeholder' => 'Enter DOB ')) }}
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date of Joining</label>
                                {{ Form::date('doj', $user['doj'], $attributes = array('class' => 'form-control', 'id' => 'userDoj', 'placeholder' => 'Enter DOJ ')) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status</label>
                                <div class="form-check">
                                    {{ Form::radio('status', 1, true, ['class' => 'form-check-input']); }}<label class="form-check-label">Active</label>
                                </div>
                                <div class="form-check">
                                    {{ Form::radio('status', 0, false, ['class' => 'form-check-input']); }}<label class="form-check-label">Inactive</label>
                                </div>
                            </div> 
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4"> 
                            {{ Form::submit('Submit', $attributes = array('class' => 'btn btn-primary')) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
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
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("change","#userCompany",function(){
            company = $(this).val();
            $.ajax({
               type:'POST',
               url:'{{ env('APP_URL') }}getUserrolebyCompany',
               data:{'_token' : '<?php echo csrf_token() ?>','company':company},
               success:function(data) {
                    data = $.parseJSON(data);
                    if(data.status == 'success'){
                        $("#userRole").html('');
                        $.each(data.roles,function(key,value){
                            $('#userRole').append($("<option/>", {
                               value: key,
                               text: value
                            }));
                        });
                    }
               }
            });
        });
    });
</script>
@endsection
