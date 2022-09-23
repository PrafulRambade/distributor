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
                    <h4 class="m-0 font-weight-bold text-primary"><i class="fa fa-map-marker"></i> Area Master</h4>
                    <button class="btn btn-primary float-right add_area" type="button" data-toggle="modal" data-target="#addAreaMaster"><i class="fas fa fa-plus"></i> Add</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Area</th>
                                    <th>Group</th>
                                    <th>Pincode</th>
                                    <th>Vehicle</th>
                                    <th>ERP Id</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @if($areas)
                            <tbody class="text-center">
                            @foreach($areas as $key => $area)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $area->area }}</td>
                                    <td>{{ $area->group }}</td>
                                    <td>{{ $area->pincode }}</td>
                                    <td>{{ $area->vehicle }}</td>
                                    <td>{{ $area->erp_id }}</td>
                                    <td><button type="button" data-id="{{$area->id}}" class="btn btn-primary edit_area"><i class="fas fa-edit"></i></button> <a href="{{url('area/delete/'.$area->id)}}" data-id="{{$area->id}}" class="btn btn-danger"><i class="fas fa-trash" onclick="return confirm('Are you sure you want to delete this item?');"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                            @endif
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Area</th>
                                    <th>Group</th>
                                    <th>Pincode</th>
                                    <th>Vehicle</th>
                                    <th>ERP Id</th>
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
<div class="modal fade" id="addAreaMaster" tabindex="-1" role="dialog" aria-labelledby="addModulesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Area</h5>
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
        {{ Form::open(array('url' => 'area/store','method' => 'post')) }}
        <input type="hidden" name="area_id" class="area_id">
        <div class="form-group">
            <label>Area</label>
            {{ Form::textarea('area', $value = null, $attributes = array('class' => 'form-control form-control-user', 'id' => 'areaName', 'placeholder' => 'Enter Area', 'rows' => 3)) }}
        </div>
        <div class="form-group">
            <label>Group</label>
            {{ Form::text('group',$value = null, $attributes = array('class' => 'form-control form-control-user', 'id' => 'groupName', 'placeholder' => 'Enter Group')) }}
        </div>
        <div class="form-group">
            <label>Pincode</label>
            {{ Form::Number('pincode',$value = null, $attributes = array('class' => 'form-control form-control-user', 'id' => 'pincode', 'placeholder' => 'Enter Pincode', 'min' => 100000, 'step' => 1)) }}
        </div>
        <div class="form-group">
            <label>Vehicle</label>
            {{ Form::Number('vehicle',$value = null, $attributes = array('class' => 'form-control form-control-user', 'id' => 'vehicle', 'placeholder' => 'Enter Vehicle Number', 'min' => 1, 'step' => 1)) }}
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
        $(document).on("click",".edit_area",function(){
            area_id = $(this).data('id');
            $.ajax({
               type:'POST',
               url:'area/edit',
               data:{'_token' : '<?php echo csrf_token() ?>','area_id':area_id},
               success:function(data) {
                    data = $.parseJSON(data);
                    if(data.status == 'success'){
                        $(".area_id").val(data.area_id);
                        $("#areaName").val(data.area);
                        $("#groupName").val(data.group);
                        $("#pincode").val(data.pincode);
                        $("#vehicle").val(data.vehicle);
                        $("#addAreaMaster").modal('show');   
                    }
                    else{
                        alert("something went wrong!");
                    }
               }
            });
        });

        $(document).on("click",".add_area",function(){
            $(".area_id").val('');
            $("#areaName").val('');
            $("#groupName").val('');
            $("#pincode").val('');
            $("#vehicle").val('');
        });
    });
</script>
@include("layouts.footer")