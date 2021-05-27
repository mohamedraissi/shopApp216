<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        return view('layouts.Client_layout.Pages.index');
    }
    public function shop(){
        return view('layouts.Client_layout.Pages.shop');
    }
    public function blog(){
        return view('layouts.Client_layout.Pages.blog');
    }
    public function contact(){
        return view('layouts.Client_layout.Pages.contact');
    }
    public function blogd(){
        return view('layouts.Client_layout.Pages.blog-details');
    }
   
    public function shopcart(){
        return view('layouts.Client_layout.Pages.shopping-cart');
    }
}
