<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header mb-4">
                        <i class="fas fa-user-plus mr-1"></i>
                        Please fill out the form to add a new member of staff.
                    </div>
                <div class="row">
                    <div class="col-sm-6">
                        <form action="{{route('staff.store')}}" method="post" class="form-horizontal">
                            @csrf
                            <div class="card border border-dark mb-1">
                                <div class="card-header bg-dark text-white">Contact Details</div>
                                <div class="card-body py-1">
                                    <div class="form-group row">
                                        <label for="forename" class="col-form-label col-sm-4">Forename</label>
                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class="form-control @error('forename') is-invalid @enderror"
                                                   name="forename" id="forename" aria-describedby="helpId"
                                                   placeholder="Enter Forename">
                                            @error('forename')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="surname" class="col-form-label col-sm-4">Surname</label>
                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class="form-control @error('surname') is-invalid @enderror"
                                                   name="surname" id="surname" aria-describedby="helpId"
                                                   placeholder="Enter Surname">
                                            @error('surname')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="telephone" class="col-form-label col-sm-4">Telephone</label>
                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class="form-control @error('telephone') is-invalid @enderror"
                                                   name="telephone" id="telephone" aria-describedby="helpId"
                                                   placeholder="Enter Telephone">
                                            @error('telephone')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-form-label col-sm-4">Email</label>
                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" id="email" aria-describedby="helpId"
                                                   placeholder="Enter Email">
                                            @error('email')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card border border-dark mb-1">
                                <div class="card-header bg-dark text-white">Location Details</div>

                                <div class="card-body py-1">
                                    <div class="form-group row">
                                        <label for="address" class="col-form-label col-sm-4">Address</label>
                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class="form-control @error('address') is-invalid @enderror"
                                                   name="address" id="address" aria-describedby="helpId"
                                                   placeholder="Enter Street Address">
                                            @error('address')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="townCity" class="col-form-label col-sm-4">Town / City</label>
                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class="form-control @error('townCity') is-invalid @enderror"
                                                   name="townCity" id="townCity" aria-describedby="helpId"
                                                   placeholder="Enter Town/City">
                                            @error('townCity')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="county" class="col-form-label col-sm-4">County</label>
                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class="form-control @error('county') is-invalid @enderror"
                                                   name="county" id="county" aria-describedby="helpId"
                                                   placeholder="Enter County">
                                            @error('county')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="postCode" class="col-form-label col-sm-4">Post Code</label>
                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class="form-control @error('postCode') is-invalid @enderror"
                                                   name="postCode" id="postCode" aria-describedby="helpId"
                                                   placeholder="Enter Post-Code">
                                            @error('postCode')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card border border-dark mb-1">
                            <div class="card-header bg-dark text-white">Emergency Details</div>
                            <div class="card-body py-1">
                                <div class="form-group row">
                                    <label for="who" class="col-form-label col-sm-4">N.O.K Name</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('who') is-invalid @enderror"
                                               name="who" id="who" aria-describedby="helpId"
                                               placeholder="Next Of Kin Name">
                                        @error('who')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="contactnumber" class="col-form-label col-sm-4">Contact Number</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('contactnumber') is-invalid @enderror"
                                               name="contactnumber" id="contactnumber" aria-describedby="helpId"
                                               placeholder="Enter Contact Information">
                                        @error('contactnumber')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border border-dark mb-1">
                            <div class="card-header bg-dark text-white">Employment Details</div>

                            <div class="card-body py-1">
                                <div class="form-group row">
                                    <label for="ninumber" class="col-form-label col-sm-4">NI
                                        Number</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('ninumber') is-invalid @enderror"
                                               name="ninumber" id="ninumber" aria-describedby="helpId"
                                               placeholder="Enter National Insurance Number">
                                        @error('ninumber')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="personallicense" class="col-form-label col-sm-4">Personal
                                        License</label>
                                    <div class="col-sm-8">

                                        <select class="form-control" name="personallicense" id="personallicense">
                                            @foreach($personalLicense as $item)
                                                <option value="{{$item}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="employmenttype" class="col-form-label col-sm-4">Employment
                                        Type</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="employmenttype" id="employmenttype">
                                            @foreach($employmentType as $item)
                                                <option value="{{$item}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="hotel_id" class="col-form-label col-sm-4">Hotel</label>
                                    <div class="col-sm-8">

                                        <select class="form-control" name="hotel_id" id="hotel_id">
                                            @foreach($hotels as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-form-label col-sm-4">Status</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="status" id="status">
                                            @foreach($status as $item)
                                                <option value="{{$item}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="holidaysleft" class="col-form-label col-sm-4">Holidays
                                        Left: </label>
                                    <div class="col-sm-8">
                                        <input type="number"
                                               class="form-control @error('holidaysleft') is-invalid @enderror"
                                               name="holidaysleft" id="holidaysleft" aria-describedby="helpId"
                                               placeholder="Holiday days left to take"
                                               value="28">
                                        @error('holidaysleft')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Add Staff Member
                        </button>
                    </div>
                    </form>
                </div>
        </div>


    @endsection
</x-admin-master>
