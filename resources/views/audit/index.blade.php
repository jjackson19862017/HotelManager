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
                                <ul class="nav nav-tabs card-header-tabs" id="prev-sales" role="tablist">
                                    @foreach($tabs as $tab)
                                        <li class="nav-item">
                                            <a class="nav-link @if($loop->first)active @endif" href="#{{$tab}}"
                                               role="tab" aria-controls="description"
                                               aria-selected="@if($loop->first) true @endif">{{$tab}}</a>
                                        </li>
                                    @endforeach
                                </ul>
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


</x-admin-master>
