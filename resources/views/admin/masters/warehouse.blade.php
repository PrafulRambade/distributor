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
                    <h4 class="m-0 font-weight-bold text-primary"><i class="fa fa-warehouse"></i> Warehouse</h4>
                    <button class="btn btn-primary float-right add_warehouse" type="button" data-toggle="modal" data-target="#addWarehouseMaster"><i class="fas fa fa-plus"></i> Add</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    @if(Auth::user()->company_id == 0)
                                    <th>Company</th>
                                    @endif
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @if($warehouses)
                            <tbody class="text-center">
                            @foreach($warehouses as $key => $warehouse)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $warehouse->name }}</td>
                                    <td>{{ $warehouse->phone }}</td>
                                    <td>{{ $warehouse->city_details['name'] }}</td>
                                    @if(Auth::user()->company_id == 0)
                                    <td>{{ $warehouse->company_details['name'] }}</td>
                                    @endif
                                    <td>{{ $warehouse->status ? "Active" : "Inactive" }}</td>
                                    <td><button type="button" data-id="{{$warehouse->id}}" class="btn btn-primary edit_warehouse"><i class="fas fa-edit"></i></button> <a href="{{ url('warehouse/delete/'.$warehouse->id) }}" data-id="{{$warehouse->id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                            @endif
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    @if(Auth::user()->company_id == 0)
                                    <th>Company</th>
                                    @endif
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
<!-- Modal -->
<div class="modal fade" id="addWarehouseMaster" tabindex="-1" role="dialog" aria-labelledby="addModulesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Warehouse</h5>
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
        {{ Form::open(array('url' => 'warehouse/store','method' => 'post')) }}
        <input type="hidden" name="wh_id" id="wh_id">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    {{ Form::text('name', $value = null, $attributes = array('class' => 'form-control form-control-user', 'id' => 'warehouseName', 'placeholder' => 'Enter Warehouse Name')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone</label>
                    {{ Form::tel('phone', $value = null, $attributes = array('class' => 'form-control', 'id' => 'warehousePhone', 'placeholder' => 'Enter Warehouse Phone')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>GST No</label>
                    {{ Form::text('gst_no', $value = null, $attributes = array('class' => 'form-control', 'id' => 'warehouseGSTNo', 'placeholder' => 'Enter Warehouse GST No ')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Address</label>
                    {{ Form::text('address', $value = null, $attributes = array('class' => 'form-control', 'id' => 'warehouseAddress', 'placeholder' => 'Enter Warehouse Address ')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>State</label>
                    {{ Form::select('state', $states, $value = null, $attributes = array('class' => 'form-control', 'id' => 'warehouseState', 'placeholder' => 'Enter Warehouse State ')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>City</label>
                    {{ Form::select('city',$cities,$value = null, $attributes = array('class' => 'form-control', 'id' => 'warehouseCity', 'placeholder' => 'Enter Warehouse City ')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Pincode</label>
                    {{ Form::text('pincode', $value = null, $attributes = array('class' => 'form-control', 'id' => 'warehousePincode', 'placeholder' => 'Enter Warehouse Pincode ')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Longitude</label>
                    {{ Form::text('longitude', $value = null, $attributes = array('class' => 'form-control', 'id' => 'warehouseLongitude', 'placeholder' => 'Enter Warehouse Longitude ')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Latitude</label>
                    {{ Form::text('latitude', $value = null, $attributes = array('class' => 'form-control', 'id' => 'warehouseLatitude', 'placeholder' => 'Enter Warehouse Latitude ')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Incharge</label>
                    {{ Form::text('incharge', $value = null, $attributes = array('class' => 'form-control', 'id' => 'warehouseIncharge', 'placeholder' => 'Enter Warehouse Incharge ')) }}
                </div>
            </div>
            <div class="col-md-6">
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
            <div class="col-md-3"> 
            {{ Form::submit('Submit', $attributes = array('class' => 'btn btn-primary btn-user btn-block')) }}</div>
            {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("change","#warehouseState",function(){
            state = $(this).val();
            $.ajax({
               type:'POST',
               url:'{{ env('APP_URL') }}getCitybyState',
               data:{'_token' : '<?php echo csrf_token() ?>','state':state},
               success:function(data) {
                    data = $.parseJSON(data);
                    if(data.status == 'success'){
                        $("#warehouseCity").html('');
                        $.each(data.cities,function(key,value){
                            $('#warehouseCity').append($("<option/>", {
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
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("click",".edit_warehouse",function(){
            wh_id = $(this).data('id');
            $.ajax({
               type:'POST',
               url:'warehouse/edit',
               data:{'_token' : '<?php echo csrf_token() ?>','wh_id':wh_id},
               success:function(data) {
                    data = $.parseJSON(data);
                    if(data.status == 'success'){
                        $("#wh_id").val(data.wh_id);
                        $("#warehouseName").val(data.warehouse.name);
                        $("#warehousePhone").val(data.warehouse.phone);
                        $("#warehouseGSTNo").val(data.warehouse.gst_no);
                        $("#warehouseAddress").val(data.warehouse.address);
                        $("#warehouseState").val(data.warehouse.state).trigger("change");
                        $("#warehouseCity").val(data.warehouse.city);
                        $("#warehousePincode").val(data.warehouse.pincode)
                        $("#warehouseLongitude").val(data.warehouse.longitude);
                        $("#warehouseLatitude").val(data.warehouse.latitude);
                        $("#warehouseIncharge").val(data.warehouse.incharge);
                        $("#addWarehouseMaster").modal('show');   
                    }
                    else{
                        alert("something went wrong!");
                    }
               }
            });
        });

        $(document).on("click",".add_warehouse",function(){
            $("#wh_id").val('');
            $("#warehouseName").val('');
            $("#warehousePhone").val('');
            $("#warehouseGSTNo").val('');
            $("#warehouseAddress").val('');
            $("#warehouseState").val('');
            $("#warehouseCity").val('');
            $("#warehousePincode").val('');
            $("#warehouseLongitude").val('');
            $("#warehouseLatitude").val('');
            $("#warehouseIncharge").val('');
        });
    });
</script>
@include("layouts.footer")