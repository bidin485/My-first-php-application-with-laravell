<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="facilities"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Facilities'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('{{ asset('assets') }}/img/facilities/facility.jpg'); background-size: cover;"> <span
                    class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Add facility Details</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                         <form method='POST'
                            {{-- action="{{ $hostelRoomType == null || $hostelRoomType->id == null ? route('hostel-rooms.create') : route('hostel-room-categories.category_store', $hostelRoomType->id) }}"> --}}
                            action="{{ route('hostel-rooms.create') }}">

                            @csrf
                            <div class="row">

                                <div class="mb-3 col-md-9">
                                    <label class="form-label fs-5 text-dark">Facility Id</label>
                                    <input type="text" placeholder="eg.200" name="facility_id"
                                        class="form-control border border-2 p-2">
                                    {{-- @error('room_number')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror --}}
                                </div>
                                <div class="form-inline mb-3 col-md-9">
                                    <label class="my-1 mr-2 fs-5 text-dark">Facility Name</label>
                                    <select class="form-control custom-select border border-2 p-2 my-1 mr-sm-2"
                                        name="floor_level">
                                        <option>Gym</option>
                                        <option>Swimming Pool</option>
                                        <option>water</option>
                                        <option>Canteen</option>
                                        <option>Veichle</option>
                                    </select>
                                    {{-- need to find out wat was done here --}}
                                    @error('floor_level')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                 <div class="mb-3 col-md-9">
                                    <label class="form-label d-block fs-5 text-dark">Description</label>
                                    <textarea class=" p-2 form-control border" placeholder="Leave a description here" style="resize: none" name="facility_description" id="" rows="10"></textarea>
                                 </div>
                                   {{-- <div class="form-control">
                                        @if ($hostelRoomType == null || $hostelRoomType->id == null)
                                            @foreach ($hostelRoomTypes as $hostel_room_type)
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" type="radio" name="room_type"
                                                        value="{{ $hostel_room_type->room_type }}">
                                                    <label
                                                        class="form-check-label">{{ $hostel_room_type->room_type }}</label>
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach ($hostelRoomTypes as $hostel_room_type)
                                                <div class="form-check form-check-inline p-2">
                                                    @if ($hostelRoomType->room_type == $hostel_room_type->room_type)
                                                        <input class="form-check-input mt-2" type="radio"
                                                            name="room_type" value="{{ $hostel_room_type->room_type }}"
                                                            checked>
                                                    @elseif ($hostelRoomType->room_type == null)
                                                        <input class="form-check-input mt-2" type="radio"
                                                            name="room_type" value="{{ $hostel_room_type->room_type }}">
                                                    @else
                                                        <input class="form-check-input mt-2" type="radio"
                                                            name="room_type" value="{{ $hostel_room_type->room_type }}"
                                                            disabled>
                                                    @endif
                                                    <label
                                                        class="form-check-label me-4 mt-2">{{ $hostel_room_type->room_type }}</label>
                                                </div>
                                            @endforeach
                                         @endif 
                                    </div> 
                                    @error('room_type')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror 
                                
                                    Do not need this to 
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Bed Space</label>
                                    <div class="form-control">
                                        <div class="form-check form-check-inline p-2">
                                            <input class="form-check-input" type="radio" name="bed_space"
                                                value="1">
                                            <label class="form-check-label">One</label>
                                        </div>
                                        <div class="form-check form-check-inline p-2">
                                            <input class="form-check-input" type="radio" name="bed_space"
                                                value="2">
                                            <label class="form-check-label">Two</label>
                                        </div>
                                        <div class="form-check form-check-inline p-2">
                                            <input class="form-check-input" type="radio" name="bed_space"
                                                value="None">
                                            <label class="form-check-label">None</label>
                                        </div>
                                    </div>
                                    @error('bed_space')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div> --}}
                                <div class="mb-3 col-md-9">
                                    <label class="form-label fs-5 text-dark">Availability</label>
                                    <div class="form-control">
                                        <div class="form-check form-check-inline p-2">
                                            <input class="form-check-input" type="radio" name="status"
                                                value="Available" checked>
                                            <label class="form-check-label">available</label>
                                        </div>
                                        <div class="form-check form-check-inline p-2">
                                            <input class="form-check-input" type="radio" name="status"
                                                value="Occupied" disabled>
                                            <label class="form-check-label">not available</label>
                                        </div>
                                        <div class="form-check form-check-inline p-2">
                                            <input class="form-check-input" type="radio" name="status"
                                                value="Under Renovation">
                                            <label class="form-check-label">Under Maintainance</label>
                                        </div>
                                    </div>
                                    @error('status')
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
