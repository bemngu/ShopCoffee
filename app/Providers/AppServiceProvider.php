<?php

namespace App\Providers;
use App\Product;
use App\CatePost;
use App\Customer;
use App\Post;
use App\Order;
use DB;
use Session;
use App\Http\Requests;
use Mail;
use App\CategoryProductModel;
use App\Slider;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view) {
            $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
            $min_price = Product::min('product_price');
            $max_price = Product::max('product_price');
            $min_price_range = $min_price + 500000;
            $max_price_range = $max_price + 10000000;
            $app_product = Product::all()->count();
            $app_post = Post::all()->count();
            $app_order = Order::all()->count();
            $app_customer = Customer::all()->count();
            $share_image = '';
            $view->with('min_price', $min_price )->with('max_price', $max_price )->with('min_price_range', $min_price_range )->with('max_price_range', $max_price_range )->with('app_product', $app_product )->with('app_post', $app_post )->with('app_order', $app_order )->with('app_customer', $app_customer )->with('share_image',$share_image)->with('category_post',$category_post);
        });
    }
}
