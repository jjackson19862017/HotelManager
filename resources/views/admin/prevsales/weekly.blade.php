<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header h4">
                        <i class="fas fa-calendar-week mr-2"></i>
                        {{$hotel->name}} Previous Yearly Sales Categorised By Week
                    </div>
                    <div class="card-body">

                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" id="prev-sales" role="tablist">
                                    @foreach($years as $key => $year)
                                        <li class="nav-item">
                                            <a class="nav-link @if($loop->last)active @endif" href="#year{{$key}}"
                                               role="tab" aria-controls="description"
                                               aria-selected="@if($loop->last) true @endif">{{$key}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-body">

                                <div class="tab-content mt-3">
                                    @foreach($years as $key => $year)
                                        <div class="tab-pane @if($loop->last)active @endif" id="year{{$key}}"
                                             role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table table-sm">
                                                    <thead class="table-dark">
                                                    <tr>
                                                        <th>Date (Week Number)</th>
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
                                                    @foreach($year as $wk => $week)
                                                        <tr>
                                                            <td>{{date('D d M', strtotime($week->date))}}: ({{date('W', strtotime($week->date))}})</td>
                                                            <td>£{{$week->cardtotal}}</td>
                                                            <td>£{{$week->cashtotal}}</td>
                                                            <td>£{{$week->gpostotal}}</td>
                                                            <td>£{{$week->total}}</td>
                                                            <td>{{$week->roomssold}}</td>
                                                            <td>{{$week->roomsoccupied}}</td>
                                                            <td>{{$week->residents}}</td>
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
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                @endsection

                @section('js')
                    <script>
                        $('#prev-sales a').on('click', function (e) {
                            e.preventDefault()
                            $(this).tab('show')
                        })
                    </script>
    @endsection
</x-admin-master>
