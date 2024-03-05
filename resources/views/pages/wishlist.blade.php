@extends('layout.home_master')
@section('body') 

<div class="inner-grid"></div>


  
    <div class="container">
        <div class="ourmethods">
            <h4>Wishlist</h4>


            <div class="wishlist-main-content section-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    <form action="#" class="cart-table">
                            <div class=" table-content table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="plantmore-product-thumbnail" width="20%"></th>
                                            <th class="cart-product-name" width="20%">Product</th>
                                            <th class="plantmore-product-price" width="20%">Unit Price</th>
                                            <th class="plantmore-product-stock-status" width="20%">Stock Status</th>
                                            <th class="plantmore-product-add-cart" width="15%">Add to cart</th>
                                            <th class="plantmore-product-remove" width="5%">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($wishlist))
                                        @foreach($wishlist as $row)
                                            @php
                                                $productData = null;
                                                $healthboxData= null;
                                                $price = null;
                                                if ( $row->prod_type == '1'){
                                                    $productData = \App\FunctionModel::getData('tbl_product', array('id' => $row->prod_id, 'is_active' => '1'), 'first');
                                                    $price = \App\FunctionModel::getData('tbl_product_price', array('is_active'=> '1', 'product_id'=>$row->prod_id), 'first', array('id'=>'desc'));
                                                }
                                                if ( $row->prod_type == '2'){
                                                    $healthboxData = \App\FunctionModel::getData('tbl_healthbox', array('id' => $row->prod_id, 'is_active' => '1'), 'first');
                                                }
                                             /*   echo 'pre';print_r($productData);
                                                echo 'pre';print_r($healthboxData);exit;*/
                                            @endphp
                                            @if ($row->prod_type == '1')
                                            <tr>
                                                <td class="plantmore-product-thumbnail"><a href="#"><img src="{!! asset($productData->product_image) !!}" alt="{!! ucfirst($productData->product_title) !!}"></a></td>
                                                <td class="plantmore-product-name"><a href="#">{!! ucfirst($productData->product_title) !!}</a></td>
                                                <td class="plantmore-product-price"><span class="amount"><i class="fa fa-inr" aria-hidden="true"></i>{!! number_format($price->selling_price, 2) !!} </span></td>
                                                <td class="plantmore-product-stock-status"><span class="in-stock">in stock</span></td>
                                                <td class="plantmore-product-add-cart"><a href="#" class="add-product" data-wishlist="{!! $row->id !!}"  data-id="{!! $row->prod_id !!}" data-size="{!! $price->size !!}" data-price="{!! $price->selling_price !!}">add to cart</a></td>
                                                <td class="plantmore-product-remove"><a href="javascript:void(0)" data-id="{!! $row->id !!}" class="text-danger remove"><i class="fa fa-2x fa-trash" aria-hidden="true"></i></a></td>
                                            </tr>
                                            @endif

                                            @if($row->prod_type == '2')
                                                <tr>
                                                    <td class="plantmore-product-thumbnail"><a href="#"><img src="{!! asset($healthboxData->product_image) !!}" alt="{!! ucfirst($healthboxData->product_title) !!}"></a></td>
                                                    <td class="plantmore-product-name"><a href="#">{!! ucfirst($healthboxData->product_title) !!}</a></td>
                                                    <td class="plantmore-product-price"><span class="amount"><i class="fa fa-inr" aria-hidden="true"></i> {!! number_format($healthboxData->selling_price, 2) !!}</span></td>
                                                    <td class="plantmore-product-stock-status"><span class="in-stock">in stock</span></td>
                                                    <td class="plantmore-product-add-cart"><a href="#" class="add-healthbox" data-wishlist="{!! $row->id !!}" data-id="{!! $row->prod_id !!}" data-size="Per-Pecs" data-price="{!! $healthboxData->selling_price !!}">add to cart</a></td>
                                                    <td class="plantmore-product-remove"><a  href="javascript:void(0)" data-id="{!! $row->id !!}" class="text-danger remove"><i class="fa fa-2x fa-trash" aria-hidden="true"></i></a></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if(count($wishlist) == 0)

                                        <tr>
                                            <td class="plantmore-product-name" colspan="6">
                                                <h4>Wishlist Cart is  Empty</h4>
                                            </td>
                                        </tr>

                                    @endif


                                        {{--<tr>
                                            <td class="plantmore-product-thumbnail"><a href="#"><img src="https://sonapureessentials.com/demo/assets/uploads/product-gallery/thumbnail_images/1695292677AjwainHoney-2.png" alt=""></a></td>
                                            <td class="plantmore-product-name"><a href="#">Ajwain Honey </a></td>
                                            <td class="plantmore-product-price"><span class="amount"><i class="fa fa-inr" aria-hidden="true"></i> 1,450.00</span></td>
                                            <td class="plantmore-product-stock-status"><span class="out-stock">out stock</span></td>
                                            <td class="plantmore-product-add-cart"><a href="#">add to cart</a></td>
                                            <td class="plantmore-product-remove"><a href="#" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                        </tr>--}}
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

       </div>
  </div>
@stop
@section('js')
<script>
    $(document).on("click", ".remove", function (){
        var id = $(this).data('id');
        $.post("{!! url('my-profile/remove-wishlist') !!}", {'id' : id, '_token': '{!! csrf_token() !!}'},function (html){
            var obj = $.parseJSON(html);$.alert(obj.msg);setTimeout(function(){window.location.reload(true);},2000);
        });
    });

    $(document).on("click", ".add-healthbox", function(){
        //console.log("hello");
        var price = $(this).data("price"), size = $(this).data("size"),  product_id = $(this).data("id");
        $.post("{!! url('cart/add-cart-healthbox') !!}", {'price' : price, 'size' : size, '_token': '{!! csrf_token() !!}', 'product_id': product_id, 'qty': 1}, function(html){
            var obj = $.parseJSON(html);
            //$.alert("Product added to Cart.");
            $("a#cart span").text(obj.count);
            $("#HelthboxModel").modal("hide");
        });
        var id = $(this).data('wishlist');
        $.post("{!! url('my-profile/remove-wishlist') !!}", {'id' : id, '_token': '{!! csrf_token() !!}'},function (html){
            var obj = $.parseJSON(html);$.alert(obj.msg);setTimeout(function(){window.location.reload(true);},2000);
        });
        location.reload();
    });

    $(document).on("click", ".add-product", function(){
        // console.log("hello");
        var price = $(this).data("price"), size = $(this).data("size"),  product_id = $(this).data("id");
        $.post("{!! url('cart/add-cart-product') !!}", {'price' : price, 'size' : size, '_token': '{!! csrf_token() !!}', 'product_id': product_id, 'qty': 1}, function(html){
            var obj = $.parseJSON(html);
            $("a#cart span").text(obj.count);
        });
        var id = $(this).data('wishlist');
        $.post("{!! url('my-profile/remove-wishlist') !!}", {'id' : id, '_token': '{!! csrf_token() !!}'},function (html){
            var obj = $.parseJSON(html);$.alert(obj.msg);setTimeout(function(){window.location.reload(true);},2000);
        });
        location.reload();
    });

</script>
    @stop
