@extends('admin.master')
@section('title','Category')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Create Category</h3>
                @include('admin.includes.flash_message')
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form role="form" action="{{route('admin.category.store')}}" method="post">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleForName">Name</label>
                  <input type="text" class="form-control"name="name"  id="exampleForName" placeholder="Enter Name">
                </div>
                <div class="form-group">
                  <label for="exampleForStatus" >Status</label>
                  <select name="status" class="form-control" id="exampleForStatus">
                      <option value="1">Active</option>
                      <option value="0">In-Active</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</section>
@endsection
