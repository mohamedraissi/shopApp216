<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use App\Models\SMS;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Session\Store;
use Session;
use Auth;
use App\Models\Country;


class UsersController extends Controller
{
    public function Login(){
        return view('front.users.Login');
    }
    public function Register(){
        return view('front.users.Register');
    }
    public function registerUser(Request $request){
        if ($request->isMethod('post')){
            Session::forget('error_message');
            Session::forget('success_message');
            $data = $request->all();
           
            //check if user already exist
            $userCount = User::where('email',$data['email'])->count();
            if ($userCount>0){
                $message = "Email already exists!";
                session::flash('error_message',$message);
                return redirect()->back();
            }else {
                // SAVE USER 
                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 0 ;
                $user->save();
//send Confirmation email
$email = $data['email'];
$messageData = [
    'email' => $data['email'],
    'name' => $data['name'],
    'code'=>base64_encode($data['email'])
];
Mail::send('emails.confirmation',$messageData,function($message)use($email){
$message->to($email)->subject('Confirm Your shop216 Account');
});
$message = "Please confirm your email to activate your account!";
Session::put('success_message',$message);
return redirect()->back();
               /* if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    
                        if (!empty(Session::get('session_id'))){
                            $user_id = Auth::user()->id;
                            $session_id =Session::get('session_id');
                            Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                        }
 
/*$message  = "Welcome to shop216 , You have been successfully registered with Shop216 Website.
Login to your account and enjoy your shop.";
$mobile = $data['mobile'];
SMS::sendSms($message,$mobile);
//SEND REGISTER EMAIL
$email = $data['email'];
$messageData = ['name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$data['email']];
Mail::send('emails.register',$messageData,function($message)use($email){
    $message->to($email)->subject('Welcome to shop216 Website');
});
                    return redirect('index'); 
                }*/
            }
        }

    }
    public function logoutUser(){
        Auth::logout();
        return redirect('/index');
    }
public function LoginUser(Request $request){
    if ($request->isMethod('post')){
        Session::forget('error_message');
        Session::forget('success_message');
        $data = $request->all();
        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            $userStatus = User::where('email',$data['email'])->first();
            if ($userStatus->status == 0){
                Auth::logout();
                $message = "Your account is not activated yet! Please confirm your email to activate";
                Session::put('error_message',$message);
                return redirect()->back();
            }
            if (!empty(Session::get('session_id'))){
                $user_id = Auth::user()->id;
                $session_id = Session::get('session_id');
                Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
            }

            return redirect ('/cart');
        }else {
            $message = "Invalid Username or Password";
            Session::flash ('error_message',$message);
            return redirect()->back();
        }
    }

}

    public function checkEmail(Request $request){
        $data = $request->all();
        $emailCount = User::where('email',$data['email'])->count();
        if ($emailCount>0) {
            echo "false";
        } else { 
            echo "true";die;
        }
    }
    public function confirmAccount($email){

        $email = base64_decode($email); 
        $userCount = User::where('email',$email)->count();
        if($userCount>0){
            $userDetails = User::where('email',$email)->first();
            if($userDetails->status == 1){
                $message = "Your Email account is already activated.";
                Session::put('error_message',$message);
                return redirect('Login');
            }else {
                User::where('email',$email)->update(['status'=>1]);
$messageData = ['name'=>$userDetails['name'],'mobile'=>$userDetails['mobile'],'email'=>$email];
Mail::send('emails.register',$messageData,function($message)use($email){
    $message->to($email)->subject('Welcome to shop216 Website');
});
$message = "Your Email account is activated.";
Session::put('success_message',$message);
return redirect('Login');
            }

        }else{
            abort(404);
        }
    }
    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $emailCount = User::where('email',$data['email'])->count();
            if($emailCount == 0) {
                $message = "Email does not exists!";
                Session::put('error_message','Email does not exists!');
                Session::forget('success_message');
                return redirect()->back();
            }
            $random_password = str_random(8);

            $new_password = bcrypt($random_password);

            User::where('email',$data['email'])->update(['password'=>$new_password]);

            $userName =User::select('name')->where('email',$data['email'])->first();
            $email = $data['email'];
            $name = $userName->name;
            $messageData = [
                'email' => $email,
                'name' => $name,
                'password' => $random_password
            ];
            Mail::send('emails.forgot_password',$messageData,function($message)use($email){
                $message->to($email)->subject('New password - Shop216');
            });
                $message = "Please check your email for new password";
            
                Session::put('success_message');
                Session::forgot('error_message');
                return redirect('Login');
            
        }
        return view('front.users.forgot_password');
        }


        public function account(Request $request){
            $user_id = Auth::user()->id;
            $userDetails = User::find($user_id)->toArray();
            
            $countries = Country::where('status',1)->get()->toArray();
            if ($request->isMethod('post')){
                $data = $request->all();
                
                Session::forget('error_message');
                Session::forget('success_message');

                $rules = [
                    'name' =>'required |regex:/^[\pL\s\-]+$/u',
                    'mobile' => 'required | numeric',
                ];
                $customMessages = [
                    'name.required' => 'Name is required',
                    'name.regex' => 'Valid Name is required',
                    'mobile.required' => 'Mobile is required',
                    
                ];
                $this->validate($request,$rules,$customMessages);
                
                $user = User::find($user_id);
                $user->name = $data['name'];
                $user->address = $data['address'];
                $user->city = $data['city'];
                $user->state = $data['state'];
                $user->country = $data['country'];
                $user->pincode = $data['pincode'];
                $user->mobile = $data['mobile'];
                $user->country = $data['country'];
                $user->save();
                $message = "Your account details has been updated successfuly";
                Session::put('success_message',$message);
                return redirect()->back();
                
            }
            return view('front.users.account')->with(compact('userDetails','countries'));
        }
        public function chkUserPassword(Request $request){
            if($request->isMethod('post')){
                $data = $request->all();
                $user_id = Auth::User()->id;
                $chkPassword = User::select('password')->where('id',$user_id)->first();
                if(Hash::check($data['current_pwd'],$chkPassword->password)){
                    return "true";
                }else{
                return "false";
                }
            }
        }

        public function updateUserPassword(Request $request){
            if($request->isMethod('post')){
                $data = $request->all();
                $user_id = Auth::User()->id;
                $chkPassword = User::select('password')->where('id',$user_id)->first();
                if(Hash::check($data['current_pwd'],$chkPassword->password)){
                    $new_pwd = bcrypt($data['new_pwd']);
                    User::where('id',$user_id)->update(['password'=>$new_pwd]);
                    $message = "Password updated successfully!";
                    Session::put('succes_message',$message);
                    Session::forget('error_message');
                    return redirect()->back();
                }else{
                    $message = "Current Password is Incorrect!";
                    Session::put('error_message',$message);
                    Session::forget('succes_message');
                    return redirect()->back();
                }
            }
        }

    };
