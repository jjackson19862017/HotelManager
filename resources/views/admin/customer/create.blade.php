<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header">
                        <i class="fas fa-user-plus mr-1"></i>
                        Please fill out the form to add a new couple.
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">

                            <div class="col-sm-6">
                                <form action="{{route('customer.store')}}" method="post" class="form-horizontal">
                                    @csrf
                                    <div class="card border border-dark mb-1">
                                        <div class="card-header bg-dark text-white">Couple</div>
                                        <div class="card-body py-1">
                                            <div class="form-group row">
                                                <label for="brideforename" class="col-form-label col-sm-4">Brides
                                                    Forename</label>
                                                <div class="col-sm-8">
                                                    <input type="text"
                                                           class="form-control @error('brideforename') is-invalid @enderror"
                                                           name="brideforename" id="brideforename"
                                                           aria-describedby="helpId"
                                                           placeholder="Enter Forename">
                                                    @error('brideforename')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="bridesurname" class="col-form-label col-sm-4">Brides
                                                    Surname</label>
                                                <div class="col-sm-8">
                                                    <input type="text"
                                                           class="form-control @error('bridesurname') is-invalid @enderror"
                                                           name="bridesurname" id="bridesurname"
                                                           aria-describedby="helpId"
                                                           placeholder="Enter Surname">
                                                    @error('bridesurname')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="groomforename" class="col-form-label col-sm-4">Grooms
                                                    Forename</label>
                                                <div class="col-sm-8">
                                                    <input type="text"
                                                           class="form-control @error('groomforename') is-invalid @enderror"
                                                           name="groomforename" id="groomforename"
                                                           aria-describedby="helpId"
                                                           placeholder="Enter Forename">
                                                    @error('groomforename')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="groomsurname" class="col-form-label col-sm-4">Grooms
                                                    Surname</label>
                                                <div class="col-sm-8">
                                                    <input type="text"
                                                           class="form-control @error('groomsurname') is-invalid @enderror"
                                                           name="groomsurname" id="groomsurname"
                                                           aria-describedby="helpId"
                                                           placeholder="Enter Surname">
                                                    @error('groomsurname')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card border border-dark mb-1">
                                        <div class="card-header bg-dark text-white">Contact Information</div>
                                        <div class="card-body py-1">
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

                            </div> <!-- / End Of Left Column -->


                            <div class="col-sm-6">

                                <div class="card border border-dark mb-1">
                                    <div class="card-header bg-dark text-white">Contact Information</div>
                                    <div class="card-body py-1">
                                        <div class="form-group row">
                                            <label for="address" class="col-form-label col-sm-4">Street Address</label>
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
                                            <label for="towncity" class="col-form-label col-sm-4">Town /
                                                City</label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                       class="form-control @error('towncity') is-invalid @enderror"
                                                       name="towncity" id="towncity" aria-describedby="helpId"
                                                       placeholder="Enter Town/City">
                                                @error('towncity')
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
                                            <label for="postcode" class="col-form-label col-sm-4">Post Code</label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                       class="form-control @error('postcode') is-invalid @enderror"
                                                       name="postcode" id="postcode" aria-describedby="helpId"
                                                       placeholder="Enter Post-Code">
                                                @error('postcode')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <hr>
                                <button type="submit" class="btn btn-primary float-right">Create Customer
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

</x-admin-master>
