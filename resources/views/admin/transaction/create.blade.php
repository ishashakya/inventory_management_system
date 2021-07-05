@extends('admin.master')
@section('title', 'Transaction')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Create Transactions</h3>
                        @include('admin.includes.flash_message')
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" action="{{route('admin.transaction.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleForName">Merchant Name</label>
                                    <input type="text" class="form-control" name="merchant_name" id="exampleForName"
                                        placeholder="Enter Merchant Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleForName">Date</label>
                                    <input type="date" class="form-control" name="date" id="exampleForName"
                                        placeholder="Enter Date" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleForName">Total</label>
                                    <input type="number" class="form-control" name="total" id="exampleForName"
                                        placeholder="Enter total" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleForName">Credit</label>
                                    <input type="number" class="form-control" name="credit" id="exampleForName"
                                        placeholder="Enter Credit Amount" required>
                                </div>
                                {{-- DynamicAddRemove --}}
                                <table class="table table-bordered" id="dynamicAddRemove">
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <select name="item[0][product_id]" class="form-control" id="product">
                                                <option value="" selected disabled>Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{$product->id}}">{{$product->title}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="item[0][quantity]" placeholder="Enter Quantity" class="form-control" required/>
                                        </td>
                                        <td><input type="number" name="item[0][price]" placeholder="Enter Price" class="form-control" required/>
                                        </td>
                                        <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Transaction Details</button></td>
                                    </tr>
                                </table>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        CKEDITOR.replace('exampleForDescription');

    </script>
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append(
                `<tr>
                    <td>${i+1}</td>
                    <td>
                        <select name="item[${i}][product_id]" class="form-control" id="product">
                            <option value="" selected disabled>Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->title}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="item[${i}][quantity]" placeholder="Enter Quantity" class="form-control" />
                    </td>
                    <td><input type="number" name="item[${i}][price]" placeholder="Enter Price" class="form-control" />
                    </td>
                    <td><button type="button" class="btn btn-outline-primary remove-input-field">Delete</button></td>
                </tr>`
            );
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
@endpush
