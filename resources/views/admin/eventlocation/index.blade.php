<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Locations <span class="float-right"><a name="" id="" class="btn btn-success btn-sm"
                                                           data-toggle="modal" data-target="#addLocationModel"
                                                           role="button">Create Location</a></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                <tr>
                                    <th class="w-90">Name</th>
                                    <th>Action</th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($eventlocations as $el)
                                    <tr>
                                        <td><a class="btn btn-link" href="{{route('eventlocation.edit', $el->id)}}"><i class="fas fa-edit"></i> {{$el->name}}</></td>
                                        <td>
                                            <form action="{{route('eventlocation.destroy', $el->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-user-times"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Role Modal-->
        <div class="modal fade" id="addLocationModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Location?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('eventlocation.store')}}" method="post" class="form-horizontal">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-form-label col-sm-3">Location Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" id="name" aria-describedby="helpId"
                                           placeholder="Enter Location Name" value="{{old('name')}}">
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary float-right">Create Event Location
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>
