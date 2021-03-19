<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header">
                        <i class="fas fa-user-edit mr-1"></i>
                        {{$customer->couple}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="col-sm-6">
                                <form action="{{route('customer.update', $customer->id)}}" method="post" class="form-horizontal">
                                    @csrf
                                    @method('PUT')
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
                                                           value="{{$customer->brideforename}}">
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
                                                           value="{{$customer->bridesurname}}">
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
                                                           value="{{$customer->groomforename}}">
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
                                                           value="{{$customer->groomsurname}}">
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
                                                           value="{{$customer->telephone}}">
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
                                                           value="{{$customer->email}}">
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
                                                       value="{{$customer->address}}">
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
                                                       value="{{$customer->towncity}}">
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
                                                       value="{{$customer->county}}">
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
                                                       value="{{$customer->postcode}}">
                                                @error('postcode')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <hr>
                                <button type="submit" class="btn btn-primary float-right">Update
                                </button>
                                </form>
                                <form action="{{route('customer.destroy', $customer->id)}}" method="post" class="float-left">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

</x-admin-master>
