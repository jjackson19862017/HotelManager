<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Staff Members <span class="float-right"><a name="" id="" class="btn btn-success btn-sm"
                                                                   href="{{route('staff.create')}}"
                                                                   role="button">Add Staff</a></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Employed At</th>
                                    <th>Type</th>
                                    <th>Status</th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach($staffs as $staff)
                                    <tr @if($staff->status == "Employed")
                                        class="alert-success"
                                        @elseif($staff->status == "Furloughed")
                                        class="alert-warning"
                                        @else
                                        class="alert-danger"
                                        @endif>
                                        <td><a href="{{route('staff.profile', $staff->id)}}"><i class="fas fa-eye"></i>
                                            </a>{{$staff->FullName}}</td>
                                        <td>{{$staff->hotel->name}}
                                                @if(count($staff->positions) != 0)
                                                 -
                                                    @foreach ($staff->positions as $position)
                                                        {!!$position->icon!!}
                                                    @endforeach
                                                @else

                                                @endif
                                            </a></td>
                                        <td>{{$staff->employmenttype}}</td>
                                        <td>{{$staff->status}}</td>
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
