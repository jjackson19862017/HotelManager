<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card mb-4 w-100">
                        <div class="card-header mb-4">
                            <i class="fas fa-user-plus mr-1"></i>
                            Please fill out the form to add a new placement.
                        </div>
                        <form action="{{route('placement.store')}}" method="post" class="form-horizontal">
                            @csrf
                            <div class="card border border-dark mb-1 m-3">
                                <div class="card-header bg-dark text-white">Placement Details</div>
                                <div class="card-body py-1">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name" id="name" aria-describedby="helpId"
                                               placeholder="Name of Placement">
                                        @error('name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">Add Placement</button>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    @endsection
</x-admin-master>
