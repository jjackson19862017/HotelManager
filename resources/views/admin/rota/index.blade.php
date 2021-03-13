<x-admin-master>
    @section('content')
        <div class="container-fluid mt-1">
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header bg-dark text-white h4">
                        {{$hotel->name}} - Week Commencing: {{date('l jS M Y', strtotime($IsAMonday))}} @if(auth()->user()->userHasRole('owner')||auth()->user()->userHasRole('admin')||auth()->user()->userHasRole('super'))<small class="float-right">Total Paid Hours: {{$ThisWeeksTotalHours}}</small>@endif
                    </div>
                    <div class="card-body">
                    @if($ThisWeeksRota->isEmpty())
                            <h5 class="card-title">No one has been added to the rota for this week.</h5>
                            <a href="{{route('hotel.staff.index',$hotel->id)}}" class="btn btn-dark"><i class="far fa-question-circle"></i> Add Someone <i class="far fa-question-circle"></i></a>
                        @else
                        <table class="table table-sm table-responsive-sm text-center">
                            <thead class="thead-dark">
                            <tr>
                                <th>Staff</th>
                                @foreach ($DaysOfWeek as $day)
                                    <th>{{$day}}</th>
                                @endforeach
                                <th>Hours</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ThisWeeksRota as $rota)
                                <tr>
                                    <td rowspan="2" class="align-middle" style="width: 100px;">
                                        @if(auth()->user()->userHasRole($hotel->slug. ".manager")||auth()->user()->userHasRole('owner')||auth()->user()->userHasRole('admin')||auth()->user()->userHasRole('super'))
                                        <a href="{{route('rota.edit',$rota->id)}}">{{$rota->Staffname}}</a>
                                        @else
                                            {{$rota->Staffname}}
                                            @endif
                                    </td>
                                    <td>{{$rota->mondaystartone}} @if(!$rota->mondaystartone == "")
                                            - @endif {{$rota->mondayfinishone}}</td>
                                    <td>{{$rota->tuesdaystartone}} @if(!$rota->tuesdaystartone == "")
                                            - @endif {{$rota->tuesdayfinishone}}</td>
                                    <td>{{$rota->wednesdaystartone}} @if(!$rota->wednesdaystartone == "")
                                            - @endif {{$rota->wednesdayfinishone}}</td>
                                    <td>{{$rota->thursdaystartone}} @if(!$rota->thursdaystartone == "")
                                            - @endif {{$rota->thursdayfinishone}}</td>
                                    <td>{{$rota->fridaystartone}} @if(!$rota->fridaystartone == "")
                                            - @endif {{$rota->fridayfinishone}}</td>
                                    <td>{{$rota->saturdaystartone}} @if(!$rota->saturdaystartone == "")
                                            - @endif {{$rota->saturdayfinishone}}</td>
                                    <td>{{$rota->sundaystartone}} @if(!$rota->sundaystartone == "")
                                            - @endif {{$rota->sundayfinishone}}</td>
                                    <td rowspan="3" class="align-middle">{{$rota->totalhours}}</td>
                                </tr>
                                <tr>
                                    <td>{{$rota->mondaystarttwo}} @if(!$rota->mondaystarttwo == "")
                                            - @endif {{$rota->mondayfinishtwo}}</td>
                                    <td>{{$rota->tuesdaystarttwo}} @if(!$rota->tuesdaystarttwo == "")
                                            - @endif {{$rota->tuesdayfinishtwo}}</td>
                                    <td>{{$rota->wednesdaystarttwo}} @if(!$rota->wednesdaystarttwo == "")
                                            - @endif {{$rota->wednesdayfinishtwo}}</td>
                                    <td>{{$rota->thursdaystarttwo}} @if(!$rota->thursdaystarttwo == "")
                                            - @endif {{$rota->thursdayfinishtwo}}</td>
                                    <td>{{$rota->fridaystarttwo}} @if(!$rota->fridaystarttwo == "")
                                            - @endif {{$rota->fridayfinishtwo}}</td>
                                    <td>{{$rota->saturdaystarttwo}} @if(!$rota->saturdaystarttwo == "")
                                            - @endif {{$rota->saturdayfinishtwo}}</td>
                                    <td>{{$rota->sundaystarttwo}} @if(!$rota->sundaystarttwo == "")
                                            - @endif {{$rota->sundayfinishtwo}}</td>
                                </tr>
                                <tr>
                                    <td><form class="text-center" action="{{route('rota.destroy', $rota->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-block btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form></td>
                                    <td>
                                        @if($rota->mondayroleone == $rota->mondayroletwo)
                                            {{$rota->mondayroleone}}
                                        @elseif($rota->mondayroletwo == "OFF")
                                            {{$rota->mondayroleone}}
                                        @else
                                            {{$rota->mondayroleone}} / {{$rota->mondayroletwo}}
                                        @endif
                                    </td>

                                    <td>
                                        @if($rota->tuesdayroleone == $rota->tuesdayroletwo)
                                            {{$rota->tuesdayroleone}}
                                        @elseif($rota->tuesdayroletwo == "OFF")
                                            {{$rota->tuesdayroleone}}
                                        @else
                                            {{$rota->tuesdayroleone}} / {{$rota->tuesdayroletwo}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($rota->wednesdayroleone == $rota->wednesdayroletwo)
                                            {{$rota->wednesdayroleone}}
                                        @elseif($rota->wednesdayroletwo == "OFF")
                                            {{$rota->wednesdayroleone}}
                                        @else
                                            {{$rota->wednesdayroleone}} / {{$rota->wednesdayroletwo}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($rota->thursdayroleone == $rota->thursdayroletwo)
                                            {{$rota->thursdayroleone}}
                                        @elseif($rota->thursdayroletwo == "OFF")
                                            {{$rota->thursdayroleone}}
                                        @else
                                            {{$rota->thursdayroleone}} / {{$rota->thursdayroletwo}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($rota->fridayroleone == $rota->fridayroletwo)
                                            {{$rota->fridayroleone}}
                                        @elseif($rota->fridayroletwo == "OFF")
                                            {{$rota->fridayroleone}}
                                        @else
                                            {{$rota->fridayroleone}} / {{$rota->fridayroletwo}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($rota->saturdayroleone == $rota->saturdayroletwo)
                                            {{$rota->saturdayroleone}}
                                        @elseif($rota->saturdayroletwo == "OFF")
                                            {{$rota->saturdayroleone}}
                                        @else
                                            {{$rota->saturdayroleone}} / {{$rota->saturdayroletwo}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($rota->sundayroleone == $rota->sundayroletwo)
                                            {{$rota->sundayroleone}}
                                        @elseif($rota->sundayroletwo == "OFF")
                                            {{$rota->sundayroleone}}
                                        @else
                                            {{$rota->sundayroleone}} / {{$rota->sundayroletwo}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr class="table-primary">
                                <td>FOH</td>
                                <td>@foreach($MondayOneRolesFOH as $role => $answer){{$answer}}@endforeach
                                    / @foreach($MondayTwoRolesFOH as $role => $answer){{$answer}}@endforeach</td>
                                <td>@foreach($TuesdayOneRolesFOH as $role => $answer){{$answer}}@endforeach
                                    / @foreach($TuesdayTwoRolesFOH as $role => $answer){{$answer}}@endforeach</td>
                                <td>@foreach($WednesdayOneRolesFOH as $role => $answer){{$answer}}@endforeach
                                    / @foreach($WednesdayTwoRolesFOH as $role => $answer){{$answer}}@endforeach</td>
                                <td>@foreach($ThursdayOneRolesFOH as $role => $answer){{$answer}}@endforeach
                                    / @foreach($ThursdayTwoRolesFOH as $role => $answer){{$answer}}@endforeach</td>
                                <td>@foreach($FridayOneRolesFOH as $role => $answer){{$answer}}@endforeach
                                    / @foreach($FridayTwoRolesFOH as $role => $answer){{$answer}}@endforeach</td>
                                <td>@foreach($SaturdayOneRolesFOH as $role => $answer){{$answer}}@endforeach
                                    / @foreach($SaturdayTwoRolesFOH as $role => $answer){{$answer}}@endforeach</td>
                                <td>@foreach($SundayOneRolesFOH as $role => $answer){{$answer}}@endforeach
                                    / @foreach($SundayTwoRolesFOH as $role => $answer){{$answer}}@endforeach</td>

                            </tr>
                            <tr class="table-success">
                                <td>HK</td>
                                <td>@if($rota->mondayroleone == $rota->mondayroletwo)
                                        @foreach($MondayOneRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach
                                    @else
                                        @foreach($MondayOneRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach @foreach($MondayTwoRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>@if($rota->tuesdayroleone == $rota->tuesdayroletwo)
                                        @foreach($TuesdayOneRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach
                                    @else
                                        @foreach($TuesdayOneRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach @foreach($TuesdayTwoRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>@if($rota->wednesdayroleone == $rota->wednesdayroletwo)
                                        @foreach($WednesdayOneRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach
                                    @else
                                        @foreach($WednesdayOneRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach @foreach($WednesdayTwoRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>@if($rota->thursdayroleone == $rota->thursdayroletwo)
                                        @foreach($ThursdayOneRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach
                                    @else
                                        @foreach($ThursdayOneRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach @foreach($ThursdayTwoRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>@if($rota->fridayroleone == $rota->fridayroletwo)
                                        @foreach($FridayOneRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach
                                    @else
                                        @foreach($FridayOneRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach @foreach($FridayTwoRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>@if($rota->saturdayroleone == $rota->saturdayroletwo)
                                        @foreach($SaturdayOneRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach
                                    @else
                                        @foreach($SaturdayOneRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach @foreach($SaturdayTwoRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>@if($rota->sundayroleone == $rota->sundayroletwo)
                                        @foreach($SundayOneRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach
                                    @else
                                        @foreach($SundayOneRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach @foreach($SundayTwoRolesHK as $role => $answer)
                                            {{$answer}}
                                        @endforeach
                                    @endif
                                </td>


                            </tr>
                            <tr class="table-danger">
                                <td>KIT</td>
                                <td>@foreach($MondayOneRolesKIT as $role => $answer){{$answer}}@endforeach
                                    / @foreach($MondayTwoRolesKIT as $role => $answer){{$answer}}@endforeach</td>
                                <td>@foreach($TuesdayOneRolesKIT as $role => $answer){{$answer}}@endforeach
                                    / @foreach($TuesdayTwoRolesKIT as $role => $answer){{$answer}}@endforeach</td>
                                <td>@foreach($WednesdayOneRolesKIT as $role => $answer){{$answer}}@endforeach
                                    / @foreach($WednesdayTwoRolesKIT as $role => $answer){{$answer}}@endforeach</td>
                                <td>@foreach($ThursdayOneRolesKIT as $role => $answer){{$answer}}@endforeach
                                    / @foreach($ThursdayTwoRolesKIT as $role => $answer){{$answer}}@endforeach</td>
                                <td>@foreach($FridayOneRolesKIT as $role => $answer){{$answer}}@endforeach
                                    / @foreach($FridayTwoRolesKIT as $role => $answer){{$answer}}@endforeach</td>
                                <td>@foreach($SaturdayOneRolesKIT as $role => $answer){{$answer}}@endforeach
                                    / @foreach($SaturdayTwoRolesKIT as $role => $answer){{$answer}}@endforeach</td>
                                <td>@foreach($SundayOneRolesKIT as $role => $answer){{$answer}}@endforeach
                                    / @foreach($SundayTwoRolesKIT as $role => $answer){{$answer}}@endforeach</td>
                            </tr>
                            </tfoot>
                        </table>


                    </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>
