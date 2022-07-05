<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use Symfony\Component\HttpKernel\Exception\HttpException;
use SMSAlert\Lib\Smsalert\Smsalert;

define("SMS_SENDER_ID", 'ParagA');
define("SMS_AUTH_KEY", '5f5b3f967b3a2');
define("SMSALERT_USER", 'paragawasthi');
define("SMSALERT_PWD", 'SMS@lert123');

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function get_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact_number' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        if (User::where('contact_number', '=', $request->contact_number)->exists()) {
            // user found
            
            if($request->contact_number == '9876543210')
            $success['otp'] =  '123456';
            else
            $success['otp'] = random_int(100000, 999999);
            
            //$smsalert = (new Smsalert())->authWithUserIdPwd(SMSALERT_USER,SMSALERT_PWD);
            //$smsalert->setSender('CVDEMO')->send('9579477262', "test");
            $sms_template= "Dear User, Your OTP to register/access Acharya Parag Awasthi is ".$success['otp'].". \nIt will be valid for 10 minutes. \nAcharya Parag Awasthi";
            $this->SendSmsToUserMobile($request->contact_number, $sms_template);
            
            if(DB::table('users_otp')->where('contact_number', $request->contact_number)->exists())
                DB::table('users_otp')->where('contact_number', $request->contact_number)->update(['otp' => $success['otp']]);
            else
                DB::table('users_otp')->updateOrInsert(['contact_number' => $request->contact_number, 'otp' => $success['otp']]);
            
            return $this->sendResponse($success, 'User Found Successfully');
         }else{
             return $this->sendError('User Not Found', 'No Data');
         }
        
   
        
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'contact_number' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        try{
        $input = $request->all();
        $input['password'] = Hash::make('test123');
        $input['role'] = 'User';
        $input['is_admin'] = '0';
        $user = User::create($input);
        $success['token'] =  $user->createToken('VaastuApp')->plainTextToken;
        $success['name'] =  $user->name;
        $success['otp'] =  '123456';
            
        if(DB::table('users_otp')->where('contact_number', $request->contact_number)->exists())
            DB::table('users_otp')->where('contact_number', $request->contact_number)->update(['otp' => $success['otp']]);
        else
            DB::table('users_otp')->updateOrInsert(['contact_number' => $request->contact_number, 'otp' => $success['otp']]);
        } catch (\Exception $e) {
            
            return $this->sendError('Email or Contact Number Already Exists', 'Email or Contact Number Already Exists');
        }
        return $this->sendResponse($success, 'User register successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'contact_number' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        if(DB::table('users_otp')->where('contact_number', $request->contact_number)->where('otp', $request->otp)->exists()){
        if(Auth::attempt(['contact_number' => $request->contact_number, 'password' => 'test123'])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('VaastuApp')->plainTextToken; 
            $success['name'] =  $user->name;
            $success['user_id'] =  $user->id;
            $success['user_email'] =  $user->email;
            $success['contact_number'] =  $user->contact_number;
            $success['no_of_report_generate'] =  $user->no_of_report_generate;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('User Not Found.', ['error'=>'User Not Found']);
        } 
        }else{
            return $this->sendError('OTP Missmatch', ['error'=>'OTP Missmatch']);
        }
    }
    
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
    
    public function users()
    {
        $users = User::all();
        return $this->sendResponse($users, 'Users retrieved successfully.');
    }
    
    public function SendSmsToUserMobile($phone_number, $message){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.smsalert.co.in/api/push.json?apikey=".SMS_AUTH_KEY."&sender=".SMS_SENDER_ID."&mobileno=".$phone_number."&text=".urlencode($message),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",  
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    
}

