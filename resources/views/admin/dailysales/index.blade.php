<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header h4">
                        <i class="fas fa-pound-sign mr-1"></i>
                        {{$hotel->name}} Sales <span class="float-right"><p> Running Weekly Total - £{{$weeklySales->sum('gpostotal')}}</p></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-dark">
                            <tr>
                                <th></th>
                                <th>Date</th>
                                <th>Cards</th>
                                <th>Cash</th>
                                <th>Gpos</th>
                                <th>Total</th>
                                <th>Float</th>
                                <th>Safe</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($weeklySales as $s)
                                <tr>
                                    <td><a name="" id="" class="btn btn-primary btn-sm"
                                           href="{{route('endofday.edit', $s->id)}}"
                                           role="button"><i class="fas fa-edit"></i></a></td>
                                    <td>{{date('D d/m/y', strtotime($s->date))}}</td>
                                    <td>£{{number_format($s->cardtotal,2)}}</td>
                                    <td>£{{number_format($s->cashtotal,2)}}</td>
                                    <td>£{{number_format($s->gpostotal,2)}}</td>
                                    <td>£{{number_format($s->total,2)}}</td>
                                    <td class="@if($s->float < 200) text-danger @endif ">
                                        £{{number_format($s->float,2)}}</td>
                                    <td>£{{number_format($s->cashsafe,2)}}</td>

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
