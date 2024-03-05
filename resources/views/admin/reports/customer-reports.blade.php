@extends('admin.layout.admin_layout')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@stop
@section('page-title')
    <div class="page-title-container">
        <div class="row">
            <div class="col-12 col-sm-6">
                <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                    <ul class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="{!! url('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! url('/') !!}">Reports</a></li>
                        <li class="breadcrumb-item"><a href="#">Customer Reports</a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
@stop
@section('body')
    @php
        if(isset($filter)){
            $date = $filter['date_range'];
        }else{
            $date = "'".date('Y-m-d', strtotime('-30days'))." to ".date('Y-m-d', time())."'";
        }
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Filters</div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date Validation</label>
                                    <select class="form-control" name="date_validate">
                                        <option value="y" {!! isset($filter) ? ($filter['date_validate'] == "y" ? "selected" : "") : "" !!}>With Date</option>
                                        <option value="n" {!! isset($filter) ? ($filter['date_validate'] == "n" ? "selected" : "") : "" !!}>Without Date</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Order Date</label>
                                    <input type="text" name="date_range" value="{!! isset($filter) ? $filter['date_range'] : "" !!}" class="form-control date-range" required/>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Search By Customer </label>
                                    <input type="text" class="form-control" name="customer" placeholder="Enter Mobile Number.. " value="{!! isset($filter) ? $filter['customer'] : "" !!}" id="customer"/>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="text-center" style="margin-top: 10px;">
                                    <button type="submit" name="submit" value="view" class="btn btn-info">View</button>
                                    <button type="submit" name="submit" value="download" class="btn btn-warning">Download</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Customers Reports</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-border">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer Name</th>
                                            <th>Customer Mobile</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>DOB</th>
                                            <th>Order Count</th>
                                            <th>Status</th>
                                            <th>Join Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($data))
                                        @if(count($data) !=0)
                                            @foreach($data as $key=>$row)
                                                <tr>
                                                    <td>{!! $key+1 !!}.</td>
                                                    <td>{!! ucfirst($row->first_name.' '.$row->last_name) !!}</td>
                                                    <td>{!! $row->mobile !!}</td>
                                                    <td>{!! $row->email !!}</td>
                                                    <td>{!! ucfirst($row->gender) !!}</td>
                                                    <td>{!! $row->dob == "" ? date('F d, Y', strtotime($row->dob)) : "" !!}</td>
                                                    <td>{!! $row->count_orders !!}</td>
                                                    <td>{!! $row->is_active == "1" ? "Active" : "Non-Active" !!}</td>

                                                    <td>{!! $row->date_time != "" ? date('F d, Y', strtotime($row->date_time)) : "" !!}</td>


                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                    </tbody>
                                </table>
                                @if(isset($data))
                                    {!! $data->appends($filter)->links() !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@stop
@section('script-function')
    <script type="text/javascript">
        $(".date-range").flatpickr({
            mode: "range",
            dateFormat: "Y-m-d",

        });

        $(document).on("click", ".order_details", function(){
            var order_id = $(this).data("id");
            $.post('{!! url('admin/order/order-details') !!}', {"_token": "{!! csrf_token() !!}", 'where[order_id]' : order_id}, function(html){
                var obj = $.parseJSON(html);
                $("#order_detail_modal tbody").html(obj.div);
                $("#order_detail_modal").modal("show");
            })

        });
    </script>
@stop
