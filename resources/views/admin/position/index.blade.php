<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Positions <span class="float-right"><a name="" id="" class="btn btn-success btn-sm" href="{{route('position.create')}}"
                                                                 >Create Position</a></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                <tr>
                                    <th style="width:50px;">Edit</th>
                                    <th style="width:50px;">Icon</th>
                                    <th>Name</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach ($positions as $position)
                                        <tr class="h3">
                                            <td><a class="align-content-center btn btn-success btn-sm" href="{{route('position.edit', $position->id)}}"><i class="fas fa-edit"></i>
                                                </a></td>
                                            <td class="text-center">{!!$position->icon!!}</td>
                                            <td >{{$position->name}}</td>
                                        </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Permission Modal-->
        <div class="modal fade" id="addPermissionModel" tabindex="-1" permission="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
            <div class="modal-dialog" permission="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Permission?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('permission.store')}}" method="post" class="form-horizontal">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-form-label col-sm-3">Permission Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" id="name" aria-describedby="helpId"
                                           placeholder="Enter Permission Name" value="{{old('name')}}">
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary float-right">Create Permission
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>
