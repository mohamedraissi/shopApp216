<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/*class IndexController extends Controller
{
    public function index(){
        // Get Featured items
       /* 
        $featuredItemsCount = Product::where('is_featured','Yes')->count();
        $featuredItems = Product::where('is_featured','Yes')->get()->toArray();
        $featuredItemsChunk = array_chunk($featuredItems,4);



        //Get new Products

        $newProducts = Product::orderBy('id','Desc')->limit(6)->get()->toArray();
        $newProducts = json_decode(json_encode($newProducts),true);
        echo "<pre>"; print_r($newProducts); 

        $page_name = "index";
        return view('layouts.Client_layout.Pages.index')->with(compact('page_name','featuredItemChunk','featuredItemCount'));
    }
}*/
