<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
Use App\FunctionModel;
use App\ShopModel;
use Image;

class ShopController extends Controller
{

    public function storeImages($pic, $destinationPath, $width, $height){
        //$originalImage= $request->file('filename');
        $thumbnailImage = Image::make($pic);
        $thumbnailPath = $destinationPath . 'thumbnail_images/';
        $originalPath = $destinationPath;
        $file = time() . $pic->getClientOriginalName();
        $thumbnailImage->save($originalPath . $file);
        $thumbnailImage->resize($width, $height);
        $thumbnailImage->save($thumbnailPath . $file);
        return $file;
    }
    public function uploadImage(Request $request)
    {

        if ($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //Upload File
            $request->file('upload')->storeAs('uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/' . $filenametostore);
            $msg = 'Image successfully uploaded';
            $res = "<script>window.parent.CKEDITOR.tools.callFunction(" . $CKEditorFuncNum . "," . $url . "," . $msg . ")</script>";
            return response()->json(['data' => $res]);
            //$re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            //return response()->json([ 'fileName' => $filenametostore, 'uploaded' => false, 'url' => $url, ]);
            // Render HTML output

            //echo $re;
        }

    }



    public function get_single_data(Request $request){
        $post = $request->all();
        $where = array();
        if(isset($post['_id'])){
            $where['id'] = base64_decode($post['_id']);
            $where['is_active'] = 1;
        }

        $data = FunctionModel::getData('tbl_'.$post['tab'], $where, 'first');
        if($data !=""){
            return json_encode(array('code'=> 200, 'data'=> $data));
        }else{
            return json_encode(array('code'=> 400, 'msg'=> 'Data not found please try again'));
        }
    }

    /*=========================================================================*
                        HELTH BOX INSERT | UPDATE | VIEWS
    =========================================================================*/

    public function all_category(){
        if(Session::has('admin')){
            $data['nav'] = 'all-categories';
            $data['title'] = 'Shop Categories';
            $data['shop_category'] = FunctionModel::getData('tbl_category','', 'get');
            return view('admin.shop.shop-categories', $data);
        }else{
            return redirect('/dash');
        }
    }

    public function new_category(){
        if(Session::has('admin')){
            $data['nav'] = 'new-categories';
            $data['title'] = 'Shop New Categories';
            return view('admin.shop.new-shop-category', $data);
        }else{
            return redirect('/dash');
        }
    }

