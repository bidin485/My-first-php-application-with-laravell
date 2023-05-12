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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        <div class="position-fixed bottom-0 start-50 translate-middle-x mt-3" style="z-index: 11">
            <div id="successToast" class="toast align-items-center text-white bg-success border-0 show" role="alert"
                aria-live="assertive" aria-atomic="true" style="min-height: 60px">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ Session::get('flash_message') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div id="fh5co-wrapper">
        <div id="fh5co-page">
            <header id="fh5co-header-section"
                style="background-color: #434A50; position: fixed; top: 0; z-index: 999; width: 100%;">
                <div class="container">
                    @if (auth()->check())
                        <h1 id="fh5co-logo"><a href="{{ url('/guest') }}">Ideal Hostel</a></h1>
                    @else
                        <h1 id="fh5co-logo"><a href="{{ url('/home') }}">Ideal Hostel</a></h1>
                    @endif
                    <nav id="fh5co-menu-wrap" role="navigation">
                        <ul class="sf-menu" id="fh5co-primary-menu">
                            @if (auth()->check())
                                <li><a class="active" href="{{ url('/guest') }}">Home</a></li>
                                <li><a href={{ route('guestBookings') }}>View Bookings</a></li>
                            @else
                                <li><a class="active" href="{{ url('/home') }}">Home</a></li>
                            @endif

                            @if (auth()->check())
                                @if (auth()->user()->is_admin)
                                    <li>
                                        <a href="" class="fh5co-sub-ddown">Admin Actions</a>
                                        <ul class="fh5co-sub-menu">
                                            <li><a href="{{ route('hostel-room-categories') }}">Go to Dashboard</a>
                                            </li>
                                            <li>
                                                <a href="#" class="fh5co-sub-ddown">
                                                    <span
                                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign
                                                        Out</span>
                                                </a>
                                                <form method="POST" action="{{ route('logout') }}" id="logout-form"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="" class="fh5co-sub-ddown">Guest Actions</a>
                                        <ul class="fh5co-sub-menu">
                                            <li>
                                                <a href="#" class="fh5co-sub-ddown">
                                                    <span
                                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign
                                                        Out</span>
                                                </a>
                                                <form method="POST" action="{{ route('logout') }}" id="logout-form"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            @else
                                <li><a href="" class="fh5co-sub-ddown">Sign In / Sign Up</a>
                                    <ul class="fh5co-sub-menu">
                                        <li><a href="{{ url('/sign-in') }}">Sign In</a></li>
                                        <li>
                                            <a href="{{ url('/sign-up') }}" class="fh5co-sub-ddown">Sign Up</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </header>

            <!-- end:fh5co-header -->
            <div class="container" style="margin-top: 100px;">
                <div class="row">
                    @if (count($bookings) == 0)
                        <div class="container-fluid py-4 min-vh-100 d-flex justify-content-center align-items-center">
                            <div class="row">
                                <p class="text-7xl text-secondary">No Bookings Available</p>
                            </div>
                        </div>
                    @endif
                    <div class="container min-vh-100">
                        <h2>Bookings</h2>
                        <table class="table table-bordered table-hover table-centered">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Check-in Date</th>
                                    <th>Check-out Date</th>
                                    <th>Amount Paid</th>
                                    <th>Balance</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->id }}</td>
                                        <td>{{ $booking->check_in_date }}</td>
                                        <td>{{ $booking->check_out_date }}</td>
                                        <td>{{ $booking->amount_paid }}</td>
                                        <td>{{ $booking->balance }}</td>
                                        <td>
                                            <a href="{{ route('guestBooking.show', $booking->id) }}"
                                                class="btn btn-primary">View Receipt</a>
                                            <form method="POST"
                                                action="{{ route('guestBookings.destroy', $booking->id) }}"
                                                accept-charset="UTF-8" style="display:inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm(&quot;Confirm Cancel Booking?&quot;)">
                                                    CANCEL
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                                        {{-- @foreach ($facilities as $facility)
                            <li><a href="#">{{ $facility->Facility_Name }}</a></li>
                        @endforeach --}}
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        // get the toast element by its id
        const toast = document.querySelector('#successToast');

        // hide the toast after 5 seconds (5000 milliseconds)
        setTimeout(() => {
            toast.classList.remove('show');
        }, 5000);
    </script>

</body>

</html>
