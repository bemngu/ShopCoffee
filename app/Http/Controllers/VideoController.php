<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Session;
use App\Video;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function video(){
        return view('admin.video.list_video');
        }
}
