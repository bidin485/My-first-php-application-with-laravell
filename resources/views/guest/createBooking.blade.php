<x-layout bodyClass="g-sidenav-show bg-gray-200">


    <div class="container-fluid px-2 px-md-4 col-md-8">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('{{ asset('assets') }}/img/hostel-rooms/hostel-1.jpg');"> <span
                class="mask  bg-gradient-primary  opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n6">
            <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-3">Add Hostel Booking Details</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    @if (session('status'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ Session::get('status') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if (Session::has('demo'))
                        <div class="row">
                            <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ Session::get('demo') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <form method='POST'
                        action="{{ route('guestBooking.create', ['category' => $hostelRoom->hostelRoomType->id, 'id' => $hostelRoom->id]) }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-9">
                                <label class="form-label">Room Number</label>
                                <input type="text" name="room_number" class="form-control border border-2 p-2"
                                    value="{{ $hostelRoom->room_number }}" disabled>
                                @error('room_number')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="form-inline mb-3 col-md-9">
                                <label class="my-1 mr-2">Bed Number</label>
                                <select class="form-control custom-select border border-2 p-2 my-1 mr-sm-2"
                                    name="bed_number">
                                    @if (count($beds) > 0)
                                        @foreach ($beds as $bed)
                                            <option>{{ $bed->bed_number }}</option>
                                        @endforeach
                                    @else
                                        <option>Room Capacity is Full</option>
                                    @endif
                                </select>
                                @error('bed_number')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-9">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control border border-2 p-2">
                                @error('first_name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-9">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control border border-2 p-2">
                                @error('last_name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-9">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control border border-2 p-2">
                                @error('phone_number')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-9">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control border border-2 p-2"
                                    value="{{ auth()->user()->email }}">
                                @error('email')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-9">
                                <label class="form-label">Check In Date</label>
                                <input type="date" name="check_in_date" class="form-control border border-2 p-2"
                                    id="check-in-date">
                                @error('check_in_date')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-9">
                                <label class="form-label">Check Out Date</label>
                                <input type="date" name="check_out_date" class="form-control border border-2 p-2"
                                    id="check-out-date">
                                @error('check_out_date')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-9">
                                <label class="form-label">Amount Paid</label>
                                <input type="number" name="amount_paid" id="amount_paid"
                                    class="form-control border border-2 p-2" min="0"
                                    max="{{ $hostelRoom->hostelRoomType->room_price }}"
                                    placeholder="max value: {{ $hostelRoom->hostelRoomType->room_price }}"
                                    oninput="calculateBalance()">
                                @error('amount_paid')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-9">
                                <label class="form-label">Balance</label>
                                <input type="number" name="balance" id="balance"
                                    class="form-control border border-2 p-2">
                                @error('balance')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        @if (count($beds) > 0)
                            <button type="submit" class="btn bg-gradient-dark"
                                onclick="return confirm(&quot;Are you sure you want to complete the booking?&quot;)">Submit</button>
                        @else
                            <button type="submit" class="btn bg-gradient-dark" disabled>Submit</button>
                        @endif
                    </form>

                </div>
            </div>
        </div>

    </div>
    <x-footers.auth></x-footers.auth>
    @push('js')
        <script>
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
            }
        </script>
    @endpush
    </div>
    <x-plugins></x-plugins>

</x-layout>
