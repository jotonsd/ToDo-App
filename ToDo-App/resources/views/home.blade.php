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
                    <table class="table table-striped table-bordered text-center">
                      <thead class="table-success">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Title</th>
                          <th scope="col">Last</th>
                          <th scope="col">Handle</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                        </tr>
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
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Add New Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Show a second modal and hide this one with the button below.
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
        <button class="btn btn-danger" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
@endsection
