<section class="section" id="our-classes">
        <div style="    transform: translateX(66px)" class="container">
            <div class="row">
              <div class="col-lg-3"></div>
                <div class="col-lg-6 ">
                    <div style="margin-top: 59px;
    margin-bottom: 1px;" class="section-heading">
                        <h2 style="font-family: none; font-size:40px">Bài viết <em style="font-family: monospace;">của chúng tôi</em></h2>
                        <img src="{{asset('public/frontend/images/l.png')}}" alt="">
                        
                        
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
            <div class="row" style="transform: translateY(78px);" id="tabs">
              <style>
            
                .col-lg-4  ul li a img{
                 transform: translateY(-6px);
                 width: 27%;
                                }
                  
              </style>
              <div class="col-lg-4">
                <ul>
                  <li><a style=" font-size: 12px; height: 100px;    padding: 11px 30px;" href='#tabs-1'><img  src="{{asset('public/frontend/images/ic4.jpg')}}" alt="">Thông tin ưu đãi</a></li>
                  <li><a style=" font-size: 12px; height: 100px;    padding: 11px 30px;" href='#tabs-2'><img src="{{asset('public/frontend/images/ic1.jpg')}}" alt="">Công đoạn chuẩn bị</a></a></li>
                  <li><a style=" font-size: 12px; height: 100px;    padding: 11px 30px;" href='#tabs-3'><img src="{{asset('public/frontend/images/ic7.jpg')}}" alt=""> Trải ngiệm của khách</a></a></li>
                 
                  <div class="main-rounded-button"><a href="#">Xem tất cả bài viết</a></div>
                </ul>
              </div>
              <div class="col-lg-8">
                <section class='tabs-content'>
                <article id='tabs-1'>
                    <img style="width:80%; height: 380px;" src="{{asset('public/frontend/images/cf4.jpg')}}" alt="Third Class">
                    <h4>Thông tin ưu đãi</h4>
                    <p style=" width:80%">Các ưu đãi của shop sẽ đến với khách hàng thường xuyên hơn và đặc biết các chương trình khuyến mãi các mã giảm giá luôn được cập nhập...</p>
                    <div class="main-button">
                        <a href="{{URL::to('/danh-muc-bai-viet/'.'thong-tin-uu-dai')}}">Xem bài viết</a>
                    </div>
                  </article>
                  <article id='tabs-2'>
                    <img style="width:80%; height: 380px;" src="{{asset('public/frontend/images/cf1.jpg')}}" alt="First Class">
                    <h4>Công đoạn chuẩn bị</h4>
                    <p style=" width:80%">Rang theo kiểu máy rang hiện đại: sử dụng những kỹ thuật máy móc hiện đại để có thể canh chỉnh thời gian mang đến chất lượng đồng đều nhau trong từng mẻ rang.
                    </p>
                    <div class="main-button">
                        <a href="{{URL::to('/danh-muc-bai-viet/'.'cong-doan-chuan-bi')}}">Xem bài viết</a>
                    </div>
                  </article>
                  <article id='tabs-3'>
                    <img style="width:80%; height: 380px;" src="{{asset('public/frontend/images/cf2.jpg')}}" alt="Second Training">
                    <h4>Trải ngiệm của khách</h4>
                    <p style=" width:80%">Trải nghiệm khách hàng là toàn bộ quá trình tương tác giữa thực khách với mọi điểm chạm thương hiệu khi sử dụng dịch vụ tại quán của bạn.</p>
                    <div class="main-button">
                        <a href="{{URL::to('/danh-muc-bai-viet/'.'trai-nghiem-cua-khach')}}">Xem bài viết</a>
                    </div>
                  </article>
                
                
                </section>
              </div>
            </div>
        </div>
    </section>