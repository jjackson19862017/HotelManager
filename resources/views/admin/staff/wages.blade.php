<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row"> @foreach($staffs as $key => $hotel)
                <div class="card mb-4 w-100">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        {{$hotel->hn}} <small> with {{$hotel->count()}} members of staff</small>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-sm table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                <tr>

                                    <th style="width: 250px;">Name</th>
                                    <th>Position</th>
                                    <th style="width: 100px;">Type</th>
                                    <th style="width: 100px;">Wage</th>
                                    <th style="width: 100px;">Status</th>

                                </tr>
                                </thead>

                                <tbody>

                                    @foreach($hotel as $staff)
                                    <tr>
                                        <td><a href="{{route('staff.profile', $staff->id)}}"><i class="fas fa-eye"></i>
                                            </a>{{$staff->FullName}}</td>
                                        <td>
                                            @if(count($staff->positions) != 0)
                                                @foreach ($staff->positions as $position)
                                                    <span data-toggle="tooltip" data-placement="top"
                                                          title="{{$position->name}}">{{$position->name}}</span>
                                                @endforeach
                                            @else

                                            @endif
                                        </td>
                                        <td>{{$staff->employmenttype}}</td>
                                        <td>@if(empty($staff->wage))
                                                Not Set
                                            @else £{{$staff->wage}}

                                            @endif

                                        </td>

                                        <td>{{$staff->status}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
                @endforeach

            </div>
        </div>


    @endsection

    @section('JS')
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        });


    @endsection
</x-admin-master>
