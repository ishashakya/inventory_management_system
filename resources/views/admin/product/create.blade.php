@extends('admin.master')
@section('title', 'Product')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Create Products</h3>
                        @include('admin.includes.flash_message')
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleForName">Title</label>
                                    <input type="text" class="form-control" name="title" id="exampleForName"
                                        placeholder="Enter Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleForName">Brand</label>
                                    <input type="text" class="form-control" name="brand" id="exampleForName"
                                        placeholder="Enter Brand" required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category_id" class="form-control" id="category">
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ForImage">Image</label>
                                    <input type="file" class="form-control" name="avatar" id="ForImage">
                                </div>
                                <div class="form-group">
                                    <label for="exampleForDescription">Description</label>
                                    <textarea name="description" class="form-control" id=""
                                        cols="30" rows="10"></textarea>
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
@push('scripts')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('exampleForDescription');

    </script>
@endpush
