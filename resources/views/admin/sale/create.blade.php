@extends('admin.master')
@section('title', 'Sales')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Sales Table</h3>
                        @include('admin.includes.flash_message')
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <form role="form" method="POST" action="{{route('admin.sale.store')}}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label">Customer Name</label>
                                    <input type="text" class="form-control" name="customer_name" id="exampleForName"
                                    placeholder="Enter Customer Name" required/>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                    <input type="date" class="form-control" name="date" id="exampleForName" required />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Total Amount</label>
                                    <input type="number " class="form-control" name="total" id="exampleForName"
                                    placeholder="Enter Total Amount" required/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Credit Amount</label>
                                    <input type="number " class="form-control" name="credit" id="exampleForName"
                                    placeholder="Enter Credit Amount" required/>
                                </div>
                                {{-- DynamicAddRemove --}}
                                <table class="table table-bordered" id="dynamicAddRemove">
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Product</th>
                                        <th>Cost Price</th>
                                        <th>Quantity</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <select name="item[0][product_id]" class="form-control" id="product_0" onchange="loadData(this, 0)">
                                                <option value="" selected disabled>Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{$product->id}}">{{$product->title}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="item[0][cp]" class="form-control" id="cp_0" >
                                                <option value="" selected disabled>Select Cost Price</option>
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
                                <div class="col-md-3 col-md-offset-4">
                                    <a class="btn btn-danger" href="">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Submit</a>
                                </div>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
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
                        <select name="item[${i}][product_id]" class="form-control" id="product_${i}" onchange="loadData(this, ${i})">
                            <option value="" selected disabled>Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->title}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="item[${i}][cp]" class="form-control" id="cp_${i}">
                            <option value="" selected disabled>Select Cost Price</option>
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

        function loadData(element, sn) {
            let select_cp = document.getElementById(`cp_${sn}`);
            select_cp.innerHTML = '<option value="" selected disabled>Select Cost Price</option>'
            console.log(element.value, sn);
            $.ajax({
                type: 'GET',
                url: `/api/inventories/getdata/${element.value}`,
                data: '',
                success: function(data) {
                    console.log(data);
                    data.forEach(ele => {
                        let option = `<option value="${ele.price}">${ele.price}</option>`
                        select_cp.innerHTML += option;
                    });
                }
            });
        }
    </script>
@endpush
