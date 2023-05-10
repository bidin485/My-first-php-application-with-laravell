<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <title>
        Hostel Management System
    </title>

    <!-- Stylesheets -->
    <!-- Dropdown Menu -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/superfish.css">
    <!-- Owl Slider -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/owl.theme.default.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/bootstrap-datepicker.min.css">
    <!-- CS Select -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/cs-select.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/cs-skin-border.css">

    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/themify-icons.css">
    <!-- Flat Icon -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/flaticon.css">
    <!-- Icomoon -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/icomoon.css">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/flexslider.css">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/style.css">
    <!-- CSS Files -->
    {{-- <link id="pagestyle" href="{{ asset('assets') }}/css/material-dashboard.css?v=3.0.0" rel="stylesheet" /> --}}

    <!-- Modernizr JS -->
    <script src="{{ asset('assets') }}/landing_page/js/modernizr-2.6.2.min.js"></script>

</head>

<body>
    @if (Session::has('flash_message'))
        <div class="position-fixed top-1 center z-index-3">
            <div class="toast fade p-2 bg-white show" role="alert" aria-live="assertive" id="successToast"
                aria-atomic="true">
                <div class="toast-header border-0">
                    <i class="material-icons text-success me-2">
                        check
                    </i>
                    <span class="me-auto font-weight-bold">Elite Hostel</span>
                    <small class="text-body">Just Now</small>
                    <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
                </div>
                <hr class="horizontal dark m-0">
                <div class="toast-body">
                    {{ Session::get('flash_message') }}
                </div>
            </div>
        </div>
    @endif
    <div id="fh5co-wrapper">
        <div id="fh5co-page">
            <div id="fh5co-header">
                <header id="fh5co-header-section">
                    <div class="container">
                        <div class="nav-header">
                            <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
                            <h1 id="fh5co-logo"><a href="index.html">Hostel</a></h1>
                            <nav id="fh5co-menu-wrap" role="navigation">
                                <ul class="sf-menu" id="fh5co-primary-menu">
                                    <li><a class="active" href="{{ url('/landing') }}">Home</a></li>
                                    <li>
                                        <a href="{{ url('/sign-up') }}" class="fh5co-sub-ddown">Sign Up</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/sign-in') }}" class="fh5co-sub-ddown">Sign In</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/sign-in') }}" class="fh5co-sub-ddown">
                                            <span
                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign
                                                Out</span></a>
                                    </li>
                                    <li><a href="services.html">Facilities</a></li>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="#footer">Contact</a></li>
                                </ul>
                            </nav>
                            <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                                @csrf
                            </form>
                        </div>
                    </div>
                </header>

            </div>
            <!-- end:fh5co-header -->
            <aside id="fh5co-hero" class="js-fullheight">
                <div class="flexslider js-fullheight">
                    <ul class="slides">
                        @foreach ($categories as $category)
                            @if ($category->room_type != 'Unassigned')
                                <li style="background-image: url('{{ asset($category->room_type_photo) }}');">
                                    <div class="overlay-gradient"></div>
                                    <div class="container">
                                        <div class="col-md-12 col-md-offset-0 text-center slider-text">
                                            <div class="slider-text-inner js-fullheight">
                                                <div class="desc">
                                                    <p><span>{{ $category->room_type }}</span></p>
                                                    <p>UGX <span>{{ $category->room_price }}</span></p>
                                                    <h2>{{ $category->room_description }}</h2>
                                                    <p>
                                                        <a href="#" class="btn btn-primary btn-lg">Book Now</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach

                    </ul>
                </div>
            </aside>

            <div id="featured-hotel" class="fh5co-bg-color">
                <div class="container">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-center">
                                <h2>Featured Rooms</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="">
                            @foreach ($rooms as $room)
                                <div class="feature-full-1col">
                                    <div class="image"
                                        style="background-image: url('{{ asset($room->hostelRoomType->room_type_photo) }}');">
                                        <div class="descrip text-center">
                                            <p><small>For as low
                                                    as</small><span>{{ $room->hostelRoomType->room_price }}</span></p>
                                        </div>
                                    </div>
                                    <div class="desc">
                                        {{-- <h3>{{$room->hostelRoomType->room_type}}</h3> --}}
                                        <h3>{{ $room->room_number }}</h3>
                                        <h3>{{ $room->hostelRoomType->room_type }}</h3>
                                        <p>{{ $room->floor_level }}</p>
                                        <p>{{ $room->hostelRoomType->room_description }}
                                        </p>
                                        <p><a href="{{ route('guestBooking.create', $room->id) }}"
                                                class="btn btn-primary btn-luxe-primary">Book Now <i
                                                    class="ti-angle-right"></i></a></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="hotel-facilities">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <h2>Hostel Facilities</h2>
                        </div>
                    </div>
                </div>

                <div id="tabs">
                    <nav class="tabs-nav">
                        @php
                            $active = false;
                        @endphp
                        @foreach ($facilities as $facility)
                            <a href="#" class="{{ !$active ? ' active' : '' }}"
                                data-tab="{{ $facility->Facility_Name }}">
                                @php
                                    $active = true; // set $active to true after the first non-Unassigned category is found
                                @endphp
                                <span>{{ $facility->Facility_Name }}</span>
                            </a>
                        @endforeach
                    </nav>
                    <div class="tab-content-container">
                        @php
                            $active = false;
                        @endphp
                        @foreach ($facilities as $facility)
                            <div class="tab-content {{ !$active ? ' active show' : '' }}"
                                data-tab-content="{{ $facility->Facility_Name }}">
                                @php
                                    $active = true;
                                @endphp
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="{{ asset($facility->facility_photo) }}" class="img-responsive"
                                                alt="{{ $facility->Facility_Name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <span class="super-heading-sm">Amazing</span>
                                            <h3 class="heading">{{ $facility->Facility_Name }}</h3>
                                            <p>{{ $facility->Description }}</p>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div id="testimonial">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <h2>Happy Customer Says...</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="testimony">
                            <blockquote>
                                &ldquo;If you’re looking for a top quality hostel look no further.Thanks so much for
                                the service&rdquo;
                            </blockquote>
                            <p class="author"><cite>John Doe</cite></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="testimony">
                            <blockquote>
                                &ldquo;My friend and I had a delightful weekend get away here, the staff were so
                                friendly and attentive. Highly Recommended&rdquo;
                            </blockquote>
                            <p class="author"><cite>Rob Smith</cite></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="testimony">
                            <blockquote>
                                &ldquo;If you’re looking for a top quality hostel look no further.Thanks so much for
                                the service&rdquo;
                            </blockquote>
                            <p class="author"><cite>Jane Doe</cite></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer id="footer" class="fh5co-bg-color">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="copyright">
                            <p><small>Designed by <a href="" target="_blank">GROUP ONE</a></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3">
                                <h3>Company</h3>
                                <ul class="link">
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Hotels</a></li>
                                    <li><a href="#">Customer Care</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <h3>Our Facilities</h3>
                                <ul class="link">
                                    @foreach ($facilities as $facility)
                                        <li><a href="#">{{ $facility->Facility_Name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h3>Subscribe</h3>
                                <p>Subscribe to our newsletter </p>
                                <form action="#" id="form-subscribe">
                                    <div class="form-field">
                                        <input type="email" placeholder="Email Address" id="email">
                                        <input type="submit" id="submit" value="Send">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <ul class="social-icons">
                            <li>
                                <a href="#"><i class="icon-twitter-with-circle"></i></a>
                                <a href="#"><i class="icon-facebook-with-circle"></i></a>
                                <a href="#"><i class="icon-instagram-with-circle"></i></a>
                                <a href="#"><i class="icon-linkedin-with-circle"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <!-- END fh5co-page -->

    </div>
    <!-- END fh5co-wrapper -->

    <!-- Javascripts -->
    <script src="{{ asset('assets') }}/landing_page/js/jquery-2.1.4.min.js"></script>
    <!-- Dropdown Menu -->
    <script src="{{ asset('assets') }}/landing_page/js/hoverIntent.js"></script>
    <script src="{{ asset('assets') }}/landing_page/js/superfish.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets') }}/landing_page/js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="{{ asset('assets') }}/landing_page/js/jquery.waypoints.min.js"></script>
    <!-- Counters -->
    <script src="{{ asset('assets') }}/landing_page/js/jquery.countTo.js"></script>
    <!-- Stellar Parallax -->
    <script src="{{ asset('assets') }}/landing_page/js/jquery.stellar.min.js"></script>
    <!-- Owl Slider -->
    <!-- // <script src="{{ asset('assets') }}/landing_page/js/owl.carousel.min.js"></script> -->
    <!-- Date Picker -->
    <script src="{{ asset('assets') }}/landing_page/js/bootstrap-datepicker.min.js"></script>
    <!-- CS Select -->
    <script src="{{ asset('assets') }}/landing_page/js/classie.js"></script>
    <script src="{{ asset('assets') }}/landing_page/js/selectFx.js"></script>
    <!-- Flexslider -->
    <script src="{{ asset('assets') }}/landing_page/js/jquery.flexslider-min.js"></script>

    <script src="{{ asset('assets') }}/landing_page/js/custom.js"></script>

</body>

</html>
