@include("layouts.header")
@include("layouts.sidebar")
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
                    <h4 class="m-0 font-weight-bold text-primary"><i class="fa fa-ruler"></i> SO Status</h4>
                    <button class="btn btn-primary float-right add_status" type="button" data-toggle="modal" data-target="#addSOStatus"><i class="fas fa fa-plus"></i> Add</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @if($so_statuses)
                            <tbody class="text-center">
                            @foreach($so_statuses as $key => $so_status)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $so_status->name }}</td>
                                    <td>{{ date("d-m-Y",strtotime($so_status->created_at)) }}</td>
                                    <td><button type="button" data-id="{{$so_status->id}}" class="btn btn-primary edit_status"><i class="fas fa-edit"></i></button> <!-- <a href="{{ url('so_status/delete/'.$so_status->id) }}" data-id="{{$so_status->id}}" class="btn btn-danger"><i class="fas fa-trash"></i></a> --></td>
                                </tr>
                            @endforeach
                            </tbody>
                            @endif
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
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
<div class="modal fade" id="addSOStatus" tabindex="-1" role="dialog" aria-labelledby="addModulesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add SO Status</h5>
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
        {{ Form::open(array('url' => 'so_status/store','method' => 'post')) }}
        <input type="hidden" name="status_id" id="status_id">
        <div class="form-group">
            <label>Name</label>
            {{ Form::text('name', $value = null, $attributes = array('class' => 'form-control form-control-user', 'id' => 'soStatusName', 'placeholder' => 'Enter Status Name')) }}
        </div>
        <div class="col-md-3"> 
        {{ Form::submit('Submit', $attributes = array('class' => 'btn btn-primary btn-user btn-block')) }}</div>
        {{ Form::close() }}

      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("click",".edit_status",function(){
            status_id = $(this).data('id');
            $.ajax({
               type:'POST',
               url:'so_status/edit',
               data:{'_token' : '<?php echo csrf_token() ?>','status_id':status_id},
               success:function(data) {
                    data = $.parseJSON(data);
                    if(data.status == 'success'){
                        $("#status_id").val(data.status_id);
                        $("#soStatusName").val(data.name);
                        $("#addSOStatus").modal('show');   
                    }
                    else{
                        alert("something went wrong!");
                    }
               }
            });
        });

        $(document).on("click",".add_status",function(){
            $("#status_id").val('');
            $("#soStatusName").val('');
        });
    });
</script>
@include("layouts.footer")