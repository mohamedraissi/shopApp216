<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\OptionValues;
use App\Models\ProductAble;

use Session;
class OptionController extends Controller
{
    public function options(){
        Session::put('page',"options");
    
         $options = Option::get();
         return view ('admin.options.options')->with(compact('options'));
     }  
     public function updateOptionStatus (Request $request){
        if ($request->ajax()){
            $data= $request->all();
            /*echo "<pre>" ; print_r($data); die;*/
           if($data['status']=="Active"){
                $status=0;
               }
           else{
               $status =1;
           }
           Option::where('id', $data ['option_id'])->update(['status'=>$status]);
           return response ()->json(['status'=>$status,'option_id'=>$data ['option_id']]);
        }
       }
       public function addEditOption(Request $request,$id=null){
        Session::put('page',"options");
           if($id==""){
               $title = "Add option";
               $option = new Option;
               $message = "option added successfully!";
           }else{
               $title = "Edit option";
               $option =  Option::find($id);
               $message = "option updated successfully!";
           }
           if ($request->isMethod('post')){
               $data = $request->all();
               //echo"<pre>";print_r($data);die;
          
               //options Validation 
               $rules =[
                'option_name' =>'required|regex:/^[\pL\s\-]+$/u',         
               ];
    
            $customMessages =[
                'option_name.required' =>'option Name is required',
                'option_name.regex' =>' Valid option Name is required',
                 ];
            $this->validate($request,$rules,$customMessages);
            $option->name = $data['option_name'];
            $option->status=1;
            $option-> save();
            session::flash('success_message',$message);
            return redirect('admin/options');
    
           }
           return view ('admin.options.add_edit_option')->with(compact('title','option'));
       } 
       public function deleteOption($id){
        
       
        //Delete option 
        $option= Option::where('id',$id)->get();
        Option::find($id)->values()->delete();
        Option::where('id',$id)->delete();
       
        $tab=[];
        foreach ($option->values() as $key => $value) {
         $tab[$key]=$value->id;
        }
        ProductAble::where('productable_id',$id)->delete();
        ProductAble::whereIn('productable_id',$tab)->delete();
        $message = 'options  has been deleted successfully!';
        session::flash('success_message',$message);
        return redirect('admin/options');
    
    }
    public function deleteValue($id){
      OptionValues::find($id)->delete();
      $message = 'options value  has been deleted successfully!';
      session::flash('success_message',$message);
      return redirect()->back();
    }
    

    public function addValues(Request $request,$id){
        if($request->isMethod('post')){
          $data = $request->all();
          //echo "<pre>";print_r($data); die;
          foreach ($data['value'] as $key =>$value){
            if(!empty($value)){
              //sku alreasy exists check
              $optionValue = OptionValues::where('value',$value)->count();
              if($optionValue>0){
                $message = 'value already exists.Please add another value!';
                session::flash('error_message',$message);
                return redirect()->back();
              }
              //size alreasy exists check
              $attrCountSize = OptionValues::where(['option_id'=>$id,'value'=>$data['value'][$key]])->count();
              if($attrCountSize>0){
                $message = 'value already exists.Please add another Size!';
                session::flash('error_message',$message);
                return redirect()->back();
              }

              $attribute = new OptionValues;
              $attribute->option_id = $id;
              $attribute->value = $data['value'][$key];
              $attribute->status = 1; 
              $attribute->save();


            }
          }
                $success_message = 'Product Attributes has been added successfully!';
                session::flash('success_message',$success_message);
                return redirect()->back();
        }

        $optiondata = Option::select('id','name')->with('values')->find($id);
        $optiondata = json_decode(json_encode($optiondata),true);
        //echo "<pre>";print_r($optiondata); die;
        $title = "Option Value";
        return view('admin.options.add_value')->with(compact('optiondata','title'));
      }

      public function editValues(Request $request,$id){
        if($request->isMethod('post')){
          $data = $request->all();
         //echo "<pre>";print_r($data);die;
         
          foreach($data['valId'] as $key => $attr) {
           if(!empty($attr)){
                OptionValues::where(['id'=>$data['valId'][$key]])->update(['value'=>$data
             ['value'][$key]]);
           }
         }
        
         $success_message = 'Option Values has been updated successfully!';
                session::flash('success_message',$success_message);
                return redirect()->back();
        }
      }
      public function updateValueStatus (Request $request){
        if ($request->ajax()){
            $data= $request->all();
            /*echo "<pre>" ; print_r($data); die;*/
           if($data['status']=="Active"){
                $status=0;
               }
           else{
               $status =1;
           }
           OptionValues::where('id', $data ['value_id'])->update(['status'=>$status]);
           return response ()->json(['status'=>$status,'value_id'=>$data ['value_id']]);
        }
       }
}
