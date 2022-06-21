@extends('layouts.app')
@section('title') Welcome to your home {{ config('app.name', 'Laravel') }} @stop
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
                          <th scope="col">Title</th>
                          <th scope="col">Last</th>
                          <th scope="col">Handle</th>
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
          <h5 class="modal-title" id="exampleModalToggleLabel">Add New Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-2">
              <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Category Name') }}</label>

              <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name" placeholder="Enter category name..." autofocus required>
                  <input id="user_id" type="text" value="{{ Auth::id() }}" name="user_id" hidden>
                  <input id="id" type="text" value="0" hidden>
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
          <button id="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> <span id="btn-name">Save</span></button>
          <button class="btn btn-danger" onclick="clear_all()" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
        </div>      
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  var user_id = {!! Auth::id() !!};
</script>
<script src="{{ asset('js/app-js/home.js') }}"></script>
@endsection
