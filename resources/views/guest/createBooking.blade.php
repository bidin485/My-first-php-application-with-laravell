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
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Add Hostel Booking Details</h2>
                        <form method="POST"
                            action="{{ route('guestBooking.create', ['category' => $hostelRoom->hostelRoomType->id, 'id' => $hostelRoom->id]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="room_number">Room Number</label>
                                        <input type="text" name="room_number" class="form-control"
                                            value="{{ $hostelRoom->room_number }}" disabled>
                                        <input type="hidden" name="room_number"
                                            value="{{ $hostelRoom->room_number }}">
                                        @error('room_number')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="bed_space">Bed Space</label>
                                        <input type="number" name="bed_space" class="form-control" min="1"
                                            max="{{ $hostelRoom->hostelRoomType->room_capacity }}" value="1">
                                    </div>
                                    @error('bed_space')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" class="form-control">
                                        @error('first_name')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" class="form-control">
                                        @error('last_name')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" name="phone_number" class="form-control">
                                        @error('phone_number')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ auth()->user()->email }}">
                                        @error('email')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="check_in_date">Check In Date</label>
                                        <input type="date" name="check_in_date" class="form-control"
                                            id="check-in-date">
                                        @error('check_in_date')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="check_out_date">Check Out Date</label>
                                        <input type="date" name="check_out_date" class="form-control"
                                            id="check-out-date">
                                        @error('check_out_date')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount_paid">Amount Paid</label>
                                        <input type="number" name="amount_paid" class="form-control" min="0"
                                            max="{{ $hostelRoom->hostelRoomType->room_price }}"
                                            placeholder="max value: {{ $hostelRoom->hostelRoomType->room_price }}"
                                            id="amount_paid" oninput="calculateBalance()">
                                        @error('amount_paid')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Balance</label>
                                        <input type="number" name="balance" class="form-control" id="balance"
                                            min="0" max="{{ $hostelRoom->hostelRoomType->room_price }}"
                                            disabled>
                                        <input type="hidden" name="balance" class="form-control" id="balance2">
                                        @error('balance')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
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
        //Update the dates
        const checkInDateInput = document.querySelector('#check-in-date');
        const checkOutDateInput = document.querySelector('#check-out-date');

        checkInDateInput.addEventListener('change', () => {
            const checkInDate = new Date(checkInDateInput.value);
            const checkOutDate = new Date(checkInDate.getFullYear(), checkInDate.getMonth() + 1, checkInDate
                .getDate());
            checkOutDateInput.value = checkOutDate.toISOString().split('T')[0];
        });

        function calculateBalance() {
            const amountPaid = document.getElementById("amount_paid").value;
            const maxAmount = {{ $hostelRoom->hostelRoomType->room_price }};
            const balance = maxAmount - amountPaid;
            document.getElementById("balance").value = balance;
            document.getElementById("balance2").value = balance;
        }
    </script>

</body>

</html>
