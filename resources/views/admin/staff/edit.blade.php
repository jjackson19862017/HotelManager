<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header mb-4">
                        <i class="fas fa-user-plus mr-1"></i>
                        Editing {{$staff->forename}}
                    </div>
                <div class="row">
                    <div class="col-sm-6">
                        <form action="{{route('staff.update', $staff->id)}}" method="post" class="form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="card border border-dark mb-1">
                                <div class="card-header bg-dark text-white">Contact Details</div>
                                <div class="card-body py-1">
                                    <div class="form-group row">
                                        <label for="forename" class="col-form-label col-sm-4">Forename</label>
                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class="form-control @error('forename') is-invalid @enderror"
                                                   name="forename" id="forename" aria-describedby="helpId"
                                                   value="{{$staff->forename}}">
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
                                                   value="{{$staff->surname}}">
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
                                                   value="{{$staff->telephone}}">
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
                                                   value="{{$staff->email}}">
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
                                                   value="{{$staff->address}}">
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
                                                   value="{{$staff->townCity}}">
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
                                                   value="{{$staff->county}}">
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
                                                   value="{{$staff->postCode}}">
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
                                               value="{{$staff->who}}">
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
                                               value="{{$staff->contactnumber}}">
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
                                               value="{{$staff->ninumber}}">
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
                                            @if($staff->personallicense=='check')
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            @else
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="employmenttype" class="col-form-label col-sm-4">Employment
                                        Type</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="employmenttype" id="employmenttype">
                                            <option value="{{$staff->employmenttype}}">{{$staff->employmenttype}}</option>
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
                                            <option value="{{$staff->hotel->id}}">{{$staff->hotel->name}}</option>

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
                                            <option value="{{$staff->status}}">{{$staff->status}}</option>
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
                                               value="{{$staff->holidaysleft}}">
                                        @error('holidaysleft')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Update {{$staff->forename}}
                        </button>
                    </div>
                    </form>
                </div>
        </div>


    @endsection
</x-admin-master>
