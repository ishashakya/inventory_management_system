@extends('admin.master')
@section('title','Category')
@section('content')

<section class="content">
    {{-- <div class="container-fluid"> --}}
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Table</h3>
              @include('admin.includes.flash_message')
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- general form elements -->
            <form role="form" action="{{route('admin.category.update', $category->id)}}" method="post">
                @method('PATCH')

                @csrf
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Quick Example</h3>
                </div>
                <!-- /.card-header -->
                {{-- < !-- form start --> --}}

                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" name= "name" id="exampleInputEmail1" placeholder="Enter name" value="{{$category->name}}">
                    </div>
                    <div class="form-group">
                        <label class="exampleForStatus">Status</label>
                        <select name="status" id="exampleForStatus" value="{{$category->status}}">
                            <option value="1" {{($category->status==1)?'selected':''}}>Active</option>
                            <option value="0" {{($category->status==0)?'selected':''}}>IN Active</option>
                        </select>
                    </div>
                    </div>
                    </div>
                    </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->

            </div>
          </div>
        </div>
    {{-- </div> --}}

</section>
@endsection
