<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Mail;
use App\CatePost;
use App\CategoryProductModel;
use App\Slider;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

session_start();

class HomeController extends Controller
{
    public function error_page(){
        return view('errors.404');
    }
    public function index(Request $request){
        //slide
        $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        //seo 
        $meta_desc = "Chuyên bán những thức uống ngon, chất lượng"; 
        $meta_keywords = "Coffee, tra sua, nước ép, sinh tố";
        $meta_title = "Coffe Shop MT";
        $url_canonical = $request->url();
        //--seo
        
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(6); 

    	return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
        }
    public function send_mail(){
         //send mail
                $to_name = "Bem ngu";
                $to_email = "nvatuan.20it11@vku.udn.vn";//send to this email
               
             
                $data = array("name"=>"Mail từ tài khoản Khách hàng","body"=>'Mail gửi về vấn về hàng hóa'); //body of mail.blade.php
                
                Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){

                    $message->to($to_email)->subject('Test thử gửi mail google');
                    $message->from($to_email,$to_name);//send from this mail
                });
                // return redirect('/')->with('message','');
                //--send mail
    }
    public function lien_he(Request $request){
      
       $meta_desc = "Trang liên hệ"; 
       $meta_keywords = "Trang liên hệ";
       $meta_title = "Trang liên hệ";
       $url_canonical = $request->url();
       //--seo
       $keywords = $request->keywords_submit;
       $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
       $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
    
       return view('pages.lienhe')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function menu(Request $request){
      
       $meta_desc = "Trang menu"; 
       $meta_keywords = "Trang menu";
       $meta_title = "Trang menu";
       $url_canonical = $request->url();
       //--seo
       $keywords = $request->keywords_submit;
       $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
       $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
    
       return view('elements.menu')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    


   
    public function search(Request $request){
     
        //seo  
        $meta_desc = "Tìm kiếm sản phẩm"; 
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        //--seo
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get(); 
        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);

    }
}
