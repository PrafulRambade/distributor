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
                    <h4 class="m-0 font-weight-bold text-primary"><i class="fa fa-list-alt"></i> Category</h4>
                    <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#addCategoryMaster"><i class="fas fa fa-plus"></i> Add</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="categoryTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Parent</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @if($categories)
                            <tbody class="text-center">
                            @foreach($categories as $key => $category)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->parent > 0 ? $category->parent_cat['name'] : 0 }}</td>
                                    <td>{{ $category->status ? "Active" : "Inactive" }}</td>
                                    <td>{{ date("d-m-Y",strtotime($category->created_at)) }}</td>
                                    <td><button type="button" data-id="{{$category->id}}" class="btn btn-primary edit_category"><i class="fas fa-edit"></i></button> <a href="{{ url('category/delete/'.$category->id) }}" data-id="{{$category->id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                            @endif
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Parent</th>
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
<div class="modal fade" id="addCategoryMaster" tabindex="-1" role="dialog" aria-labelledby="addModulesLabel" aria-hidden="true">
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
        {{ Form::open(array('url' => 'category/store','method' => 'post')) }}
        <input type="hidden" name="cat_id" id="cat_id">
        <div class="form-group">
            <label>Name</label>
            {{ Form::text('name', $value = null, $attributes = array('class' => 'form-control form-control-user', 'id' => 'catName', 'placeholder' => 'Enter Category Name')) }}
        </div>
        <div class="form-group">
            <label>Parent</label>
            {{ Form::select('parent',$parent_cats,$value = null, $attributes = array('class' => 'form-control form-control-user', 'id' => 'parentCat', 'placeholder' => 'Select Parent Category')) }}
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
        $(document).on("click",".edit_category",function(){
            cat_id = $(this).data('id');
            $.ajax({
               type:'POST',
               url:'category/edit',
               data:{'_token' : '<?php echo csrf_token() ?>','cat_id':cat_id},
               success:function(data) {
                    data = $.parseJSON(data);
                    if(data.status == 'success'){
                        $("#cat_id").val(data.cat_id);
                        $("#catName").val(data.name);
                        $("#parentCat").val(data.parent);
                        $("#addCategoryMaster").modal('show');   
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

        // DataTable
        $('#categoryTable').DataTable({
            processing: true,
            dom: 'Bfrtip',
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
        });
    });
</script>
@include("layouts.footer")