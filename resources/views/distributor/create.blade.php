<html>
  <head>
    <title>Using Select2</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  </head>
  <body>
    <div class="jumbotron">
      <div class="container bg-danger">
        <div class="col-md-6">
          <label>Multiple Select2</label>
          <select id="multiple" class="js-states form-control" multiple>
            {{-- {{gettype($all_dist)}} --}}
            @foreach ($all_dist as $item)
                <option value="{{$item->ds_id}}" @foreach ($selected_dealer_distributor as $selected_dist)
                    {{$selected_dist->ds_id == $item->ds_id ? 'selected': ''}}
                @endforeach>{{$item->name}}</option>   
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
      $("#multiple").select2({
          placeholder: "Select Distributor",
          allowClear: true
      });
    </script>
  </body>
</html>