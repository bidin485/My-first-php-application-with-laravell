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
                    {{-- Beggining the real form fields here  --}}
                    <div class="card-body p-3">
                         <form method='POST'
                            {{-- action="{{ $hostelRoomType == null || $hostelRoomType->id == null ? route('hostel-rooms.create') : route('hostel-room-categories.category_store', $hostelRoomType->id) }}"> --}}
                            action="{{ route('facilities.store') }}">

                            @csrf
                            <div class="row">

                                <div class="mb-3 col-md-9">
                                    <label class="form-label fs-5 text-dark">Facility Id</label>
                                    <input type="text" placeholder="eg.200" name="facility_id"
                                        class="form-control border border-2 p-2">
                                        {{-- Display the error message incase the id is not input --}}
                                     {{-- @error('id')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror  --}}

                                </div>
                                <div class="form-inline mb-3 col-md-9">
                                    <label class="my-1 mr-2 fs-5 text-dark">Facility Name</label>
                                    <select class="form-control custom-select border border-2 p-2 my-1 mr-sm-2"
                                        name="facility_name">
                                        <option>Gym</option>
                                        <option>Swimming Pool</option>
                                        <option>water</option>
                                        <option>Canteen</option>
                                        <option>Veichle</option>
                                    </select>
                                    {{-- Display error message incase the facility name is not included--}}
                                    {{-- @error('facility_name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror --}}
                                </div>

                                 <div class="mb-3 col-md-9">
                                    <label class="form-label d-block fs-5 text-dark">Description</label>
                                    <textarea class=" p-2 form-control border" placeholder="Leave a description here" style="resize: none" name="facility_description" id="" rows="10"></textarea>
                                 </div>
                                   
                                 
                                {{-- end of the form input field to be used to enter the data --}}
                                <div class="mb-3 col-md-9">
                                    <label class="form-label fs-5 text-dark">Availability</label>
                                    <div class="form-control">
                                        <div class="form-check form-check-inline p-2">
                                            <input class="form-check-input" type="radio" name="availability"
                                                value="Available" checked>
                                            <label class="form-check-label">available</label>
                                        </div>
                                        <div class="form-check form-check-inline p-2">
                                            <input class="form-check-input" type="radio" name="availability"
                                                value="Occupied" disabled>
                                            <label class="form-check-label">not available</label>
                                        </div>
                                        <div class="form-check form-check-inline p-2">
                                            <input class="form-check-input" type="radio" name="availability"
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
