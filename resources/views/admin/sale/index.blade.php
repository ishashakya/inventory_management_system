@extends('admin.master')
@section('title', 'Transaction')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Sales Table</h3>
                        @include('admin.includes.flash_message')
                        <div id="msg"></div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Customer Name</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Credit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($sales) > 0)
                                    @foreach ($sales as $key => $sale)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{$sale->merchant_name}}</td>
                                            <td>{{$sale->date}}</td>
                                            <td>{{$sale->total}}</td>
                                            <td>{{$sale->credit}}</td>
                                            <td>
                                            <a class="mr-2" href="{{route('admin.saleDetails.sale_detail',$sale->id)}}"> <button class="btn btn-sm btn-primary mr-2">
                                                View Details</button></a>
                                            <a href="{{route('admin.sale.edit',$sale)}}"><i class="fa fa-edit" title="Edit"></i></a>
                                            <a href="{{route('admin.sale.destroy',$sale)}}"
                                                onclick="return confirm('Are you sure you want to delete?');">
                                                <i class="fa fa-trash text-danger" title="Delete"></i></a>
                                                {{-- <a href="{{route('admin.transaction.viewdetails')}}"></a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">No Records Found..</td>
                                    </tr>
                                @endif
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>
@endsection
