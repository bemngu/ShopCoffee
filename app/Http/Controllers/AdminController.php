<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Social;
use App\SocialCustomers;
use Socialite;
use App\Login;
use App\Http\Requests;
use App\Statistic; 
use Illuminate\Support\Facades\Redirect;
use Validator;
use Auth;
use App\Rules\Captcha; 
use Carbon\Carbon;
use App\Visitors;
use App\Post;
use App\Order;
use App\Product;
use App\Customer;
class AdminController extends Controller
{
    

    
public function show_dashboard(Request $request){
    $this->AuthLogin();
        
    $user_ip_address = $request->ip();  

    $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
    $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
    $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
    $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        //total last month
    $visitor_of_lastmonth = Visitors::whereBetween('date_visitor',[$early_last_month,$end_of_last_month])->get(); 
    $visitor_last_month_count = $visitor_of_lastmonth->count();
        //total this month
    $visitor_of_thismonth = Visitors::whereBetween('date_visitor',[$early_this_month,$now])->get(); 
    $visitor_this_month_count = $visitor_of_thismonth->count();
        //total in one year
    $visitor_of_year = Visitors::whereBetween('date_visitor',[$oneyears,$now])->get(); 
    $visitor_year_count = $visitor_of_year->count();
        //total visitors
    $visitors = Visitors::all();
    $visitors_total = $visitors->count();
        //current online
    $visitors_current = Visitors::where('ip_address',$user_ip_address)->get();  
    $visitor_count = $visitors_current->count();

    if($visitor_count<1){
        $visitor = new Visitors();
        $visitor->ip_address = $user_ip_address;
        $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $visitor->save();
    }

    
        //total 
        $product = Product::all()->count();
        $post = Post::all()->count();
        $order = Order::all()->count();
        $customer = Customer::all()->count();
    
        $product_views = Product::orderBy('product_views','DESC')->take(20)->get();
        $post_views = Post::orderBy('post_views','DESC')->take(20)->get();
    
    
        return view('admin.dashboard')->with(compact('visitors_total','visitor_count','visitor_last_month_count','visitor_this_month_count','visitor_year_count','product','post','order','customer','product_views','post_views'));
}

    
    public function AuthLogin(){

        if(Session::get('login_normal')){

            $admin_id = Session::get('admin_id');
        }else{
            $admin_id = Auth::id();
        }
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        } 
    }

    public function index(){
    	return view('admin_login');
    }
    public function dashboard(Request $request){
        $data = $request->validate([
            //validation laravel 
            'admin_email' => 'required',
            'admin_password' => 'required',
            'g-recaptcha-response' => new Captcha(),    //dòng kiểm tra Captcha
        ]);

        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($login){
            $login_count = $login->count();
            if($login_count>0){
                Session::put('admin_name',$login->admin_name);
                Session::put('admin_id',$login->admin_id);
                return Redirect::to('/dashboard');
            }
        }else{
                Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
                return Redirect::to('/admin');
        }
       

    }
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
    public function login_facebook_customer(){
    
        return Socialite::driver('facebook')->redirect();
    }
    
 public function findOrCreateCustomer($users, $provider){
        $authUser = SocialCustomers::where('provider_user_id', $users->id)->first();
        if($authUser){
            return $authUser;
        }else{
            $customer_new = new SocialCustomers([
                'provider_user_id' => $users->id,
                'provider_user_email' => $users->email,
                'provider' => strtoupper($provider)
            ]);

            $customer = Customer::where('customer_email',$users->email)->first();

            if(!$customer){

                $customer = Customer::create([
                    'customer_name' => $users->name,
                    'customer_picture' => $users->avatar,
                    'customer_email' => $users->email,
                    'customer_password' => '',
                    'customer_phone' => ''
                ]);
            }

            $customer_new->customer()->associate($customer);

            $customer_new->save();
            return $customer_new;
        }           

    }
    public function callback_facebook_customer(){
       
        $provider = Socialite::driver('facebook')->user();
        $account = SocialCustomers::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account!=NULL){

           $account_name = Customer::where('customer_id',$account->user)->first();
           Session::put('customer_id',$account_name->customer_id);
           Session::put('customer_name',$account_name->customer_name);

           return redirect('/dang-nhap')->with('message', 'Đăng nhập bằng tài khoản facebook <span style="color:red">'.$account_name->customer_email.'</span> thành công');  

       }elseif($account==NULL){
           $customer_login = new SocialCustomers([
            'provider_user_id' => $provider->getId(),
            'provider_user_email' => $provider->getEmail(),
            'provider' => 'facebook'
            ]);

           $customer = Customer::where('customer_email',$provider->getEmail())->first();

           if(!$customer){
            $customer = Customer::create([
                'customer_name' => $provider->getName(),
                'customer_email' => $provider->getEmail(),
                'customer_picture' => '',
                'customer_password' => '',
                'customer_phone' => ''
            ]);
        }
        $customer_login->customer()->associate($customer);
        $customer_login->save();

        $account_new = Customer::where('customer_id',$customer_login->user)->first();
        Session::put('customer_id',$account_new->customer_id);
        Session::put('customer_name',$account_new->customer_name);


        return redirect('/dang-nhap')->with('message', 'Đăng nhập bằng tài khoản facebook <span style="color:red">'.$account_new->customer_email.'</span> thành công');      


    }



}
}
