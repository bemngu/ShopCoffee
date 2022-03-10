@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
			<style type="text/css">
				p.title_thongke {
				    text-align: center;
				    font-size: 20px;
				    font-weight: bold;
				}
			</style>


<style>
	tbody tr td{
	text-align:center;	
	}
	thead tr th{
	text-align:center;	
	}
</style>

<div class="row">
<div class="col-md-3 col-xs-12">
			
	</div>
	<div class="col-md-6 col-xs-12">
		<p class="title_thongke">THỐNG KÊ TỔNG SỐ DANH MỤC</p>
		<div id="donut"></div>	
	</div>
	<div class="col-md-3 col-xs-12">
			
			</div>
</div>
<div class="row">


	<div class="col-md-6 col-xs-12">
		<h3 style="font-size: 20px;
    text-align: center;
    font-weight: bolder;
    margin-top: 6px;">BÀI VIẾT XEM NHIỀU</h3>

		<ol style="margin-top:33px;    border: 2px solid #372121;
    padding-top: 27px;
    padding-bottom: 18px;" class="list_views">
			@foreach($post_views as $key => $post)
			<li style="font-size:15px">
				<a style="color:white;font-size: 15px;
    font-family: auto;" target="_blank" href="{{url('/bai-viet/'.$post->post_slug)}}">{{$post->post_title}} => <span style="color:black">{{$post->post_views}}</span></a>
			</li>
			@endforeach
		</ol>
		
	</div>

	<div class="col-md-6 col-xs-12">
		<style type="text/css">
			ol.list_views {
			    margin: 10px 0;
			    color: #fff;
			}
			ol.list_views a {
			    color: orange;
			    font-weight: 400;
			}
		</style>
		<h3 style="font-size: 20px;
    text-align: center;
    font-weight: bolder;
    margin-top: 6px;">SẢN PHẨM XEM NHIỀU</h3>

		<ol style="margin-top:33px;    border: 2px solid #372121;
    padding-top: 27px;
    padding-bottom: 18px;" class="list_views">
			@foreach($product_views as $key => $pro)
			<li  style="font-size:15px">
				<a style="color:white;font-size: 15px;
    font-family: auto;" target="_blank" href="{{url('/chi-tiet/'.$pro->product_slug)}}">{{$pro->product_name}} | <span style="color:black">{{$pro->product_views}}</span></a>
			</li>
			@endforeach
		</ol>

	</div>
	</div>

</div>

@endsection