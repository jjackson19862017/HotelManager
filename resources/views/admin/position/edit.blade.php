<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card mb-4 w-100">
                        <div class="card-header">
                            <i class="fas fa-user-plus mr-1"></i>
                            Edit {{$position->name}}.
                        </div>
                        <form action="{{route('position.update',$position->id)}}" method="post" class="form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="card border border-dark mb-1 m-3">
                                <div class="card-header bg-dark text-white">Position Details</div>
                                <div class="card-body py-1">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name" id="name" aria-describedby="helpId"
                                               value="{{$position->name}}">
                                        @error('name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="icon">Icon</label>
                                        <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                               name="icon" id="icon" aria-describedby="helpId"
                                               value="{{$position->icon}}">
                                        @error('name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Edit {{$position->name}}</button>
                        </form>
                                    <form action="{{route('position.destroy', $position->id)}}" method="post" class="float-left">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete {{$position->name}}</button>
                                    </form>
                                </div>

                            </div>

                    </div>
                </div>
            </div>
        </div>


    @endsection
</x-admin-master>
