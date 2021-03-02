<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100 border border-dark">
                    <div class="card-header h3 bg-dark text-white">Staff Holiday List</div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" id="events-list" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#current" role="tab"
                                           aria-controls="description" aria-selected="true">This Year</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#previous" role="tab" aria-controls="history"
                                           aria-selected="false">Past</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content mt-3">
                                    <div class="tab-pane active" id="current" role="tabpanel">
                                        <table class="table table-hover table-inverse table-sm" id="dataTable">
                                            <thead class="thead-dark text-center">
                                            <tr>
                                                <th>Name</th>
                                                <th>Date Start</th>
                                                <th>Date Finish</th>
                                                <th>Days Taken</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            @foreach($holidays as $hol)
                                                <tr>
                                                    <td>{{$hol->staff->FullName}} - {{$hol->staff->hotel->name}}</td>
                                                    <td>{{$hol->start}}</td>
                                                    <td>{{$hol->finish}}</td>
                                                    <td>{{$hol->daystaken}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane" id="previous" role="tabpanel" aria-labelledby="history-tab">
                                        <table class="table table-hover table-inverse table-sm" id="dataTable">
                                            <thead class="thead-dark text-center">
                                            <tr>
                                                <th>Name</th>
                                                <th>Date Start</th>
                                                <th>Date Finish</th>
                                                <th>Days Taken</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            @foreach($pastHolidays as $hol)
                                                <tr>
                                                    <td>{{$hol->staff->FullName}} - {{$hol->staff->hotel->name}}</td>
                                                    <td>{{$hol->start}}</td>
                                                    <td>{{$hol->finish}}</td>
                                                    <td>{{$hol->daystaken}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
            $('#events-list a').on('click', function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
        </script>
    @endsection
</x-admin-master>
