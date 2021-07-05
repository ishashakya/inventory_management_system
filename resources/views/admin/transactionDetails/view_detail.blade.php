@extends('admin.master')
@section('title', 'Transaction Details')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3>Transaction Details</h3>
                        @include('admin.includes.flash_message')
                        <div id="msg"></div>
                    </div>
                    <div class="box-body">
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleForName">Merchant Name</label>
                                    <div>{{ $transactions->merchant_name }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleForName">Date</label>
                                    <div>{{ $transactions->date }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleForName">Total</label>
                                    <div>{{ $transactions->total }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleForName">Credit</label>
                                    <div>{{ $transactions->credit }}</div>
                                </div>

                        </form>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <h3>Details</h3>
                                </tr>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($transactions->transactiondetails) > 0)
                                    @foreach ($transactions->transactiondetails as $key => $details)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                @foreach ($products as $product)
                                                    {{$product->id==$details->product_id ? $product->title:''}}
                                                @endforeach
                                            </td>
                                            <td>{{ $details->quantity }}</td>
                                            <td>{{ $details->price }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#editDetailModal{{ $details->id }}">
                                                    Edit
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editDetailModal{{ $details->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">Edit Details
                                                                </h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="box-body">
                                                                    <form role="form"
                                                                        action="{{route('admin.transactionDetails.update_detail',$details)}}"
                                                                        method="post" enctype="multipart/form-data">
                                                                        @method('patch')
                                                                        @csrf
                                                                        <div class="box-body">
                                                                            <div class="form-group">
                                                                                <label for="exampleForName">Product</label>
                                                                                <select name="product_id" class="form-control" id="product">
                                                                                    <option value="" selected disabled>Select Product</option>
                                                                                    @foreach ($products as $product)
                                                                                        <option value="{{ $product->id }}" {{ $product->id == $details->product_id ? 'selected' : '' }}>
                                                                                            {{ $product->title }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleForName">Quantity</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="quantity" id="exampleForName"
                                                                                    placeholder="Enter Quantity"
                                                                                    value="{{$details->quantity}}"
                                                                                    required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleForName">Price</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="price" id="exampleForName"
                                                                                    placeholder="Enter Price"
                                                                                    value="{{$details->price}}"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save
                                                                                changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="{{route('admin.transactionDetails.destroy',$details)}}"
                                                onclick="return confirm('Are you sure you want to delete?');">
                                                <i class="fa fa-trash text-danger" title="Delete"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                @endif
                            </tbody>
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
@push('scripts')
    <script>
        function sliderChange(id, show) {
            console.log("yes");
            $.ajax({
                type: 'GET',
                url: '/blog/slider/change/' + id + '/' + show,
                data: '',
                success: function(data) {
                    $("#msg").append(
                        '<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>' +
                        data.success + '</strong></div>');
                }
            });
        }
    </script>
@endpush
