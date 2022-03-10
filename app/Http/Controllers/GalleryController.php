<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use App\Gallery;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class GalleryController extends Controller
{
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
    public function add_gallery($product_id){
        $pro_id = $product_id;
     return view('admin.gallery.add_gallery')->with(compact('pro_id')); //mang theo product_id

 }
 public function insert_gallery(Request $request,$pro_id){
    $get_image = $request->file('file');
    if($get_image){
        foreach($get_image as $image){
            $get_name_image = $image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
            $image->move('public/uploads/gallery',$new_image);
               $gallery = new Gallery();
               //3 cột trong csdl
               $gallery->gallery_name = $new_image;
               $gallery->gallery_image = $new_image;
               $gallery->product_id = $pro_id;
               $gallery->save();
        }
    }
    Session::put('message','Thêm thư viện ảnh thành công');
    return redirect()->back();

}
public function update_gallery_name(Request $request){
    $gal_id = $request->gal_id;
    $gal_text = $request->gal_text;
    $gallery = Gallery::find($gal_id);
    $gallery->gallery_name = $gal_text;
    $gallery->save();
}
public function delete_gallery(Request $request){
    $gal_id = $request->gal_id;
    $gallery = Gallery::find($gal_id);
    unlink('public/uploads/gallery/'.$gallery->gallery_image); //trước tiên xóa trong folder upload
    $gallery->delete(); //xóa luôn hình ảnh
}
public function update_gallery(Request $request){
    $get_image = $request->file('file');
    $gal_id = $request->gal_id;
    if($get_image){
            $gallery = Gallery::find($gal_id);
               unlink('public/uploads/gallery/'.$gallery->gallery_image);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/gallery',$new_image);
            $gallery->gallery_image = $new_image;
               $gallery->save(); 
        
    }
}
 public function select_gallery(Request $request){
    $product_id = $request->pro_id; //pro_id là name html 
    $gallery = Gallery::where('product_id',$product_id)->get();//$product_id là tên trong bảng csdl Gallery
    $gallery_count = $gallery->count();
    $output = ' <form>
                    '.csrf_field().'

                    <table class="table table-hover">
                                <thead>
                                  <tr>
                                      <th>Thứ tự</th>
                                    <th>Tên hình ảnh</th>
                                    <th>Hình ảnh</th>
                                    <th>Quản lý</th>
                                  </tr>
                                </thead>
                                <tbody>';
    if($gallery_count>0){
        $i = 0;
        foreach($gallery as $key => $gal){
            $i++;
            // contenteditable line 96 cái này có thể chỉnh sửa tên trực tiếp   
            //102 khi thực hiện class file_image thì nó sẽ lấy id của từng file mà thay đổi (file-'.$gal->gallery_id....vd file-1)
            $output.='

                 <tr>
                                     <td>'.$i.'</td>
                       
           <td contenteditable class="edit_gal_name" data-gal_id="'.$gal->gallery_id.'">'.$gal->gallery_name.'</td>
                                    <td>

                                    <img src="'.url('public/uploads/gallery/'.$gal->gallery_image).'" class="img-thumbnail" width="120" height="120">

                              

                                    </td>
                                    <td>
                                        <button type="button" data-gal_id="'.$gal->gallery_id.'" class="btn btn-xs btn-danger delete-gallery">Xóa</button>
                                    </td>
                                  </tr>
                                

            ';
        }
    }else{ 
        $output.='
                 <tr>
                                    <td colspan="4">Sản phẩm chưa thư viện ảnh</td>
                                   
                                  </tr>


            ';

    }
    $output.='
                 </tbody>
                 </table>
                 </form>


            ';
    echo $output;
}
}
