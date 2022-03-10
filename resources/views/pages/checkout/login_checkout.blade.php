@extends('layout')
@section('content')

	<section style="height: 500px" id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2 class="m">Đăng nhập </h2>
						<form action="{{URL::to('/login-customer')}}" method="POST">
							{{csrf_field()}}
							<input type="text" name="email_account" placeholder="Tài khoản" />
							<input type="password" name="password_account" placeholder="Password" />
							
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
						<style type="text/css">

							ul.list-login {
							    margin: 10px;
							    padding: 0;
							}
							ul.list-login li {
							    display: inline;
							    margin: 5px;
							}
							
						</style>

						<ul class="list-login">

							
							<li>
								<a href="{{url('login-facebook-customer')}}">
									<img width="10%" alt="Đăng nhập bằng tài khoản facebook"  src="{{asset('public/frontend/images/fb.png')}}">
								</a>
							</li>
						</ul>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2 class="m">Đăng ký</h2>
						<form action="{{URL::to('/add-customer')}}" method="POST">
							{{ csrf_field() }}
							<input type="text" name="customer_name" placeholder="Họ và tên"/>
							<input type="email" name="customer_email" placeholder="Địa chỉ email"/>
							<input type="password" name="customer_password" placeholder="Mật khẩu"/>
							<input type="text" name="customer_phone" placeholder="Phone"/>
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
		<style>
			h2.m{
				text-align: center;
    font-weight: normal;
    font-size: 24px;
			}
		</style>
	</section><!--/form-->
	@include('elements.footer')
@endsection