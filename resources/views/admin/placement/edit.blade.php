<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card mb-4 w-100">
                        <div class="card-header">
                            <i class="fas fa-user-plus mr-1"></i>
                            Edit {{$placement->name}}.
                        </div>
                        <form action="{{route('placement.update',$placement->id)}}" method="post"
                              class="form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="card border border-dark mb-1 m-3">
                                <div class="card-header bg-dark text-white">Placement Details</div>
                                <div class="card-body py-1">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name" id="name" aria-describedby="helpId"
                                               value="{{$placement->name}}">
                                        @error('name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">
                                        Edit {{$placement->name}}</button>
                        </form>
                        <form action="{{route('placement.destroy', $placement->id)}}" method="post" class="float-left">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete {{$placement->name}}</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
        </div>
        </div>


    @endsection
</x-admin-master>
