<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Placements <span class="float-right"><a name="" id="" class="btn btn-success btn-sm" href="{{route('placement.create')}}"
                                                                 >Create Placement</a></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                <tr>
                                    <th style="width:50px;">Edit</th>
                                    <th>Name</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach ($placements as $placement)
                                        <tr class="h3">
                                            <td>@if($placement->name != "Off" && $placement->name != "Sick" && $placement->name != "Holiday" )<a class="align-content-center btn btn-success btn-sm" href="{{route('placement.edit', $placement->id)}}"><i class="fas fa-edit"></i>
                                                </a>@endif</td>
                                            <td >{{$placement->name}}</td>
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
