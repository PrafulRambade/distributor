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
                    <h4 class="m-0 font-weight-bold text-primary"><i class="fa fa-ruler"></i> UOM</h4>
                    <button class="btn btn-primary float-right add_uom" type="button" data-toggle="modal" data-target="#addUOMMaster"><i class="fas fa fa-plus"></i> Add</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="uomTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            
                            </tbody>
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
<div class="modal fade" id="addUOMMaster" tabindex="-1" role="dialog" aria-labelledby="addModulesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add UOM</h5>
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
        {{ Form::open(array('url' => 'uom/store','method' => 'post')) }}
        {{Form::hidden('uom_id', $value = null, $attributes = array('class' => 'form-control form-control-user', 'id' => 'uomId'))}}
        <div class="form-group">
            <label>Name</label>
            {{ Form::text('name', $value = null, $attributes = array('class' => 'form-control form-control-user', 'id' => 'uomName', 'placeholder' => 'Enter UOM Name')) }}
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
        <div class="col-md-3"> 
        {{ Form::submit('Submit', $attributes = array('class' => 'btn btn-primary btn-user btn-block')) }}</div>
        {{ Form::close() }}

      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("click",".edit_uom",function(){
            uom_id = $(this).data('id');
            $.ajax({
               type:'POST',
               url:'uom/edit',
               data:{'_token' : '<?php echo csrf_token() ?>','uom_id':uom_id},
               success:function(data) {
                    data = $.parseJSON(data);
                    if(data.status == 'success'){
                        $("#uomId").val(data.uom_id);
                        $("#uomName").val(data.uom_name);
                        $("#addUOMMaster").modal('show');   
                    }
                    else{
                        alert("something went wrong!");
                    }
               }
            });
        });

        $(document).on("click",".add_uom",function(){
            $("#uomId").val('');
            $("#uomName").val('');
        });

        // DataTable
          $('#uomTable').DataTable({
             processing: true,
             serverSide: true,dom: 'Bfrtip',
                buttons: [
                  { extend: 'csv',
                    filename: function(){
                        var d = new Date();
                        var n = d.getTime();
                        return 'Category_' + n;
                    }, className: 'btn float-left mr-2 btn-primary' },
                  { extend: 'excel',
                    filename: function(){
                        var d = new Date();
                        var n = d.getTime();
                        return 'Category_' + n;
                    }, 
                    className: 'btn float-left mr-2 btn-primary' },
            ],
             ajax: "{{route('uom.getUoms')}}",
             columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'status' },
                { data: 'date'},
                {  data : 'id',
                    render : function(data, type, row) {
                        var delete_path = "<?= route('uom.delete',['id'=>':id']) ?>";
                        delete_path = delete_path.replace(':id',data);
                      return '<button type="button" data-id="'+data+'" class="btn btn-primary edit_uom"><i class="fas fa-edit"></i></button> <a href="'+delete_path+'" class="btn btn-danger"><i class="fas fa-trash"></i></button>';
                    }    
                },
             ]
          });
    });
</script>
@include("layouts.footer")