    public function post_new_category(Request $request){
        if(Session::has('admin')){
            $post = $request->all();
            //echo '<pre>'; print_r($post); exit;
            if($post['where']['id'] !=""){
                //update
                $data = array(
                    'category_title_eng'    => $post['category_title_eng'],
                    'category_url'          => $post['category_url'],
                    'product_url'           => $post['product_url'],
                );
                if ($request->hasFile('category_image')) {
                    $image = $request->file('category_image');
                    $path = "assets-admin/images/category/";
                    // $uploadImage = $this->storeImages($image, $path, 272, 450);
                    $uploadImage = $this->storeImages($image, $path, 272, 450);
                    $data['category_image'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                if ($request->hasFile('banner_images')) {
                    $image = $request->file('banner_images');
                    $path = "assets-admin/images/category/";
                    $uploadImage = $this->storeImages($image, $path, 1190, 258);
                    $data['banner_images'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                //$sql = FunctionModel::update_data('tbl_shop_categories',$post['where'], $data);
                $sql = FunctionModel::update_data('tbl_category',array('id'=> base64_decode($post['where']['id'])), $data);
                if($sql['code'] == 200){
                    Session::flash('success', $post['category_title_eng'].' Category update successful.');
                }else{
                    Session::flash('danger', $post['category_title_eng'].' already updated.');
                }
                return redirect($_SERVER['HTTP_REFERER']);
            }else{
                //insert
                $request->validate([
                    'category_title_eng'    => 'required',
                    'category_url'      => 'required|unique:tbl_category',
                    'category_image'      => 'mimes:jpeg,jpg,png,webp,gif|required|max:10000',
                ],[
                    'category_title_eng.required' => 'Category title is required',
                    'category_url.required' => 'Category Url is required',
                    'category_image.required' => 'Category Image is required in Webp',

                ]);
                $data = array(
                    'category_title_eng'    => $post['category_title_eng'],
                    'category_url'          => $post['category_url'],
                    'product_url'           => $post['product_url'],
                    'is_active'             => '1',
                    'date_time'             => date('Y-m-d', time()),
                );
                if ($request->hasFile('category_image')) {
                    $image = $request->file('category_image');
                    $path = "assets-admin/images/category/";
                    // $uploadImage = $this->storeImages($image, $path, 272, 450);
                    $uploadImage = $this->storeImages($image, $path, 272, 450);
                    $data['category_image'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                if ($request->hasFile('banner_images')) {
                    $image = $request->file('banner_images');
                    $path = "assets-admin/images/category/";
                    $uploadImage = $this->storeImages($image, $path, 1190, 258);
                    $data['banner_images'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                $sql = FunctionModel::insert_data('tbl_category', $data);
                if($sql['code'] == 200){
                    Session::flash('success', $post['category_title_eng'].' Category update successful.');
                }else{
                    Session::flash('danger', $post['category_title_eng'].' getting error.');
                }
                return redirect($_SERVER['HTTP_REFERER']);

            }
        }else{
            return redirect('/dash');
        }
    }

    public function update_category($category){
        if(Session::has('admin')){
            $data['nav'] = 'shop-categories';
            $data['title'] = 'Shop Update Categories';
            $data['category'] = FunctionModel::getData('tbl_category', array('id'=> base64_decode($category)), 'first');
            return view('admin.shop.new-shop-category', $data);
        }else{
            return redirect('/dash');
        }
    }

    /*=========================================================================*
                        HELTH BOX INSERT | UPDATE | VIEWS
    =========================================================================*/
    public function shop_healthbox(){
        if(Session::has('admin')){
            $data['nav'] = 'list-health-products';
            $data['title'] = 'Shop healthbox';
            $data['shop_product'] = FunctionModel::getData('tbl_healthbox', '','get');
            return view('admin.shop.shop-healthbox', $data);
        }else{
            return redirect('/dash');
        }
    }
    public function new_healthbox(){
        if(Session::has('admin')){
            $model = new ShopModel();
            $data['nav'] = 'new-health-product';
            $data['title'] = 'Shop New healthbox';
            $lastId = $model->getLastId('tbl_healthbox', 'id', '');
            if ($lastId == "") {
                $data['last_id'] = 1;
            } else {
                $data['last_id'] = $lastId->id + 1;
            }
            return view('admin.shop.new-shop-healthbox', $data);
        }else{
            return redirect('/dash');
        }
    }
    public function post_new_healthbox(Request $request){
        if(Session::has('admin')){
            $model = new ShopModel();
            $post = $request->all();
            //echo '<pre>'; print_r($post); exit;
            if($post['where']['id'] !=""){
                //update
                $data = array(
//                    'product_tag'         => $post['product_tag'],
                    'product_title'         => $post['product_title'],
//                    'product_hindi_title'   => $post['product_hindi_title'],
                    'product_url'           => $post['product_url'],
                    'sku_number'            => $post['sku_number'],
//                    'is_front'              => $post['is_front'],
                    'price'                 => $post['price'],
                    'selling_price'         => $post['selling_price'],
//                    'background_color'      => $post['background_color'],
//                    'font_color'            => $post['font_color'],
//                    'batch_no'              => $post['batch_no'],
                    'product_properties'    => $post['product_properties'],
//                    'features'              => $post['features'],
//                    'health_benefits'       => $post['health_benefits'],
//                    'nutritional_facts'     => $post['nutritional_facts'],
//                    'storage_instructions'  => $post['storage_instructions'],
//                    'our_story'             => $post['our_story'],
//                    'interesting_facts'     => $post['interesting_facts'],
//                    'about'                 => $post['about'],
                );
                if ($request->hasFile('product_image')) {
                    $image = $request->file('product_image');
                    $path = "assets/uploads/healthbox/";
                    // $uploadImage = $this->storeImages($image, $path, 204, 165);
                    $uploadImage = $this->storeImages($image, $path, 500, 400);
                    $data['product_image'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                if ($request->hasFile('product_banner_image')) {
                    $image = $request->file('product_banner_image');
                    $path = "assets/uploads/healthbox/banner/";
                    $uploadImage = $this->storeImages($image, $path, 1600, 664);
                    $data['product_banner_image'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                if ($request->hasFile('header_background_banner')) {
                    $image = $request->file('header_background_banner');
                    $path = "assets/uploads/healthbox/banner/";
                    $uploadImage = $this->storeImages($image, $path, 1903, 327);
                    $data['header_background_banner'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                $sql = FunctionModel::update_data('tbl_healthbox',array('id'=> base64_decode($post['where']['id'])), $data);
                if($sql['code'] == 200){
                    Session::flash('success', $post['product_title'].' Healthbox Product update successful.');
                }else{
                    Session::flash('danger', $post['product_title'].' already updated.');
                }
                return redirect($_SERVER['HTTP_REFERER']);
            }else{
                //insert
                $request->validate([

                    'product_title'    => 'required',
//                    'product_hindi_title'    => 'required',
                    'product_url'      => 'required|unique:tbl_healthbox,product_url,'.$post['where']['id'],
                    'product_image'      => 'mimes:jpeg,jpg,png,gif,webp|required|max:10000',
//                    'is_front'    => 'required',
                    'price'                 => 'required',
                    'selling_price'         => 'required',
                ],[
                    'product_title'    => 'Product eng name required',
//                    'product_hindi_title'    => 'Product hindi name required',
                    'product_url'      => 'Product url required',
                ]);
                $data = array(
//                    'product_tag'         => $post['product_tag'],
                    'product_title'         => $post['product_title'],
//                    'product_hindi_title'   => $post['product_hindi_title'],
                    'product_url'           => $post['product_url'],
                    'sku_number'            => $post['sku_number'],
//                    'is_front'              => $post['is_front'],
                    'price'                 => $post['price'],
                    'selling_price'         => $post['selling_price'],
//                    'background_color'      => $post['background_color'],
//                    'font_color'            => $post['font_color'],
//                    'batch_no'              => $post['batch_no'],
                    'product_properties'    => $post['product_properties'],
//                    'features'              => $post['features'],
//                    'health_benefits'       => $post['health_benefits'],
//                    'nutritional_facts'     => $post['nutritional_facts'],
//                    'storage_instructions'  => $post['storage_instructions'],
//                    'our_story'             => $post['our_story'],
//                    'interesting_facts'     => $post['interesting_facts'],
//                    'about'                 => $post['about'],
                    'is_active'             => '1',
                    'date_time'             => date('Y-m-d', time()),
                );
                if ($request->hasFile('product_image')) {
                    $image = $request->file('product_image');
                    $path = "assets/uploads/healthbox/";
                    $uploadImage = $this->storeImages($image, $path, 500, 400);
                    $data['product_image'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                if ($request->hasFile('product_banner_image')) {
                    $image = $request->file('product_banner_image');
                    $path = "assets/uploads/healthbox/banner/";
                    $uploadImage = $this->storeImages($image, $path, 1903, 790);
                    $data['product_banner_image'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                if ($request->hasFile('header_background_banner')) {
                    $image = $request->file('header_background_banner');
                    $path = "assets/uploads/healthbox/banner/";
                    $uploadImage = $this->storeImages($image, $path, 1903, 327);
                    $data['header_background_banner'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                $sql = FunctionModel::insert_data('tbl_healthbox', $data);
                if($sql['code'] == 200){
                    $product_id = $sql['last_id'];

                    if ($request->hasFile('gallery_pic')) {
                        foreach ($request->file('gallery_pic') as $key => $row) {
                            $image = $row;
                            $path = "assets/uploads/healthbox-gallery/";
                            // $image = $this->storeImages($image, $path, 1000, 667); //329*438
                            $image = $this->storeImages($image, $path, 500, 400); //329*438
                            $uploadImage = $path . 'thumbnail_images/' . $image;
                            $model->insert_data('tbl_healthbox_gallery', array('product_id' => $product_id, 'image_url' => $uploadImage, 'is_active' => '1', 'date_time' => date('Y-m-d', time())));
                        }
                    }

                    if ($request->hasFile('product_banner_image')) {
                        foreach ($request->file('product_banner_image') as $key => $row) {
                            $image = $row;
                            $path = "assets/uploads/healthbox-banner/";
                            // $image = $this->storeImages($image, $path, 1000, 667); //329*438
                            $image = $this->storeImages($image, $path, 1903, 790); //329*438
                            $uploadImage = $path . 'thumbnail_images/' . $image;
                            $model->insert_data('tbl_healthbox_banner', array('product_id' => $product_id, 'image_url' => $uploadImage, 'is_active' => '1', 'date_time' => date('Y-m-d', time())));
                        }
                    }
                    Session::flash('success', $post['product_title'].' Product update successful.');
                }else{
                    Session::flash('danger', $post['product_title'].' getting error.');
                }
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            return redirect('/dash');
        }
    }
    public function update_healthbox($product_id){
        if(Session::has('admin')){
            $data['nav'] = 'list-health-products';
            $data['title'] = 'Shop Update healthbox ';
            $data['product'] = FunctionModel::getData('tbl_healthbox', array('id'=> $product_id), 'first');
            return view('admin.shop.update-shop-healthbox', $data);
        }else{
            return redirect('/dash');
        }
    }

    //    product Gallery

    public function healthbox_gallery($product_id){
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Shop Update Healthbox Gallery";
            $data['nav'] = "list-health-products";
            $data['product_id'] = $product_id;
            $data['data'] = $model->getData('tbl_healthbox_gallery', array('product_id' => $product_id, 'is_active' => '1'), 'get', array('id' => 'Desc'));
            return view('admin.shop.healthbox_gallery', $data);

        } else {
            return redirect('/dash');
        }
    }

    public function post_healthbox_gallery(Request $request){
        if (Session::has('admin')) {
            $post = $request->all();
            //echo '<pre>'; print_r($post); exit;
            $model = new ShopModel();
            if ($request->hasFile('gallery_pic')) {
                foreach ($request->file('gallery_pic') as $key => $row) {
                    $image = $row;
                    $path = "assets/uploads/healthbox-gallery/";
                    // $image = $this->storeImages($image, $path, 1000, 667);
                    $image = $this->storeImages($image, $path, 390, 293);
                    $uploadImage = $path . 'thumbnail_images/' . $image;
                    $data = array('product_id' => $post['product_id'], 'image_url' => $uploadImage, 'is_active' => '1', 'date_time' => date('Y-m-d', time()));
                    $model->insert_data('tbl_healthbox_gallery', $data);
                }
            }
            Session::flash('success', 'Product Insert Successful.');
            return redirect($_SERVER['HTTP_REFERER']);

        } else {
            return redirect('/auth?url=' . $_SERVER['HTTP_REFERER']);
        }

    }
    /*=========================================================================*
                           PRODUCT INSERT | UPDATE | VIEWS
       =========================================================================*/

    public function healthbox_banner($product_id){
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Shop Update Healthbox Banner";
            $data['nav'] = "list-health-products";
            $data['product_id'] = $product_id;
            $data['data'] = $model->getData('tbl_healthbox_banner', array('product_id' => $product_id, 'is_active' => '1'), 'get', array('id' => 'Desc'));
            return view('admin.shop.healthbox_banner', $data);

        } else {
            return redirect('/dash');
        }
    }

    public function post_healthbox_banner(Request $request){
        if (Session::has('admin')) {
            $post = $request->all();
            //echo '<pre>'; print_r($post); exit;
            $model = new ShopModel();
            if ($request->hasFile('product_banner_image')) {
                foreach ($request->file('product_banner_image') as $key => $row) {
                    $image = $row;
                    $path = "assets/uploads/healthbox-banner/";
                    // $image = $this->storeImages($image, $path, 1000, 667);
                    $image = $this->storeImages($image, $path, 1903, 790);
                    $uploadImage = $path . 'thumbnail_images/' . $image;
                    $data = array('product_id' => $post['product_id'], 'image_url' => $uploadImage, 'is_active' => '1', 'date_time' => date('Y-m-d', time()));
                    $model->insert_data('tbl_healthbox_banner', $data);
                }
            }
            Session::flash('success', 'Product Insert Successful.');
            return redirect($_SERVER['HTTP_REFERER']);

        } else {
            return redirect('/auth?url=' . $_SERVER['HTTP_REFERER']);
        }

    }

    /*=========================================================================*
                              Healthbox faq INSERT | UPDATE | VIEWS
     =========================================================================*/

    public function healthbox_faq($product_id)
    {
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Shop Update Product Faq";
            $data['nav'] = "shop-product";
            $data['product_id'] = $product_id;
            $data['data'] = $model->getData('tbl_faq_healthbox', array('product_id' => $product_id, 'is_active' => '1'), 'get', array('id' => 'Desc'));
            return view('admin.faq.faq', $data);

        } else {
            return redirect('/dash');
        }
    }

    public function post_healthbox_faq(Request $request)
    {
        if (Session::has('admin')) {

            $post = $request->all();
            // echo '<pre>'; print_r($post);
            $product_id = $post['product_id'];
            $countPost= count($post['input']);
            for($i =0; $i <$countPost; $i++){
                $insert_data[$i]= array(
                    'product_id'      => $product_id,
                    'question'         => $post['input'][$i]['question'],
                    'answer'       => $post['input'][$i]['answer'],
                );
            }
            $insertSql = FunctionModel::insert_multi_data('tbl_faq_healthbox', $insert_data);
            if($insertSql['code'] == 200){
                Session::flash('success', 'Product Faq  Insert Successful.');
            }else{
                Session::flash('success', 'Getting error try again later.');
            }
            return redirect(url()->previous());
        } else {
            return redirect('/dash');
        }
    }

    /*=========================================================================*
                        PRODUCT INSERT | UPDATE | VIEWS
    =========================================================================*/
    public function shop_product(){
        if(Session::has('admin')){
            $data['nav'] = 'shop-product';
            $data['title'] = 'Shop Product';
            $data['shop_product'] = FunctionModel::getData('tbl_product', '','get',array('id'=>'desc'));
            $data['size'] = FunctionModel::getData('tbl_size', array('is_active'=>'1'),'get');
            return view('admin.shop.shop-product', $data);
        }else{
            return redirect('/dash');
        }
    }
    public function new_product(){
        if(Session::has('admin')){
            $model = new ShopModel();
            $data['nav'] = 'new-product';
            $data['title'] = 'Shop New product';
            $lastId = $model->getLastId('tbl_product', 'id', '');
            if ($lastId == "") {
                $data['last_id'] = 1;
            } else {
                $data['last_id'] = $lastId->id + 1;
            }
            $data['size'] = $model->getData('tbl_size', array('is_active'=>'1'), 'get');
            $data['category'] = $model->getData('tbl_category', array('is_active'=>'1'), 'get');
            return view('admin.shop.new-shop-product', $data);
        }else{
            return redirect('/dash');
        }
    }

    public function post_new_product(Request $request){
        if(Session::has('admin')){
            $model = new ShopModel();
            $post = $request->all();

            if($post['where']['id'] !=""){
                //update
                $data = array(
                    'product_tag'         => $post['product_tag'],
                    'category_id'         => $post['category_id'],
                    'product_title'         => $post['product_title'],
                    'product_hindi_title'   => $post['product_hindi_title'],
                    'product_url'           => $post['product_url'],
                    'sku_number'            => $post['sku_number'],
                    'is_front'              => $post['is_front'],
                    'background_color'      => $post['background_color'],
                    'font_color'            => $post['font_color'],
                    'batch_no'              => $post['batch_no'],
                    'product_properties'    => $post['product_properties'],
                    'features'              => $post['features'],
                    'health_benefits'       => $post['health_benefits'],
                    'nutritional_facts'     => $post['nutritional_facts'],
                    'storage_instructions'  => $post['storage_instructions'],
                    'our_story'             => $post['our_story'],
                    'interesting_facts'     => $post['interesting_facts'],
                    'about'                 => $post['about'],
                );
                if ($request->hasFile('product_image')) {
                    $image = $request->file('product_image');
                    $path = "assets/uploads/product/";
                    // $uploadImage = $this->storeImages($image, $path, 204, 165);
                    $uploadImage = $this->storeImages($image, $path, 500, 400);
                    $data['product_image'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                if ($request->hasFile('product_banner_image')) {
                    $image = $request->file('product_banner_image');
                    $path = "assets/uploads/product/banner/";
                    $uploadImage = $this->storeImages($image, $path, 1600, 576);
                    $data['product_banner_image'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                if ($request->hasFile('header_background_banner')) {
                    $image = $request->file('header_background_banner');
                    $path = "assets/uploads/healthbox/banner/";
                    $uploadImage = $this->storeImages($image, $path, 1903, 327);
                    $data['header_background_banner'] = $path . 'thumbnail_images/' . $uploadImage;
                }

                $sql = FunctionModel::update_data('tbl_product',array('id'=> base64_decode($post['where']['id'])), $data);
                if($sql['code'] == 200){
                    Session::flash('success', $post['product_title'].' Product update successful.');
                }else{
                    Session::flash('danger', $post['product_title'].' already updated.');
                }
                return redirect($_SERVER['HTTP_REFERER']);
            }else{
                //insert

                $request->validate([

                    'category_id'    => 'required',
                    'product_tag'    => 'required',
                    'product_title'    => 'required',
                    'product_hindi_title'    => 'required',
                    'product_url'      => 'required|unique:tbl_product,product_url,'.$post['where']['id'],
                    'product_image'      => 'mimes:jpeg,jpg,png,webp,gif|required|max:10000',
                    'product_banner_image'      => 'mimes:jpeg,jpg,webp,png,gif|required|max:10000',
                    'is_front'    => 'required',
                    'product_properties'    => 'required',
                    'sku_number'    => 'required',
                ],[
                    'category_id'    => 'Select Category Required',
                    'product_title'    => 'Product English Name Required',
                    'product_hindi_title'    => 'Product Hindi Name Required',
                    'product_url'      => 'Product url required',
                ]);
                $data = array(
                    'category_id'         => $post['category_id'],
                    'product_tag'         => $post['product_tag'],
                    'product_title'         => $post['product_title'],
                    'product_hindi_title'   => $post['product_hindi_title'],
                    'product_url'           => $post['product_url'],
                    'sku_number'            => $post['sku_number'],
                    'is_front'              => $post['is_front'],
                    'background_color'      => $post['background_color'],
                    'font_color'            => $post['font_color'],
                    'batch_no'              => $post['batch_no'],
                    'product_properties'    => $post['product_properties'],
                    'features'              => $post['features'],
                    'health_benefits'       => $post['health_benefits'],
                    'nutritional_facts'     => $post['nutritional_facts'],
                    'storage_instructions'  => $post['storage_instructions'],
                    'our_story'             => $post['our_story'],
                    'interesting_facts'     => $post['interesting_facts'],
                    'about'                 => $post['about'],
                    'is_active'             => '1',
                    'date_time'             => date('Y-m-d', time()),
                );

                if ($request->hasFile('product_image')) {
                    $image = $request->file('product_image');
                    $path = "assets/uploads/product/";
                    $uploadImage = $this->storeImages($image, $path, 500, 400);
                    $data['product_image'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                if ($request->hasFile('product_banner_image')) {
                    $image = $request->file('product_banner_image');
                    $path = "assets/uploads/product/banner/";
                    $uploadImage = $this->storeImages($image, $path, 1600, 576);
                    $data['product_banner_image'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                if ($request->hasFile('header_background_banner')) {
                    $image = $request->file('header_background_banner');
                    $path = "assets/uploads/healthbox/banner/";
                    $uploadImage = $this->storeImages($image, $path, 1903, 327);
                    $data['header_background_banner'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                //echo '<pre>'; print_r($data); exit;
                $sql = FunctionModel::insert_data('tbl_product', $data);
                if($sql['code'] == 200){
                    $product_id = $sql['last_id'];
                    if(count($post['product_price']) !=0){
                        foreach ($post['product_price'] as $row){
                            $data_price = array(
                                'product_id' => $product_id,
                                'size' => $row['size'],
                                'price' => $row['price'],
                                'selling_price' => $row['selling_price'],
                                'is_active' => '1',
                                'date_time' => date('Y-m-d', time()),
                            );
                            $model->insert_data('tbl_product_price', $data_price);
                        }
                    }
                    if ($request->hasFile('gallery_pic')) {
                        foreach ($request->file('gallery_pic') as $key => $row) {
                            $image = $row;
                            $path = "assets/uploads/product-gallery/";
                            // $image = $this->storeImages($image, $path, 1000, 667); //329*438
                            $image = $this->storeImages($image, $path, 500, 400); //329*438
                            $uploadImage = $path . 'thumbnail_images/' . $image;
                            $model->insert_data('tbl_product_gallery', array('product_id' => $product_id, 'image_url' => $uploadImage, 'is_active' => '1', 'date_time' => date('Y-m-d', time())));
                        }
                    }
                    Session::flash('success', $post['product_title'].' Product update successful.');
                }else{
                    Session::flash('danger', $post['product_title'].' getting error.');
                }
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            return redirect('/dash');
        }
    }

    public function add_product_price(Request $request){
        if(Session::has('admin')){
            $post = $request->all();
            $check_product = FunctionModel::getData('tbl_product_price', array('size'=> $post['size'],'product_id'=> $post['product_id'], 'is_active'=>'1'), 'first');
            if($check_product ==""){
                $data = array(
                    'product_id'    => $post['product_id'],
                    'size'          => $post['size'],
                    'price'         => $post['price'],
                    'selling_price' => $post['selling_price'],
                    'is_active'     => '1',
                    'date_time'     => date('Y-m-d', time()),
                );
                $return = FunctionModel::insert_data('tbl_product_price', $data);
                if($return['code'] == 200){
                    return json_encode(array('code'=> 200, 'msg'=> 'product price added successful.'));
                }else{
                    return json_encode(array('code'=> 400, 'msg'=> 'product price added getting error try again.'));
                }
            }else{
                return json_encode(array('code'=> 414, 'msg'=> 'product price size already exits.'));
            }
        }else{
            return json_encode(array('code'=> 404, 'msg'=> 'try again'));
        }
    }

    public function update_product($product_id){
        if(Session::has('admin')){
            $data['nav'] = 'shop-product';
            $data['title'] = 'Shop Update Product';
            $data['product'] = FunctionModel::getData('tbl_product', array('id'=> $product_id), 'first');
            $data['category'] = FunctionModel::getData('tbl_category', array('is_active'=>'1'), 'get');
            return view('admin.shop.update-shop-product', $data);
        }else{
            return redirect('/dash');
        }
    }

//    product Gallery

    public function product_gallery($product_id)
    {
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Shop Update Product Gallery";
            $data['nav'] = "shop-product";
            $data['product_id'] = $product_id;
            $data['data'] = $model->getData('tbl_product_gallery', array('product_id' => $product_id, 'is_active' => '1'), 'get', array('id' => 'Desc'));
            return view('admin.shop.product_gallery', $data);

        } else {
            return redirect('/dash');
        }
    }

    public function product_faq($product_id)
    {
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Shop Update Product Faq";
            $data['nav'] = "shop-product";
            $data['product_id'] = $product_id;
            $data['data'] = $model->getData('tbl_faq', array('product_id' => $product_id, 'is_active' => '1'), 'get', array('id' => 'Desc'));
            return view('admin.faq.faq', $data);

        } else {
            return redirect('/dash');
        }
    }

    public function post_product_faq(Request $request)
    {
        if (Session::has('admin')) {

            $post = $request->all();
           // echo '<pre>'; print_r($post);
            $product_id = $post['product_id'];
            $countPost= count($post['input']);
            for($i =0; $i <$countPost; $i++){
                $insert_data[$i]= array(
                    'product_id'      => $product_id,
                    'question'         => $post['input'][$i]['question'],
                    'answer'       => $post['input'][$i]['answer'],
                );
            }
            $insertSql = FunctionModel::insert_multi_data('tbl_faq', $insert_data);
            if($insertSql['code'] == 200){
                Session::flash('success', 'Product Faq  Insert Successful.');
            }else{
                Session::flash('success', 'Getting error try again later.');
            }
            return redirect(url()->previous());
        } else {
            return redirect('/dash');
        }
    }

    public function product_banners($product_id){
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Shop Update Product Gallery";
            $data['nav'] = "shop-product";
            $data['product_id'] = $product_id;
            $data['data'] = $model->getData('tbl_product_banners', array('product_id' => $product_id, 'is_active' => '1'), 'get', array('id' => 'Desc'));
            return view('admin.shop.product_banners', $data);

        } else {
            return redirect('/dash');
        }
    }



    public function post_product_gallery(Request $request){
        if (Session::has('admin')) {
            $post = $request->all();
            //echo '<pre>'; print_r($post); exit;
            $model = new ShopModel();
            if ($request->hasFile('gallery_pic')) {
                foreach ($request->file('gallery_pic') as $key => $row) {
                    $image = $row;
                    $path = "assets/uploads/product-gallery/";
                    // $image = $this->storeImages($image, $path, 1000, 667);
                    $image = $this->storeImages($image, $path, 500, 400);
                    $uploadImage = $path . 'thumbnail_images/' . $image;
                    $data = array('product_id' => $post['product_id'], 'image_url' => $uploadImage, 'is_active' => '1', 'date_time' => date('Y-m-d', time()));
                    $model->insert_data('tbl_product_gallery', $data);
                }
            }
            Session::flash('success', 'Product Insert Successful.');
            return redirect($_SERVER['HTTP_REFERER']);

        } else {
            return redirect('/auth?url=' . $_SERVER['HTTP_REFERER']);
        }

    }

    public function post_product_banners(Request $request){
        if (Session::has('admin')) {
            $post = $request->all();
            //echo '<pre>'; print_r($post); exit;
            $model = new ShopModel();
            if ($request->hasFile('gallery_pic')) {
                foreach ($request->file('gallery_pic') as $key => $row) {
                    $image = $row;
                    $path = "assets/uploads/product-gallery/";
                    // $image = $this->storeImages($image, $path, 1000, 667);
                    $image = $this->storeImages($image, $path, 1600, 500);
                    $uploadImage = $path . 'thumbnail_images/' . $image;
                    $data = array('product_id' => $post['product_id'], 'image_url' => $uploadImage, 'is_active' => '1', 'date_time' => date('Y-m-d', time()));
                    $model->insert_data('tbl_product_banners', $data);
                }
            }
            Session::flash('success', 'Product Insert Successful.');
            return redirect($_SERVER['HTTP_REFERER']);

        } else {
            return redirect('/auth?url=' . $_SERVER['HTTP_REFERER']);
        }

    }

    /*++++++++++++++++++++++=========================++++++++++++++++++++++++++++++++++++
                                    END PRODUCT WORKS
    ++++++++++++++++++++++++=========================+++++++++++++++++++++++++++++++++++*/

    public function shop_combo_product(){
        if(Session::has('admin')){
            $data['nav'] = 'shop-combo';
            $data['title'] = 'Shop Combo';
            $data['shop_combo_product'] = FunctionModel::getData('tbl_combo', '','get');
            return view('admin.shop.shop-combo', $data);
        }else{
            return redirect('/dash');
        }
    }
    public function new_combo_product(){
        if(Session::has('admin')){
            $model = new ShopModel();
            $data['nav'] = 'new-combo';
            $data['title'] = 'Shop New combo';
            $lastId = $model->getLastId('tbl_combo', 'id', '');
            if ($lastId == "") {
                $data['last_id'] = 1;
            } else {
                $data['last_id'] = $lastId->id + 1;
            }
            return view('admin.shop.new-shop-combo', $data);
        }else{
            return redirect('/dash');
        }
    }

    public function post_new_combo_product(Request $request){
        if(Session::has('admin')){
            $model = new ShopModel();
            $post = $request->all();
            //echo '<pre>'; print_r($post); exit;
            if($post['where']['id'] !=""){
                //update
                $data = array(
                    'product_tag'         => $post['product_tag'],
                    'product_title'         => $post['product_title'],
                    'product_hindi_title'   => $post['product_hindi_title'],
                    'product_url'           => $post['product_url'],
                    'price'           => $post['price'],
                    'selling_price'           => $post['selling_price'],
                    'background_color'      => $post['background_color'],
                    'font_color'            => $post['font_color'],
                    'batch_no'              => $post['batch_no'],
                    'is_front'              => $post['is_front'],
                    'product_properties'    => $post['product_properties'],
                    'interesting_facts'     => $post['interesting_facts'],
                    'storage_instructions'  => $post['storage_instructions'],
                    'health_benefits'       => $post['health_benefits'],
                );
                if ($request->hasFile('product_image')) {
                    $image = $request->file('product_image');
                    $path = "assets/uploads/combo/";
                    $uploadImage = $this->storeImages($image, $path, 390, 293);
                    $data['product_image'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                if ($request->hasFile('product_banner_image')) {
                    $image = $request->file('product_banner_image');
                    $path = "assets/uploads/combo/banner/";
                    $uploadImage = $this->storeImages($image, $path, 1600, 576);
                    $data['product_banner_image'] = $path . 'thumbnail_images/' . $uploadImage;
                }

                $sql = FunctionModel::update_data('tbl_combo',array('id'=> base64_decode($post['where']['id'])), $data);
                if($sql['code'] == 200){
                    Session::flash('success', $post['product_title'].' Product update successful.');
                }else{
                    Session::flash('danger', $post['product_title'].' already updated.');
                }
                return redirect($_SERVER['HTTP_REFERER']);
            }else{
                //insert
                $request->validate([
                    'product_title'    => 'required',
                    'product_url'      => 'required|unique:tbl_product,product_url,'.$post['where']['id'],
                    'price'    => 'required',
                    'selling_price'    => 'required',
                    'product_image'      => 'mimes:jpeg,jpg,png,gif|required|max:10000',

                ],[
                    'product_title'    => 'Product eng name required',
                    'price'    => 'Product Price required',
                    'selling_price'    => 'Product Selling Price required',
                    'product_url'      => 'Product url required',
                    'product_image' => 'Product image  use max 500 KB'
                ]);
                $data = array(
                    'product_tag'         => $post['product_tag'],
                    'product_title'         => $post['product_title'],
                    'product_hindi_title'   => $post['product_hindi_title'],
                    'product_url'           => $post['product_url'],
                    'price'           => $post['price'],
                    'selling_price'           => $post['selling_price'],
                    'background_color'      => $post['background_color'],
                    'font_color'            => $post['font_color'],
                    'batch_no'              => $post['batch_no'],
                    'is_front'              => $post['is_front'],
                    'product_properties'    => $post['product_properties'],
                    'interesting_facts'     => $post['interesting_facts'],
                    'storage_instructions'  => $post['storage_instructions'],
                    'health_benefits'       => $post['health_benefits'],
                    'sku_number'            => $post['sku_number'],
                    'is_active'             => '1',
                    'date_time'             => date('Y-m-d', time()),
                );
                if ($request->hasFile('product_image')) {
                    $image = $request->file('product_image');
                    $path = "assets/uploads/combo/";
                    $uploadImage = $this->storeImages($image, $path, 400, 400);
                    $data['product_image'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                if ($request->hasFile('product_banner_image')) {
                    $image = $request->file('product_banner_image');
                    $path = "assets/uploads/combo/banner/";
                    $uploadImage = $this->storeImages($image, $path, 1600, 576);
                    $data['product_banner_image'] = $path . 'thumbnail_images/' . $uploadImage;
                }
                $sql = FunctionModel::insert_data('tbl_combo', $data);
                if($sql['code'] == 200){
                    Session::flash('success', $post['product_title'].' Product update successful.');
                }else{
                    Session::flash('danger', $post['product_title'].' getting error.');
                }
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            return redirect('/dash');
        }
    }
    public function update_combo_product($product_id){
        if(Session::has('admin')){
            $data['nav'] = 'shop-combo';
            $data['title'] = 'Shop Combo Product';
            $data['product'] = FunctionModel::getData('tbl_combo', array('id'=> $product_id), 'first');
            return view('admin.shop.update-shop-product', $data);
        }else{
            return redirect('/dash');
        }
    }
    /*=========================================================================*
                          Combop  PRODUCT INSERT | UPDATE | VIEWS
       =========================================================================*/




    // start slider ======================================================================================

    public function new_slider()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "new-slider";
            $data['shop_slider'] = $model->getData('tbl_slider', array('is_active' => '1'), 'paginate', array('id' => 'Desc'));
            return view('admin.shop.new-shop-slider', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function post_new_slider(Request $request){
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $post = $request->all();
            $data = array(
                'slider_title' => $post['input']['slider_title'],
                'is_active' => '1',
                'date_time' => date('Y-m-d', time())
            );
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $path = "assets/uploads/slider/";
                $uploadImage = $this->storeImages($image, $path, 1900, 1100);
                $data['slider_image'] = $path . 'thumbnail_images/' . $uploadImage;
            }

            if ($post['where']['id'] == "") {
                $sql = $model->insert_data('tbl_slider',  $data);
                if ($sql['code'] == 200) {
                    Session::flash('success', ' New slider added successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            } else {
                //update
                $sql = $model->update_data('tbl_slider', array('id'=> base64_decode($post['where']['id'])), $post['input']);
                if ($sql['code'] == 200) {
                    Session::flash('success', 'Update Slider Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            }
            return redirect($_SERVER['HTTP_REFERER']);


        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function shop_slider()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "shop-slider";
            $data['shop_slider'] = $model->getData('tbl_slider', array('is_active' => '1'), 'paginate', array('id' => 'Desc'));

            return view('admin.shop.shop-slider', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function update_slider($slider)
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "new-slider";
            $data['slider'] = FunctionModel::getData('tbl_slider', array('id'=> base64_decode($slider)), 'first', array('id' => 'Desc'));

            return view('admin.shop.new-shop-slider', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    // end slider ======================================================================================



    // start banner ======================================================================================
    public function new_banner()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "new-banner";
            return view('admin.shop.new-shop-banner', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function post_new_banner(Request $request)
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $post = $request->all();
            if ($request->hasFile('banner_url')) {
                $image = $request->file('banner_url');
                $path = "assets/uploads/banner/";
//                $uploadImage = $this->storeImages($image, $path, 1140, 304);
                $uploadImage = $this->storeImages($image, $path, 1903, 414);
                $post['input']['banner_url'] = $path . 'thumbnail_images/' . $uploadImage;
            }

//                $post['input']['start_date'] = date('Y-m-d', strtotime($post['input']['start_date']));
//                $post['input']['end_date'] = date('Y-m-d', strtotime($post['input']['end_date']));
            if ($post['where']['id'] == "") {
                //insert
//                $check = $model->getData('tbl_slider', array(), 'first');
                $sql = $model->insert_data('tbl_banner', array_merge($post['input'], array('is_active' => '1', 'date_time' => date('Y-m-d', time()))));
                if ($sql['code'] == 200) {
                    Session::flash('success', $post['input']['banner_title'].'  banner Insert Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            } else {
                //update
                $sql = FunctionModel::update_data('tbl_banner', array('id'=> base64_decode($post['where']['id'])), $post['input']);
                if ($sql['code'] == 200) {
                    Session::flash('success', 'Update banner Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            }
            return redirect($_SERVER['HTTP_REFERER']);


        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function shop_banner()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "shop-banner";
            $data['shop_banner'] = $model->getData('tbl_banner', array('is_active' => '1'), 'paginate', array('id' => 'Desc'));

            return view('admin.shop.shop-banner', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function update_banner($banner)
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "new-banner";
            $data['banner'] = FunctionModel::getData('tbl_banner', array('id'=> base64_decode($banner)), 'first', array('id' => 'Desc'));

            return view('admin.shop.new-shop-banner', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    // stop banner ======================================================================================


    // start Event ======================================================================================
    public function new_event()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "new-event";
            return view('admin.shop.new-shop-event', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function post_new_event(Request $request)
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $post = $request->all();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = "assets/uploads/event/";
//                $uploadImage = $this->storeImages($image, $path, 1140, 304);
                $uploadImage = $this->storeImages($image, $path, 1080, 1080);
                $post['input']['image'] = $path . 'thumbnail_images/' . $uploadImage;
            }
            if ($request->hasFile('banner_image')) {
                $image = $request->file('banner_image');
                $path = "assets/uploads/event/";
//                $uploadImage = $this->storeImages($image, $path, 1140, 304);
                $uploadImage = $this->storeImages($image, $path, 1903, 327);
                $post['input']['banner_image'] = $path . 'thumbnail_images/' . $uploadImage;
            }

//                $post['input']['start_date'] = date('Y-m-d', strtotime($post['input']['start_date']));
//                $post['input']['end_date'] = date('Y-m-d', strtotime($post['input']['end_date']));
            if ($post['where']['id'] == "") {
                //insert
//                $check = $model->getData('tbl_slider', array(), 'first');
                $sql = $model->insert_data('tbl_event', array_merge($post['input'], array('is_active' => '1', 'date_time' => date('Y-m-d', time()))));
                if ($sql['code'] == 200) {
                    Session::flash('success', $post['input']['title'].'  Event Insert Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            } else {
                //update
                $sql = FunctionModel::update_data('tbl_event', array('id'=> base64_decode($post['where']['id'])), $post['input']);
                if ($sql['code'] == 200) {
                    Session::flash('success', 'Update event Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            }
            return redirect($_SERVER['HTTP_REFERER']);


        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function shop_event()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "shop-event";
            $data['shop_event'] = $model->getData('tbl_event', array('is_active' => '1'), 'paginate', array('id' => 'Desc'));

            return view('admin.shop.shop-event', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function update_event($event)
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "new-event";
            $data['event'] = FunctionModel::getData('tbl_event', array('id'=> base64_decode($event)), 'first', array('id' => 'Desc'));

            return view('admin.shop.new-shop-event', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    // Stop Event ======================================================================================

    public function event_gallery($event_id)
    {
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Shop Update Product Gallery";
            $data['nav'] = "event";
            $data['event_id'] = $event_id;
            $data['data'] = $model->getData('tbl_event_media', array('event_id' => $event_id, 'is_active' => '1'), 'get', array('id' => 'Desc'));
            return view('admin.shop.event-gallery', $data);

        } else {
            return redirect('/dash');
        }
    }

    public function post_event_gallery(Request $request){
        if (Session::has('admin')) {
            $post = $request->all();
            //echo '<pre>'; print_r($post); exit;
            $model = new ShopModel();
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $key => $row) {
                    $image = $row;
                    $path = "assets/uploads/event/event-gallery/";
                    // $image = $this->storeImages($image, $path, 1000, 667);
                    $image = $this->storeImages($image, $path, 1080, 1080);
                    $uploadImage = $path . 'thumbnail_images/' . $image;
                    $data = array('event_id' => $post['event_id'], 'image' => $uploadImage, 'is_active' => '1', 'date_time' => date('Y-m-d', time()));
                    $model->insert_data('tbl_event_media', $data);
                }
            }
            Session::flash('success', 'Gallery Insert Successful.');
            return redirect($_SERVER['HTTP_REFERER']);

        } else {
            return redirect('/auth?url=' . $_SERVER['HTTP_REFERER']);
        }

    }

    // start banner ======================================================================================
    public function new_brand()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "new-brand";
            return view('admin.shop.new-shop-brand', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function post_new_brand(Request $request)
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $post = $request->all();
            if ($request->hasFile('brand_image')) {
                $image = $request->file('brand_image');
                $path = "assets/uploads/brand/";
                $uploadImage = $this->storeImages($image, $path, 257, 160);
                $post['input']['brand_image'] = $path . 'thumbnail_images/' . $uploadImage;
            }
            if ($post['where']['id'] == "") {
                //insert
                $sql = $model->insert_data('tbl_brand', array_merge($post['input'], array('is_active' => '1', 'date_time' => date('Y-m-d', time()))));
                if ($sql['code'] == 200) {
                    Session::flash('success', $post['input']['brand_title'].'  brand Insert Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            } else {
                //update
                $sql = FunctionModel::update_data('tbl_brand', array('id'=> base64_decode($post['where']['id'])), $post['input']);
                if ($sql['code'] == 200) {
                    Session::flash('success', 'Update brand Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            }
            return redirect($_SERVER['HTTP_REFERER']);


        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function shop_brand()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "shop-brand";
            $data['shop_brand'] = $model->getData('tbl_brand', array('is_active' => '1'), 'paginate', array('id' => 'Desc'));

            return view('admin.shop.shop-brand', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function update_brand($brand)
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "new-brand";
            $data['brand'] = FunctionModel::getData('tbl_brand', array('id'=> base64_decode($brand)), 'first', array('id' => 'Desc'));

            return view('admin.shop.new-shop-brand', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    // stop banner ======================================================================================

    public function all_home_about(){
        $url = url()->current();
        if(Session::has('admin')){
            $model = new ShopModel();
            $data['title'] = "WebRozz Photography Admin";
            $data['nav']   = "home-about";
            $data['data'] = $model->getData('tbl_home_about', '', 'get');
            return view('admin.shop.home_about', $data);
        }else{
            return redirect('/auth?url='.$url);
        }
    }

    public function new_home_about(Request $request){
        if(Session::has('admin')){
            $model = new ShopModel();
            $post = $request->all();

            if($request->hasFile('image')){
                $image1       = $request->file('image');
                $path1 = "assets/images/home-about";
                $uploadImage = $this->storeImagesWithOut($image1, $path1);
                $post['input']['image']  = $path1.'/'.$uploadImage;
            }
            if($post['where']['id'] == ""){
                //insert data

                //insert data
                $sql= $model->insert_data('tbl_home_about', array_merge($post['input'], array('is_active'=>'1', 'date_time'=>date('Y-m-d', time()))));
                if($sql['code'] == 200){
                    Session::flash('success', $post['input']['title'].' insert successful..');
                }else{
                    Session::flash('danger', ' Getting Error');
                }

                return redirect($_SERVER['HTTP_REFERER']);
            }else{
                //update data
                $sql= $model->update_data('tbl_home_about',$post['where'],$post['input']);
                if($sql['code'] == 200){
                    Session::flash('success', $post['input']['title'].' update successful..');
                }else{
                    Session::flash('danger', ' Getting Error');
                }
                return redirect($_SERVER['HTTP_REFERER']);
            }
            //echo '<pre>'; print_r($post); exit;

        }else{
            return redirect('/auth?url='.$_SERVER['HTTP_REFERER']);
        }
    }

    // start testimonial ======================================================================================
    public function new_testimonial()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "new-testimonial";
            return view('admin.shop.new-shop-testimonial', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function post_new_testimonial(Request $request)
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $post = $request->all();
            //echo '<pre>'; print_r($post);exit;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = "assets/uploads/testimonial/";
                $uploadImage = $this->storeImages($image, $path, 64, 64);
                $post['input']['image'] = $path . 'thumbnail_images/' . $uploadImage;
            }
            if ($post['where']['id'] == "") {
                //insert
                $sql = $model->insert_data('tbl_testimonials', array_merge($post['input'], array('is_active' => '1', 'date_time' => date('Y-m-d H:i:s', time()))));
                if ($sql['code'] == 200) {
                    Session::flash('success', $post['input']['name'].'  Testimonial Insert Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            } else {
                //update
                $sql = FunctionModel::update_data('tbl_testimonials', array('id'=> base64_decode($post['where']['id'])), $post['input']);
                if ($sql['code'] == 200) {
                    Session::flash('success', 'Update testimonial Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            }
            return redirect($_SERVER['HTTP_REFERER']);


        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function shop_testimonial()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "shop-testimonial";
            $data['shop_testimonial'] = $model->getData('tbl_testimonials', array('is_active' => '1'), 'paginate', array('id' => 'Desc'));
            return view('admin.shop.shop-testimonial', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function update_testimonial($testimonial){
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "new-testimonial";
            $data['testimonial'] = FunctionModel::getData('tbl_testimonials', array('id'=> base64_decode($testimonial)), 'first', array('id' => 'Desc'));

            return view('admin.shop.new-shop-testimonial', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    // stop testimonial ======================================================================================


    // start testimonial ======================================================================================
    public function new_team()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "new-team";
            return view('admin.shop.new-shop-team', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function post_new_team(Request $request)
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $post = $request->all();
            //echo '<pre>'; print_r($post);exit;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = "assets/uploads/testimonial/";
                $uploadImage = $this->storeImages($image, $path, 64, 64);
                $post['input']['image'] = $path . 'thumbnail_images/' . $uploadImage;
            }
            if ($post['where']['id'] == "") {
                //insert
                $sql = $model->insert_data('tbl_team', array_merge($post['input'], array('is_active' => '1', 'date_time' => date('Y-m-d H:i:s', time()))));
                if ($sql['code'] == 200) {
                    Session::flash('success', $post['input']['name'].'  team Insert Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            } else {
                //update
                $sql = FunctionModel::update_data('tbl_team', array('id'=> base64_decode($post['where']['id'])), $post['input']);
                if ($sql['code'] == 200) {
                    Session::flash('success', 'Update team Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            }
            return redirect($_SERVER['HTTP_REFERER']);


        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function shop_team()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "shop-team";
            $data['shop_testimonial'] = $model->getData('tbl_team', array('is_active' => '1'), 'paginate', array('id' => 'Desc'));
            return view('admin.shop.shop-team', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function update_team($testimonial){
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "new-team";
            $data['testimonial'] = FunctionModel::getData('tbl_team', array('id'=> base64_decode($testimonial)), 'first', array('id' => 'Desc'));

            return view('admin.shop.new-shop-team', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    // stop testimonial ======================================================================================

    /*++++++++++++++++++++++=========================++++++++++++++++++++++++++++++++++++
                                    END banner WORKS
    ++++++++++++++++++++++++=========================+++++++++++++++++++++++++++++++++++*/

    public function ajex_update_status(Request $request){
        if(Session::has('admin')){
            $post = $request->all();
            $sql = FunctionModel::update_data('tbl_'.$post['tab'], $post['where'], $post['input']);
            if($sql['code'] == 200){
                return json_encode(array('code'=> 200, 'msg'=> $post['title'].' '.($post['input']['is_active'] == '1' ? "active" : "non-active" )." successful."));
            }else{
                return json_encode(array('code'=> 400, 'msg'=> 'status failed please.'));
            }
        }else{
            return json_encode(array('code'=> 404, 'msg'=> 'auth failed please try again.'));
        }
    }

    public function shop_product_size()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $data['title'] = "Sona Pure || Admin";
            $data['nav'] = "new-product-size";
            $data['data'] = FunctionModel::getData('tbl_size', '', 'get', array('id' => 'Desc'));

            return view('admin.shop.new-product-size', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function post_shop_product_size(Request $request){
        $url = url()->previous();
        if (Session::has('admin')) {
            $model = new ShopModel();
            $post = $request->all();
            if($post['where']['id'] == ""){
                $check_size = FunctionModel::getDataByLike('tbl_size','first',  '', array('size_title'=> $post['size_title']));
                if($check_size !=""){
                    Session::flash('warning', $post['size_title'].' size already exits.');
                }else{
                    $data_size = array(
                        'size_title' => $post['size_title'],
                        'is_active'  => '1',
                        'date_time'  => date('Y-m-d', time())
                    );
                    $sql_size = FunctionModel::insert_data('tbl_size', $data_size);
                    if($sql_size['code'] == 200){
                        Session::flash('success', $post['size_title']. ' insert successful.');
                    }else{
                        Session::flash('error', 'Getting error try again.');
                    }
                }
                return redirect($url);
            }else{
                $sql_size = FunctionModel::update_data('tbl_size', $post['where'], array('size_title' => $post['size_title']));
                if($sql_size['code'] == 200){
                    Session::flash('success', $post['size_title']. ' update successful.');
                }else{
                    Session::flash('error', 'Getting error try again.');
                }
                return redirect($url);
            }
        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function search_customer_number(){
        if (Session::has('admin')) {
            //$model = new ShopModel();
            $where = array('is_active'=>'1');
            $whereLike = array();
            if(!is_numeric($_GET['term'])){
                $whereLike['first_name'] = $_GET['term'];
            }else{
                $whereLike['mobile'] = $_GET['term'];
            }
            $sql = FunctionModel::getDataByLike('tbl_client', 'get', $where, $whereLike);
            $data = array();
            if(count($sql) !=0){
                foreach ($sql as $key=>$row){
                    $data[$key]['value'] = $row->first_name.' '.$row->last_name.' - '.$row->mobile;
                }
            }
            return json_encode($data);
        }
    }


}
