<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\Admin;
use Hash;
use Image;
use DB;

class AdminController extends Controller
{
    public function dashboard(){
        return view('layouts.admin_layout.admin_dashboard');
    }
    public function settings(){
        $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('layouts.admin_layout.admin_settings')->with(compact('adminDetails'));
    }
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $rules =[
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];
            $customMessages =[
                'email.required' => 'Adresse E-mail est obligatoire',
                'email.email' => 'Une adresse E-mail valable est obligatoire',
                'password.required' => 'Mot de passe est obligatoire',
            ];
            $this->validate($request,$rules,$customMessages);
        
           // echo"<pre>"; print_r($data); die;
           if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
               return redirect('admin/dashboard');}
               else{
                   Session::flash('error_message','Adresse E-mail ou mot de passe invalide');
                   return redirect()->back();
               }
           }
        
        // echo $password = Hash::make('1234567');die;
        return view ('layouts.admin_layout.admin_login');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
    public function checkCurrentPassword(Request $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
            echo"true";
        }else{
            echo"false";
        }

    }
    public function updateCurrentPassword (Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
                if($data['new_pwd']==$data['confirm_pwd']){
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                    Session::flash('success_message','password has been update successufly!');
                    return redirect()->back();
                }else{
                    Session::flash('error_message','new password and confirm password not match');
                    return redirect()->back();
                }
            }else{
                Session::flash('error_message','Your current password is incorrect');
                return redirect()->back();
            }

        }
    }
    public function updateAdminDetails (Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $rules =[
                'admin_name' =>'required|regex:/^[\pL\s\-]+$/u',
                'admin_phone' => 'required|numeric',
                'admin_image' =>'image',
                
            ];
            $customMessages =[
                'admin_name.required' =>'Name is required',
                'admin_name.regex' =>' Valid Name is required',
                'admin_phone.required'=>'phone is required',
                'admin_phone.numeric'=>' Valid phone is required',
                'admin_image.image' =>'Valid image is required',

            ];
            $this->validate($request,$rules,$customMessages);

             //upload image
            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    //get image extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'images/admin_images/'.$imageName;
                    
                    //upload the image
                    Image::make($image_tmp)->save($imagePath);
                }else if(!empty($data['current_admin_image'])){
                    $imageName =$data['current_admin_image'];
                }else{
                    $imageName ="";
                }
         }
            

            //update name and phone
            Admin::where('email',Auth::guard('admin')->user()->email)
            ->update(['name'=>$data['admin_name'],'phone'=>$data['admin_phone'],'image'=>$imageName]);
            Session::flash('success_message','Admin details update successufly!');
            return redirect()->back();
            


        }
        return view('layouts.admin_layout.update_admin_details');
    }
    public function addSubAdmin(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $rules =[
                'admin_name' =>'required|regex:/^[\pL\s\-]+$/u',
                'admin_type'=> 'required',
                
                'admin_phone' => 'required|numeric',
                'email' => 'required|email|max:255',
                'password' => 'required',
                
                'admin_image' =>'required',
                'admin_status' =>'required',
                'admin_role' =>'required',
                
            ];
            $customMessages =[
                'admin_name.required' =>'Name is required',
                'admin_name.alpha' =>' Valid Name is required',
                'admin_type.required' => 'type is required',
                
                'admin_phone.required'=>'phone is required',
                'admin_phone.numeric'=>' Valid phone is required',
                'email.required' => 'Adresse E-mail est obligatoire',
                'email.email' => 'Une adresse E-mail valable est obligatoire',
                'password.required' => 'Mot de passe est obligatoire',
               
                'admin_image.required' =>'Valid image is required',
                'admin_status.required' =>'status is required',
                'admin_role.required' =>'role is required',



            ];
           
            $this->validate($request,$rules,$customMessages);
            $subadmin =new Admin();
            $subadmin->name=$request->input('admin_name');
            $subadmin->type=$request->input('admin_type');
            $subadmin->phone=$request->input('admin_phone');
            $subadmin->email=$request->input('email');
            $subadmin->password=bcrypt($request->input('password'));
            $subadmin->image=$request->input('admin_image');
            $subadmin->status=$request->input('admin_status');
            $subadmin->role=$request->input('admin_role');

            $subadmin->save();
            

            return back()->with('success','admin have been successfuly inserted');
        }
        

        return view('layouts.admin_layout.add_subadmin');
    }
}
