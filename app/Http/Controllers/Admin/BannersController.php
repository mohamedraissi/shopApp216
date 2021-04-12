<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Banner;
use Session;
use Image;
class BannersController extends Controller
{
    public function banners(){
        Session::put('page',"banners");
        $banners = Banner::get()->toArray();
        
        return view('admin.banners.banners')->with(compact('banners'));
    }
    public function updateBannerStatus (Request $request){
        if ($request->ajax()){
            $data= $request->all();
            /*echo "<pre>" ; print_r($data); die;*/
           if($data['status']=="Active"){
                $status=0;
               }
           else{
               $status =1;
           }
           Banner::where('id', $data ['banner_id'])->update(['status'=>$status]);
           return response ()->json(['status'=>$status,'banner_id'=>$data ['banner_id']]);
        }
    }
    public function deleteBanner($id){
       
        $bannerImage = Banner::where('id',$id)->first();
        
        $banner_image_path = 'images/banner_images/';
        
        if(file_exists($banner_image_path.$bannerImage->image)){
            unlink($banner_image_path.$bannerImage->image);
        }
        Banner::where('id',$id)->delete();
        session::flash('success_message','Banner deleted succesfully');
        return redirect()->back();
    }
    public function addeditBanner($id=null,Request $request){
        if ($id==""){
            $banner = new Banner;
            $title = "Add Banner Image";
            $message ="Banner added successfully!";
        }else{
            $banner = Banner::find($id);
            $title ="Edit Banner Image";
            $message ="Banner updated successfully!";

        }
        if ($request->isMethod('post')){
        $data = $request->all();
        


        $imageName="";
    if($request->hasFile('banner_image')){
        $image_tmp = $request->file('banner_image');
        if($image_tmp->isValid()){
            //get image extension
            $extension = $image_tmp->getClientOriginalExtension();
            // generate new image name
            $imageName = rand(111,99999).'.'.$extension;
            $imagePath = 'images/banners_images/'.$imageName;
            //upload the image
            Image::make($image_tmp)->save($imagePath);
            //save category image
            $banner->banner_image = $imageName;
        }
    }


        $banner->link = $data['link'];
        $banner->title = $data['title'];
        $banner->alt = $data['alt'];
        $banner->status = 1;
        $banner->save();
          session::flash('success_message',$message);
          return redirect('admin/banners');
        
        }
        
return view ('admin.banners.add_edit_banner')->with(compact('title','banner'));
} 

}