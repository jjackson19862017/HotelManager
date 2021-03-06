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
    @endsection
</x-admin-master>
