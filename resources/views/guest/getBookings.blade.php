<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <div class="container-fluid px-2 px-md-4 col-md-8">
        <div class="row">
            @foreach ($bookings as $booking)
                <div class="col-md-4">
                    <div class="card mb-3 shadow">
                        <div class="card-body">
                            <h5 class="card-title">Booking Receipt</h5>
                            <p class="card-text">Thank you for your booking!</p>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="font-weight-bold mb-0">Booking ID:</p>
                                    <p class="text-muted">{{ $booking->id }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="font-weight-bold mb-0">Date:</p>
                                    <p class="text-muted">{{ $booking->created_at }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="font-weight-bold mb-0">Name:</p>
                                    <p class="text-muted">{{ $booking->first_name }} {{ $booking->last_name }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="font-weight-bold mb-0">Email:</p>
                                    <p class="text-muted">{{ $booking->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="font-weight-bold mb-0">Check-in Date:</p>
                                    <p class="text-muted">{{ $booking->check_in_date }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="font-weight-bold mb-0">Check-out Date:</p>
                                    <p class="text-muted">{{ $booking->check_out_date }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="font-weight-bold mb-0">Amount Paid:</p>
                                    <p class="text-muted">{{ $booking->amount_paid }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="font-weight-bold mb-0">Balance:</p>
                                    <p class="text-muted">{{ $booking->balance }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <form method="POST" action="{{ route('guestBookings.destroy', $booking->id) }}"
                                        accept-charset="UTF-8" style="display:inline">
                                        @method('DELETE')
                                        @csrf
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm(&quot;Confirm Cancel Booking?&quot;)">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <x-footers.auth></x-footers.auth>

</x-layout>
