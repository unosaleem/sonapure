@extends('admin.layout.admin_layout')
@section('css')

@stop
@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Shipping Order Track</h4>


                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Order Management</a></li>

                        <li class="breadcrumb-item active">Shipping Order Track</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop
@section('body')
    <div class="row">
        @if($data['tracking_data']['track_status'] == 0)
            <div class="col-md-12">
                <p>{!! $data['tracking_data']['error'] !!}</p>
            </div>
        @else
            <div class="col-md-12">
                <div class="list-group col nested-list nested-sortable">
                    <div class="list-group-item nested-1">Item 1.1</div>
                    <div class="list-group-item nested-1">Item 1.2
                        <div class="list-group nested-list nested-sortable">
                            <div class="list-group-item nested-2">Item 2.1</div>
                            <div class="list-group-item nested-2">Item 2.2
                                <div class="list-group nested-list nested-sortable">
                                    <div class="list-group-item nested-3">Item 3.1</div>
                                    <div class="list-group-item nested-3">Item 3.2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item nested-1">Item 1.3
                        <div class="list-group nested-list nested-sortable">
                            <div class="list-group-item nested-2">Item 2.1</div>
                            <div class="list-group-item nested-2">Item 2.2</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@stop
