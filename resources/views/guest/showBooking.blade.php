@extends('guest.layout')
@section('content')
    <header id="fh5co-header-section" style="background-color: #434A50; position: fixed; top: 0; z-index: 999; width: 100%;">
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
            <div class="container">
                <div class="card mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">Booking Receipt</h5>
                        <p class="card-text text-center">Thank you for your booking!</p>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Booking ID:</p>
                                <p class="text-muted text-center">{{ $booking->id }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Date:</p>
                                <p class="text-muted text-center">{{ $booking->created_at }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Name:</p>
                                <p class="text-muted text-center">{{ $booking->first_name }}
                                    {{ $booking->last_name }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Email:</p>
                                <p class="text-muted text-center">{{ $booking->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Check-in Date:</p>
                                <p class="text-muted text-center">{{ $booking->check_in_date }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Check-out Date:</p>
                                <p class="text-muted text-center">{{ $booking->check_out_date }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Amount Paid:</p>
                                <p class="text-muted text-center">{{ $booking->amount_paid }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Balance:</p>
                                <p class="text-muted text-center">{{ $booking->balance }}</p>
                            </div>
                        </div>
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
@endsection
