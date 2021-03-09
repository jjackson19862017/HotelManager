<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header h4">
                        <i class="fas fa-pound-sign mr-1"></i>
                        {{$hotel->name}} Prev Sales <span class="float-right"><p> Running Weekly Total - £</p></span>
                    </div>
                    <div class="card-body">
                        @foreach($years as $key => $year)
                            <h3>{{$key}}</h3>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead class="table-dark">
                                    <tr>
                                        <th>Date</th>
                                        <th>Cards</th>
                                        <th>Cash</th>
                                        <th>Gpos</th>
                                        <th>Total</th>
                                        <th>Rooms Sold</th>
                                        <th>Rooms Occupied</th>
                                        <th>Residents</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($year as $mth => $month)

                                        <tr>
                                            <td>{{date('F', mktime(0, 0, 0, $mth+1, ))}}</td>
                                            <td>£{{$month->cardtotal}}</td>
                                            <td>£{{$month->cashtotal}}</td>
                                            <td>£{{$month->gpostotal}}</td>
                                            <td>£{{$month->total}}</td>
                                            <td>{{$month->roomssold}}</td>
                                            <td>{{$month->roomsoccupied}}</td>
                                            <td>{{$month->residents}}</td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td>Total for the Year</td>
                                        <td>£{{$year->sum('cardtotal')}}</td>
                                        <td>£{{$year->sum('cashtotal')}}</td>
                                        <td>£{{$year->sum('gpostotal')}}</td>
                                        <td>£{{$year->sum('total')}}</td>
                                        <td>{{$year->sum('roomssold')}}</td>
                                        <td>{{$year->sum('roomsoccupied')}}</td>
                                        <td>{{$year->sum('residents')}}</td>
                                    </tr>
                                    </tfoot>

                                </table>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>
