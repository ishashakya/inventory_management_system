@extends('admin.master')
@section('title','Category')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Category Table</h3>
                @include('admin.includes.flash_message')
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($categories) > 0 )
                        @foreach($categories as $key=>$category)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$category->name}}</td>
                                <td>@if($category->status == 1)
                                    Active
                                    @else
                                    In-Active
                                    @endif

                                </td>
                                {{-- <td>@if($category->show_in_menu == 1)
                                    Yes
                                    @else
                                    No
                                    @endif

                                </td> --}}
                                <td>
                                        <a href="{{route('admin.category.edit',$category->id)}}"><button class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </button></a>
                                        <a href="{{route('admin.category.delete',$category->id)}}" onclick="return confirm('Are you sure?')"><button class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button></a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">No Records Found..</td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                    {{-- <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Show In Menu</th>
                            <th>Action</th>
                        </tr> --}}
                    </tfoot>
                </table>
            </div>
        </div>
        </div>
    </div>
</section>

@endsection
