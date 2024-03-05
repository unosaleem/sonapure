<?php

namespace App\Http\Controllers\Api;

use App\ClientUser;
use App\FunctionModel;
use App\HomeModel;
use App\Http\Controllers\APIRes;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'max:10', 'min:10','unique:tbl_client'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tbl_client'],
            'password' => ['required', 'string', 'min:8'],
            'dob' => ['required'],
            'gender' => ['required'],
        ]);
    }
    protected function create(array $data)
    {
        $new_user =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
            'dob'   => $data['dob'],
            'is_active' => 1,
            'salt_password' =>  base64_encode($data['password']),
            'date_time' =>  date('Y-m-d H:i:s')
        ]);
        return $new_user;
    }
    public function register(Request $request)
    {
    	//Validate data

        $data = $request->only('first_name','last_name', 'email','mobile', 'password','dob','gender','confirm_password');

        $validator = $this->validator($data);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            // return response()->json(['error' => $validator->messages()], 200);
            return APIRes::validation_res($validator);
        }

        //Request is valid, create new user
        try
        {
            DB::beginTransaction();
            $user = $this->create($data);
            DB::commit();
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());
            return APIRes::error_res('Something Went Wrong ',[$e->getMessage()]);
        }

        //User created, return success response
        return APIRes::success_res('User created successfully',$user);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return APIRes::validation_res($validator);
        }
        //Request is validated
        //Crean token
        try {
            $token = auth('api')->attempt($credentials);
            if (!$token) {
                return APIRes::error_res('Login credentials are invalid.');
            }
            $chk_user = auth('api')->authenticate($token);
            $chk_user->token = $token;

            //Token created, return with success response and jwt token
            return APIRes::success_res('Token Created',[$chk_user]);
            // if(!empty($chk_user->email_verified_at)){
            // }else{
            //     return APIRes::mailresend_res('Email Not Verified yet.',[$chk_user]);
            // }

        } catch (JWTException $e) {
            return APIRes::error_res('Could not create token.');
        }
        return APIRes::error_res('Something went wrong.');

    }
    // public function attempt(array $credentials = [], $remember = false){
    //     return ClientUser::where('email',$credentials['email'])
    //             ->where('password',md5($credentials['password']))
    //             ->first();
    // }
    public function resend(Request $request)
    {

        $user = $request->user();
        if($user->hasVerifiedEmail()){
            return APIRes::success_res('Already Verified.',[$user]);
        }else{

            try{
                $user->sendEmailVerificationNotification();
                return APIRes::success_res('verify link has been send to your Email.',[$user]);

            }catch (\Exception $e){
                Log::error($e->getMessage() . "\n" . $e->getTraceAsString());
                return APIRes::error_res('Mail Not Working now.',[$e->getMessage()]);
            }
        }
        return APIRes::error_res('Something went wrong.');

        // return response()->json(['user' => $user]);
    }
    public function logout(Request $request)
    {
		//Request is validated, do logout
        try {
            auth('api')->invalidate(true);

            return APIRes::success_res('User has been logged out');

        } catch (JWTException $exception) {
            return APIRes::error_res('Sorry, user cannot be logged out');
        }
    }

    public function profile(Request $request)
    {
        return APIRes::success_res('user info',[$request->user()]);
    }

    public function profileUpdate(Request $request){
        $data = $request->all();
        $profile = $request->user();
        // return $profile;
        $arr = [
            'first_name' => (isset($data['first_name'])) ? $data['first_name'] : $profile->first_name,
            'last_name' => (isset($data['last_name'])) ? $data['last_name'] : $profile->last_name,
            'mobile' => (isset($data['mobile'])) ? $data['mobile'] : $profile->mobile,
            'gender' => (isset($data['gender'])) ? $data['gender'] : $profile->gender,
            'dob'   => (isset($data['dob'])) ? $data['dob'] : $profile->dob
        ];

        User::where('id',$profile->id)
                ->update($arr);

        return APIRes::success_res('Successfully Updated',[User::find($profile->id)]);

    }

    public function passwordUpdate(Request $request){

        $validator = Validator::make($request->all(), [
            'old_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8','confirmed']
        ]);

        if ($validator->fails()) {
            return APIRes::validation_res($validator);
        }

        $data = $request->all();
        $profile = $request->user();
        $profile = User::find($profile->id);

        if($profile->password != Hash::make($data['old_password'])){
            return APIRes::normal_validation_res("Old Password are Invalid !!");
        }

        $profile->password = Hash::make($data['password']);
        $profile->salt_password = base64_encode($data['password']);
        $profile->save();

        return APIRes::success_res('Successfully Updated',[$profile]);

    }

    public function getAddressViaPinCode(Request $request){
        $post = $request->all();
        $url = "http://www.postalpincode.in/api/pincode/".$post['pincode'];

        $homeController = new HomeController();
        $address = $homeController->thiCurl($url);
        $address = json_decode($address, true);

        $data = array();
        if(count($address['PostOffice']) !=0){
            $data['district']   = $address['PostOffice'][0]['District'];
            $data['region']     = $address['PostOffice'][0]['Region'];
            $data['state']      = $address['PostOffice'][0]['State'];
            $data['country']    = $address['PostOffice'][0]['Country'];
        }
        return APIRes::success_res('',[$data]);
    }

    public function addUpdateAddress(Request $request){
        $post = $request->all();
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'locality' => ['required', 'string'],
            'address' => ['required', 'string'],
            'zip' => ['required'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'country' => ['required', 'string'],
            'type' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return APIRes::validation_res($validator);
        }

        $data = array(
            'client_id' => $user->id,
            'locality'  => $post['locality'],
            'address'   => $post['address'],
            'zip'       => $post['zip'],
            'city'      => $post['city'],
            'state'     => $post['state'],
            'country'   => $post['country'],
            'type'      => $post['type']
        );

        if(isset($post['address_id'])){
            $sql = FunctionModel::update_data('tbl_client_address', array('id'=> $post['address_id']), $data);

            return APIRes::success_res("Address Updated Successfully");

        }else{
            $data['is_active'] = '1';
            $data['date_time'] = date('Y-m-d', time());
            $sql = FunctionModel::insert_data('tbl_client_address', $data);

            return APIRes::success_res("Address Added Successfully");
        }
    }

    public function addressList(Request $request){

        $user = $request->user();
        $address_id = $request->input('address_id');

        $where = [
            'client_id'=> $user->id,
            'is_active'=>'1'
        ];
        if($address_id > 0){
            $where['id'] = $address_id;
        }
        $address = HomeModel::getData('tbl_client_address', $where, 'get');

        return APIRes::success_res("",$address);
    }

    public function getAddressType(){
        return APIRes::success_res("success",[[
            'key'   =>  'home',
            'value'   =>  'Home',
        ],
        [
            'key'   =>  'office',
            'value'   =>  'Office',
        ],
        [
            'key'   =>  'other',
            'value'   =>  'Other',
        ]]);
    }
}
