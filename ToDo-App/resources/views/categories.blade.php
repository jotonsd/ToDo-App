@extends('layouts.app')
@section('title') Category List {{ config('app.name', 'Laravel') }} @stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">{{ __('Your to do list') }}
                        <button class="btn-sm btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Add new</button>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered text-center" id="table-data">
                      <thead class="table-success">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" id="myform" autocomplete="off" novalidate>
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Add New Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-2">
              <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Category Name') }}</label>

              <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name" placeholder="Enter category name..." autofocus required>
                  <input id="user_id" type="text" value="{{ Auth::id() }}" name="user_id" hidden>
              </div>
          </div>

          <div class="row mb-2">
              <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

              <div class="col-md-6">
                  <select class="form-select" name="status" id="status" required>
                    <option value="">Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                  </select>
              </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button id="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
          <button class="btn btn-danger" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
        </div>      
      </form>
    </div>
  </div>
</div>
<script>
    $(function () {
      // get categories onload
        $.get("http://localhost:8000/api/get-categories", function(data){
          $(data).each(function(index) {
              if (data[index].status == 1) {
                status = "<button class='btn-sm btn-success'>Actived</button>";
              }else{                        
                status = "<button class='btn-sm btn-danger'>Deactived</button>";
              }
              html ="<tr>"+
                    "<td>"+(index+1)+"</td>"+
                    "<td>"+data[index].name+"</td>"+
                    "<td>"+status+"</td>"+
                    "<td><button data-id='"+data[index].id+"' class='btn-sm btn-primary edit-btn'>Edit</button></td>"+
                    "</tr>"
                $('#table-data tbody').append(html);
            });
        });

        // from validation
        let validatorServerSide = $('form#myform').jbvalidator({
            errorMessage: true,
            successClass: true,
        });

        //store categories
        $(document).on('submit', '#myform', function () {

            $.ajax({
                method: "POST",
                url: "http://localhost:8000/api/store-categories",         
                data: $(this).serialize(),
                success: function (response) {
                  if (response.success == true) { 
                    console.log(response.data); 
                    $('#table-data tbody').html('');
                    $(response.data.categories).each(function(index) {
                      if (response.data.categories[index].status == 1) {
                        status = "<button class='btn-sm btn-success'>Actived</button>";
                      }else{                        
                        status = "<button class='btn-sm btn-danger'>Deactived</button>";
                      }
                      html ="<tr>"+
                            "<td>"+(index+1)+"</td>"+
                            "<td>"+response.data.categories[index].name+"</td>"+
                            "<td>"+status+"</td>"+
                            "<td><button data-id='"+response.data.categories[index].id+"' class='btn-sm btn-primary edit-btn'>Edit</button></td>"+
                            "</tr>"
                        $('#table-data tbody').append(html);
                    });
                    // sucess alert                      
                    success('Category stored successfully!')
                    $('#exampleModalToggle').modal('toggle');
                    $('#myform')[0].reset();
                  }
                }
            })

            return false;
        });
    })
</script>
@endsection
