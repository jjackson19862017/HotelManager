<x-admin-master>

    @section('content')

        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header h4">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Activity Logger
                    </div>
                    <div class="card-body">

                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" id="audit" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" href="#user" role="tab" aria-controls="description"
                                           aria-selected="true">User</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#staff" role="tab" aria-controls="description"
                                           aria-selected="false">Staff</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#rota" role="tab" aria-controls="description"
                                           aria-selected="false">Rota</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#dailysales" role="tab" aria-controls="description"
                                           aria-selected="false">Daily Sales</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content mt-3">
                                    <!-- User Tab -->
                                    <div class="tab-pane active" id="user" role="tabpanel">

                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead class="table-dark">
                                                <tr>
                                                    <th>Created By</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($audits as $audit)
@if($loop->first)@else

                                                    <tr>
                                                        <td>{{$audit->user->name}}</td>
                                                        <td>{{$audit->created_at}}</td>
                                                        <td>{{$audit->event}}</td>
                                                        <td>{{$audit->user->username}}</td>


                                                    </tr>@endif
                                                @endforeach
                                                </tbody>

                                            </table>
                                        </div>




                                    </div>
                                    <!-- / User Tab -->

                                    <!-- Staff Tab -->
                                    <div class="tab-pane" id="staff" role="tabpanel">
                                        <h1>Staff</h1>
                                        <ul>
                                            @forelse ($audits as $audit)
                                                <li>
                                                    @lang('article.updated.metadata', $audit->getMetadata())

                                                    @foreach ($audit->getModified() as $attribute => $modified)
                                                        <ul>
                                                            <li>@lang('article.'.$audit->event.'.modified.'.$attribute, $modified) </li>
                                                        </ul>
                                                    @endforeach
                                                </li>
                                            @empty
                                                <p>@lang('article.unavailable_audits')</p>
                                            @endforelse
                                        </ul>
                                    </div>
                                    <!-- / Staff Tab -->

                                    <!-- Rota Tab -->
                                    <div class="tab-pane" id="rota" role="tabpanel">
                                        <h1>Rota</h1>

                                    </div>
                                    <!-- / Rota Tab -->

                                    <!-- Daily Sales Tab -->
                                    <div class="tab-pane" id="dailysales" role="tabpanel">
                                        <h1>Daily Sales</h1>

                                    </div>
                                    <!-- / Daily Sales Tab -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <ul>
            @forelse ($audits as $audit)
                <li>
                    @lang('article.updated.metadata', $audit->getMetadata())

                    @foreach ($audit->getModified() as $attribute => $modified)
                        <ul>
                            <li>@lang('article.'.$audit->event.'.modified.'.$attribute, $modified) </li>
                        </ul>
                    @endforeach
                </li>
            @empty
                <p>@lang('article.unavailable_audits')</p>
            @endforelse
        </ul>


        @foreach ($hotels as $audit)

            <p>On {{$audit->created_at}}</p>

            <tr>
                <td>{{$audit->user->name}}</td>
                <td>{{$audit->event}}</td>
                <td>{{$audit->user->name}}</td>
            </tr>
        @endforeach



    @endsection

    @section('js')
        <script>
            $('#audit a').on('click', function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
        </script>
    @endsection

</x-admin-master>
