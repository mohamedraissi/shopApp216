<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Section;
use Session;
class SectionController extends Controller
{
    public function sections(){
        Session::put('page',"sections");
        $sections = Section::get();
        return view('admin.sections.sections')->with(compact('sections'));
    }
    public function updateSectionStatus (Request $request){
     if ($request->ajax()){
         $data= $request->all();
         /*echo "<pre>" ; print_r($data); die;*/
        if($data['status']=="Active"){
             $status=0;
            }
        else{
            $status =1;
        }
        section::where('id', $data ['section_id'])->update(['status'=>$status]);
        return response ()->json(['status'=>$status,'section_id'=>$data ['section_id']]);
     }
    }
    public function addEditSection(Request $request,$id=null){
        Session::put('page',"Sections");
           if($id==""){
               $title = "Add Section";
               $section = new Section;
               $message = "Section added successfully!";
           }else{
               $title = "Edit Section";
               $section =  Section::find($id);
               $message = "Section updated successfully!";
           }
           if ($request->isMethod('post')){
               $data = $request->all();
               //echo"<pre>";print_r($data);die;
          
               //section Validation 
               $rules =[
                'section_name' =>'required|regex:/^[\pL\s\-]+$/u',         
               ];
    
            $customMessages =[
                'section_name.required' =>'section Name is required',
                'section_name.regex' =>' Valid section Name is required',
                 ];
            $this->validate($request,$rules,$customMessages);
            $section->name = $data['section_name'];
            $section->status =1;
            $section-> save();
            session::flash('success_message',$message);
            return redirect('admin/sections');
    
           }
           return view ('admin.sections.add_edit_section')->with(compact('title','section'));
       } 
       public function deleteSection($id){
        //Delete Brand 
        Section::where('id',$id)->delete();
        $message = 'Section  has been deleted successfully!';
        session::flash('success_message',$message);
        return redirect('admin/sections');
    
    }
}
