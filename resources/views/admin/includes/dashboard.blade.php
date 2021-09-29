@extends('admin.master')
@section('title', 'Inventory Management | Dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        {{-- <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div> --}}
        <div class="row" style="margin-bottom: 10px">
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-info">
                    <div class="inner" style="height: 100px">
                        <h4><b>Top Selling Product</b></h4>

                        <div class="col-lg-4 col-6"><b>{{$sales_data}}</b></div>
                    </div>
                    {{-- Product Image --}}
                    <div class="icon" id="sale-image">
                        <i class="ion ion-bag"></i>
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <div class="col-1">

            </div>
            {{-- <div class="col-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h4><b>Profit</b></h4>
                        <div id="sales-report">
                            <div class="col-lg-3 col-4"><b>Jackets</b></div>
                            <div class="col-lg-3 col-4"><b>3000</b></div>
                            <div class="col-lg-3 col-4"><b>300</b></div>
                            <div class="col-lg-3 col-4"><b>15</b></div>
                        </div>

                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-info">
                    <div class="inner" style="height: 100px">
                        <h4><b>Top Selling Category</b></h4>
                        <div id="">
                            <div class="col-lg-6 col-6"><b>Category Name</b></div>
                            <div class="col-lg-6 col-4"><b>{{$category_data->name}}</b></div>
                            <div class="col-lg-6 col-6"><b>Sold Item</b></div>
                            <div class="col-lg-6 col-4"><b>{{$category_data->sum}}</b></div>
                        </div>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-info" style="padding-bottom: 10px">
                    <div class="inner">
                        <h4><b>Credit</b></h4>
                    </div>
                    <div id="creditReport">
                        <div class="col-lg-12 col-12">
                            <div class="col-sm-6">
                                <label for="exampleForName">Select Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="start_date_credit" placeholder="Enter Start Date"
                                    required>
                            </div>
                            <div class="col-xs-6">
                                <label for="exampleForName">Select End Date</label>
                                <input type="date" class="form-control" name="end_date" id="end_date_credit" placeholder="Enter End Date"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6"><b>Credit while Purchase</b></div>
                        <div class="col-lg-6 col-4"><b id="credit_Incoming"></b></div>
                        <div class="col-lg-6 col-6"><b>Credit while Sale</b></div>
                        <div class="col-lg-6 col-4"><b id="credit_Outgoing"></b></div>
                    </div>
                    <button onclick="creditReport()" type="submit" class="btn btn-primary" style="margin: 5px">Get Data</button>
                    {{-- <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div> --}}
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-info" style="padding-bottom: 10px">
                    <div class="inner">
                        <h4><b>Profit</b></h4>
                    </div>
                    <div id="">
                        <div class="col-lg-12 col-12">
                            <div class="col-sm-6">
                                <label for="exampleForName">Select Start Date</label>
                                <input type="date" class="form-control" name="date" id="start_date_profit" placeholder="Enter Date"
                                    required>
                            </div>
                            <div class="col-xs-6">
                                <label for="exampleForName">Select End Date</label>
                                <input type="date" class="form-control" name="date" id="end_date_profit" placeholder="Enter Date"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6"><b>Profit Amount</b></div>
                        <div class="col-lg-6 col-4"><b id="profit_amount"></b></div>
                        <button onclick="profitReport()" type="submit" class="btn btn-primary" style="margin: 5px">Get Data</button>

                        {{-- <div class="col-lg-4 col-6"><b>{{$data[0]->profit}}</b></div> --}}
                    </div>
                    {{-- <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div> --}}
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <script>
        function creditReport(){
        // console.log(document.getElementById('start_date_credit').value);
        start_date = document.getElementById('start_date_credit').value;
        end_date = document.getElementById('end_date_credit').value;
            $.ajax({
                type: 'GET',
                url: `/dashboard/creditreport/${start_date}/${end_date}`,
                data: '',
                success: function(data) {
                    console.log(data);
                    data.forEach(element => {
                        document.getElementById(`credit_${element.transaction_type}`).innerText = element.sum
                    });
                }
            });
        }

        function profitReport(){

            start_date = document.getElementById('start_date_profit').value;
            end_date = document.getElementById('end_date_profit').value;
            $.ajax({
                type: 'GET',
                url: `/dashboard/profitreport/${start_date}/${end_date}`,
                data: '',
                success: function(data) {
                    console.log(data);
                    document.getElementById(`profit_amount`).innerText = data[0].sum
                }
            });
        }
    </script>
@endsection
@push('scripts')
@endpush
