@include('layout_user.menu')
<!-- BREADCRUMBS SECTION START -->
<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">Contact</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMBS SECTION END -->

<!-- Start page content -->
<section id="page-content" class="page-wrapper">

    <!-- ADDRESS SECTION START -->
    <div class="address-section mb-80">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <div class="contact-address box-shadow">
                        <i class="zmdi zmdi-pin"></i>
                        <h6>{{ $contactInfo->describe ?? 'No address available' }}</h6>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="contact-address box-shadow">
                        <i class="zmdi zmdi-phone"></i>
                        <h6>{{ $contactInfo->phone_number ?? 'No phone number available' }}</h6>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="contact-address box-shadow">
                        <i class="zmdi zmdi-email"></i>
                        <h6>{{ $contactInfo->email ?? 'No email available' }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ADDRESS SECTION END -->

    <!-- GOOGLE MAP SECTION START -->
    <div class="google-map-section">
        <div class="container-fluid">
            <div class="google-map plr-185">
                <!-- Thay thế div cũ bằng iframe Google Maps -->
                <iframe
                    src="{{$contactInfo->link_map}}"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <!-- GOOGLE MAP SECTION END -->

    <!-- MESSAGE BOX SECTION START -->
    <div class="message-box-section mt--50 mb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="message-box box-shadow white-bg">
                        <form method="post" action="{{ url('/guilienhe') }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="blog-section-title border-left mb-30">get in touch</h4>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="ht" placeholder="Your name here">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="em" placeholder="Your email here">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="subject" placeholder="Subject here">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="phone" placeholder="Your phone here">
                                </div>
                                <div class="col-md-12">

                                    <textarea name="nd" name="message" placeholder="Message"></textarea>
                                    @csrf
                                    <button class="submit-btn-1 mt-30 btn-hover-1" type="submit">submit message</button>
                                </div>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MESSAGE BOX SECTION END -->
</section>
<!-- End page content -->
@include('layout_user.footer')