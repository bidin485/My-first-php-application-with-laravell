<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="bed"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Create bed'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('{{ asset('assets') }}/img/hostel-rooms/hostel-1.jpg');"> <span
                    class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Add bed Details</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        @if (session('status'))
                            <div class="row">
                                <div class="alert alert-success alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('status') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if (Session::has('demo'))
                            <div class="row">
                                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('demo') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <form method='POST' action='{{ route('bed.create') }}'>
                            @csrf
                            <div class="row">

                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Bed Number</label>
                                    <input type="text" name="bed_number" class="form-control border border-2 p-2"
                                        placeholder="e.g. BE7">
                                    @error('bed_number')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Availability</label>
                                    <div class="form-control">
                                        <div class="form-check form-check-inline p-2">
                                            <input class="form-check-input" type="radio" name="availability"
                                                value="vacant" checked>
                                            <label class="form-check-label">Vacant</label>
                                        </div>
                                        <div class="form-check form-check-inline p-2">
                                            <input class="form-check-input" type="radio" name="availability"
                                                value="occupied" disabled>
                                            <label class="form-check-label">Occupied</label>
                                        </div>
                                    </div>
                                    @error('availability')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="form-inline mb-3 col-md-9">
                                    <label class="my-1 mr-2">Room Number</label>
                                    <select class="form-control custom-select border border-2 p-2 my-1 mr-sm-2"
                                        name="room_number">
                                        @foreach ($hostelRooms as $hostelRoom)
                                            <option>{{ $hostelRoom->room_number }}</option>
                                        @endforeach
                                    </select>
                                    @error('room_number')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>

</x-layout>
