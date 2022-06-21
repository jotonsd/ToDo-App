@extends('layouts.app')
@section('title') Welcome to your home {{ config('app.name', 'Laravel') }} @stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex">
                        <b>{{ __('Your to do list') }}</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check">
                          <input class="form-check-input radio-btn" name="get_task" value="1" type="radio" id="get-task" checked>
                          <label class="form-check-label" for="get-task">
                            All
                          </label>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check">
                          <input class="form-check-input radio-btn" name="get_task" value="2" type="radio" id="get-task-2">
                          <label class="form-check-label" for="get-task-2">
                            Pinned
                          </label>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check">
                          <input class="form-check-input radio-btn" name="get_task" value="3" type="radio" id="get-task-3">
                          <label class="form-check-label" for="get-task-3">
                            Important
                          </label>
                        </div>
                        
                      </div>
                        <button class="btn-sm btn-primary" data-bs-toggle="modal" href="#task_modal" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Add new</button>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered text-center" id="table-data">
                      <thead class="table-success">
                        <tr>
                          <th width="5%" scope="col">#</th>
                          <th scope="col">Title</th>
                          <th width="20%" scope="col">Action</th>
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
<div class="modal fade" id="task_modal" aria-hidden="true" aria-labelledby="task_modalLabel" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" id="myform" autocomplete="off" novalidate>
        <div class="modal-header">
          <h5 class="modal-title" id="task_modalLabel">Add New Task</h5>
          <button type="button" class="btn-close" onclick="clear_all()" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-2">
              <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

              <div class="col-md-6">
                  <input id="title" type="text" name="title" class="form-control" placeholder="Enter task title" required>
              </div>
          </div>

          <div class="row mb-2">
              <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>

              <div class="col-md-6">                  
                  <select class="form-select" name="category_id" id="category_id" required>
                    <option value="">Select Category</option>
                  </select>
                  <input id="user_id" type="text" value="{{ Auth::id() }}" name="user_id" hidden>
                  <input id="id" type="text" value="0" hidden>
              </div>
          </div>

          <div class="row mb-2">
              <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
              <div class="col-md-6">
                <textarea class="form-control" id="description" name="description" placeholder="Enter task description" maxlength="300" rows="3"></textarea>
                <div id="the-count">
                  <span id="current">0</span>
                  <span id="maximum">/ 300</span>
                </div>
                  <div class="d-md-flex mt-2">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="is_important" value="1" id="is_important">
                      <label class="form-check-label" for="is_important">
                        Important
                      </label>
                    </div>  &nbsp;&nbsp;&nbsp;           
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="is_pinned" value="1" id="is_pinned">
                      <label class="form-check-label" for="is_pinned">
                        Pin Task
                      </label>
                    </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button id="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> <span id="btn-name">Save</span></button>
          <button class="btn btn-danger" onclick="clear_all()" data-bs-target="#task_modal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
        </div>      
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="view_task_modal" aria-hidden="true" aria-labelledby="task_modalLabel" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" id="myform" autocomplete="off" novalidate>
        <div class="modal-header">
          <h5 class="modal-title" id="view_task_modal_label">View Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="d-md-flex">
            <div id="v-important"></div>
            <div id="v-pinned"></div>            
          </div>
          <div class="row mt-2">
            <h6>Task category: <span class="badge bg-primary"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span id="v-category"></span> </span></h6>
            <h5>Title: <span id="v-title" class="text-primary"></span></h5>
            <h6>Description: <span id="v-description" class="text-primary"></span></h6>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" data-bs-target="#view_task_modal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
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
