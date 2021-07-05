@extends('admin.master')
@section('title', 'Transaction')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Edit Transactions</h3>
                        @include('admin.includes.flash_message')
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" action="{{route('admin.transaction.update',$transaction)}}" method="post" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleForName">Merchant Name</label>
                                    <input type="text" class="form-control" name="merchant_name" id="exampleForName"
                                        placeholder="Enter Merchant Name" value="{{ $transaction->merchant_name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleForName">Date</label>
                                    <input type="date" class="form-control" name="date" id="exampleForName"
                                        placeholder="Enter Date" value="{{ $transaction->date }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleForName">Total</label>
                                    <input type="text" class="form-control" name="total" id="exampleForName"
                                        placeholder="Enter Total" value="{{ $transaction->total }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleForName">Credit</label>
                                    <input type="text" class="form-control" name="credit" id="exampleForName"
                                        placeholder="Enter Credit" value="{{ $transaction->credit }}" required>
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
