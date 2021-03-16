<x-admin-master>
@section('scripts')
    <!-- Time -->
        <script src="{{asset('js/back/moment.js')}}"></script>
    @endsection

    @section('content')
        @foreach($staffs as $staff)
            <div class="container-fluid mt-1">
                <div class="row">
                    <div class="card mb-1 w-100">
                        <!-- Card Header -->
                        <div class="card-header bg-dark text-white h4">
                            {{$staff->FullName}} <small>based at {{$staff->hotel->name}} on
                                an {{strtolower($staff->employmenttype)}} rate.</small>
                        </div>
                        <!--/ Card Header -->
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <form action="{{route('rota.update',$Thisrota->id)}}" method="post" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" class="form-control" name="staffid" id="staffid"
                                               value="{{$Thisrota->staff_id}}">
                                        <div class="form-group row">
                                            <label for="hotel" class="col-form-label col-sm-3">Hotel</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="hotel" id="hotel">

                                                    <option value="{{$Thisrota->hotel_id}}">Current Hotel</option>
                                                    @foreach($hotels as $hotel)
                                                        <option value="{{$hotel->id}}">{{$hotel->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('hotel')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="WeekCommencing" class="col-form-label col-sm-3">Week
                                                Start</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="WeekCommencing" id="WeekCommencing"
                                                        >
                                                    <option
                                                        value={{$Thisrota->weekcommencing}}>{{date('jS F Y', strtotime($Thisrota->weekcommencing))}}
                                                    @foreach ($AvailableDates as $item)
                                                        <option
                                                            value={{$item}}>{{date('jS F Y', strtotime($item))}} @if($loop->first)
                                                                (This Week) @endif</option>
                                                    @endforeach

                                                </select>
                                                @error('WeekCommencing')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Left Column -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="sickDays" class="col-form-label col-sm-3">Sick Days</label>
                                            <div class="col-sm-9">
                                                <input type="number"
                                                       class="form-control @error('sickDays') is-invalid @enderror"
                                                       name="sickDays" id="sickDays" aria-describedby="helpId"
                                                       placeholder="Enter Sick Days" value="{{$Thisrota->sickdays}}">
                                                @error('sickDays')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="holidays" class="col-form-label col-sm-3">Holidays</label>
                                            <div class="col-sm-9">
                                                <input type="number"
                                                       class="form-control @error('sickDays') is-invalid @enderror"
                                                       name="holidays" id="holidays" aria-describedby="helpId"
                                                       placeholder="Enter Holidays Taken"
                                                       value="{{$Thisrota->holidaydays}}">
                                                @error('holidays')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Right Column -->
                                </div>
                                <!--/ Row -->
                        </div>
                        <!--/ Card Body -->
                    </div>
                    <!--/ Card -->

                    @foreach($DaysOfWeek as $day)
                        @php
                            $roleone = strtolower($day) .'roleone';
                            $startone = strtolower($day) .'startone';
                            $finishone = strtolower($day) .'finishone';
                            $roletwo = strtolower($day) .'roletwo';
                            $starttwo = strtolower($day) .'starttwo';
                            $finishtwo = strtolower($day) .'finishtwo';
                        @endphp
                        <div class="card w-100 mb-1">
                            <div class="card-header bg-dark text-white">
                                {{$day}} - <span><label id="{{$day}}Hours" class="text-right"></label></span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="{{$day}}RoleOne" class="col-form-label col-sm-3">1st
                                                Role</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="{{$day}}RoleOne" id="{{$day}}RoleOne"
                                                        onchange="MOV('{{$day}}RoleOne','{{$day}}S1','{{$day}}StartOne','{{$day}}S2','{{$day}}FinishOne','{{$day}}R2','{{$day}}RoleTwo')">
                                                    <option
                                                        value="{{$Thisrota->getRawOriginal($roleone)}}">
                                                        @foreach($placements as $placement)
                                                            @if($Thisrota->getRawOriginal($roleone) == $loop->iteration)

                                                        {{$placement->name}}

                                                            @endif
                                                        @endforeach


                                                    </option>

                                                    @foreach ($placements as $placement)
                                                        @if($placement->id == $Thisrota->getRawOriginal($roleone))
                                                        @else
                                                            <option
                                                                value="{{$placement->id}}">{{$placement->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('{{$day}}RoleOne')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="{{$day}}StartOne" class="col-form-label col-sm-3"
                                                   id="{{$day}}S1">1st
                                                Start</label>
                                            <div class="col-sm-9">
                                                <input type="time"
                                                       class="form-control @error('{{$day}}StartOne') is-invalid @enderror {{strtolower($day)}} {{$day}}StartOne"
                                                       name="{{$day}}StartOne" id="{{$day}}StartOne"
                                                       aria-describedby="helpId"
                                                       value="{{$Thisrota->$startone}}">
                                                @error('$day.StartOne')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="{{$day}}FinishOne" class="col-form-label col-sm-3"
                                                   id="{{$day}}S2">1st
                                                Finish</label>
                                            <div class="col-sm-9">
                                                <input type="time"
                                                       class="form-control @error('{{$day}}FinishOne') is-invalid @enderror {{strtolower($day)}} {{$day}}FinishOne"
                                                       name="{{$day}}FinishOne" id="{{$day}}FinishOne"
                                                       aria-describedby="helpId"
                                                       value="{{$Thisrota->$finishone}}">
                                                @error('$day.FinishOne')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group row">
                                            <label for="{{$day}}RoleTwo" class="col-form-label col-sm-3"
                                                   id="{{$day}}R2">2nd
                                                Role</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="{{$day}}RoleTwo" id="{{$day}}RoleTwo"
                                                        onchange="MTV('{{$day}}RoleTwo','{{$day}}S3','{{$day}}StartTwo','{{$day}}S4','{{$day}}FinishTwo')">
                                                    <option
                                                        value="{{$Thisrota->getRawOriginal($roletwo)}}">
                                                        @foreach($placements as $placement)
                                                            @if($Thisrota->getRawOriginal($roletwo) == $loop->iteration)

                                                                {{$placement->name}}

                                                            @endif
                                                        @endforeach</option>

                                                    @foreach ($placements as $placement)
                                                        @if($placement->id == $Thisrota->getRawOriginal($roletwo))
                                                        @else
                                                            <option
                                                                value="{{$placement->id}}">{{$placement->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('{{$day}}RoleTwo')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="{{$day}}StartTwo" class="col-form-label col-sm-3"
                                                   id="{{$day}}S3">2nd
                                                Start</label>
                                            <div class="col-sm-9">
                                                <input type="time"
                                                       class="form-control @error('{{$day}}StartTwo') is-invalid @enderror {{strtolower($day)}} {{$day}}StartTwo"
                                                       name="{{$day}}StartTwo" id="{{$day}}StartTwo"
                                                       aria-describedby="helpId"
                                                       value="{{$Thisrota->$starttwo}}">
                                                @error('$day.StartTwo')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="{{$day}}FinishTwo" class="col-form-label col-sm-3"
                                                   id="{{$day}}S4">2nd
                                                Finish</label>
                                            <div class="col-sm-9">
                                                <input type="time"
                                                       class="form-control @error('{{$day}}FinishTwo') is-invalid @enderror {{strtolower($day)}} {{$day}}FinishTwo"
                                                       name="{{$day}}FinishTwo" id="{{$day}}FinishTwo"
                                                       aria-describedby="helpId"
                                                       value="{{$Thisrota->$finishtwo}}">
                                                @error('$day.FinishTwo')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <button type="submit" class="btn btn-primary float-right">Update {{$staff->forename}}'s Rota</button>
                </form>
                <!--/ Row -->
            </div>
            <!--/ Container -->
        @endforeach
    @endsection

    @section('js')
        <script>
            function MOV(DayRoleOne, DayStartOneLabel, DayStartOne, DayFinishOneLabel, DayFinishOne, DayRoleTwoLabel, DayRoleTwo) {
                var DayRoleOne = document.getElementById(DayRoleOne)[document.getElementById(DayRoleOne).selectedIndex].innerHTML;
                //console.log(DayRoleOne, DayStartOneLabel);
                switch (DayRoleOne) {
                    case 'Off':
                    case 'Sick':
                    case 'Holiday':
                        document.getElementById(DayStartOneLabel).style.display = "none";
                        document.getElementById(DayStartOne).style.display = "none";
                        document.getElementById(DayFinishOneLabel).style.display = "none";
                        document.getElementById(DayFinishOne).style.display = "none";
                        document.getElementById(DayRoleTwoLabel).style.display = "none";
                        document.getElementById(DayRoleTwo).style.display = "none";
                        break;
                    default:
                        document.getElementById(DayStartOneLabel).style.display = "inline-block";
                        document.getElementById(DayStartOne).style.display = "block";
                        document.getElementById(DayFinishOneLabel).style.display = "inline-block";
                        document.getElementById(DayFinishOne).style.display = "block";
                        document.getElementById(DayRoleTwoLabel).style.display = "inline-block";
                        document.getElementById(DayRoleTwo).style.display = "block";

                }
                ;
            };

            function MTV(DayRoleTwo, DayStartTwoLabel, DayStartTwo, DayFinishTwoLabel, DayFinishTwo) {
                var DayRoleTwo = document.getElementById(DayRoleTwo)[document.getElementById(DayRoleTwo).selectedIndex].innerHTML;
                //console.log(DayRoleTwo, DayStartTwoLabel);
                switch (DayRoleTwo) {
                    case 'Off':
                    case 'Sick':
                    case 'Holiday':
                        document.getElementById(DayStartTwoLabel).style.display = "none";
                        document.getElementById(DayStartTwo).style.display = "none";
                        document.getElementById(DayFinishTwoLabel).style.display = "none";
                        document.getElementById(DayFinishTwo).style.display = "none";
                        break;
                    default:
                        document.getElementById(DayStartTwoLabel).style.display = "inline-block";
                        document.getElementById(DayStartTwo).style.display = "block";
                        document.getElementById(DayFinishTwoLabel).style.display = "inline-block";
                        document.getElementById(DayFinishTwo).style.display = "block";

                }
                ;
            };

            $(document).ready(function () {

                @foreach($DaysOfWeek as $day)

                // Iterates through the Week, and filling out the details of the form and hiding/showing what needs to be shown.

                var DayRoleOne = document.getElementById("{{$day}}RoleOne")[document.getElementById("{{$day}}RoleOne").selectedIndex].innerHTML;
                var DayRoleTwo = document.getElementById("{{$day}}RoleTwo")[document.getElementById("{{$day}}RoleTwo").selectedIndex].innerHTML;


                switch (DayRoleOne) {
                    case 'Off':
                    case 'Sick':
                    case 'Holiday':
                        document.getElementById("{{$day}}S1").style.display = "none";
                        document.getElementById("{{$day}}StartOne").style.display = "none";
                        document.getElementById("{{$day}}S2").style.display = "none";
                        document.getElementById("{{$day}}FinishOne").style.display = "none";
                        break;
                    default:
                        document.getElementById("{{$day}}S1").style.display = "inline-block";
                        document.getElementById("{{$day}}StartOne").style.display = "block";
                        document.getElementById("{{$day}}S2").style.display = "inline-block";
                        document.getElementById("{{$day}}FinishOne").style.display = "block";

                }
                ;

                switch (DayRoleTwo) {
                    case 'Off':
                    case 'Sick':
                    case 'Holiday':
                        document.getElementById("{{$day}}R2").style.display = "none";
                        document.getElementById("{{$day}}RoleTwo").style.display = "none";
                        document.getElementById("{{$day}}S3").style.display = "none";
                        document.getElementById("{{$day}}StartTwo").style.display = "none";
                        document.getElementById("{{$day}}S4").style.display = "none";
                        document.getElementById("{{$day}}FinishTwo").style.display = "none";
                        break;
                    default:
                        document.getElementById("{{$day}}R2").style.display = "inline-block";
                        document.getElementById("{{$day}}RoleTwo").style.display = "block";
                        document.getElementById("{{$day}}S3").style.display = "inline-block";
                        document.getElementById("{{$day}}StartTwo").style.display = "block";
                        document.getElementById("{{$day}}S4").style.display = "inline-block";
                        document.getElementById("{{$day}}FinishTwo").style.display = "block";

                }
                ;
                @endforeach
                // Calculates Hours from Previous Rota when loaded.
                $("#MondayHours").text(CalcHours($(".MondayStartOne"), $(".MondayFinishOne"), $(".MondayStartTwo"), $(".MondayFinishTwo")));
                $("#TuesdayHours").text(CalcHours($(".TuesdayStartOne"), $(".TuesdayFinishOne"), $(".TuesdayStartTwo"), $(".TuesdayFinishTwo")));
                $("#WednesdayHours").text(CalcHours($(".WednesdayStartOne"), $(".WednesdayFinishOne"), $(".WednesdayStartTwo"), $(".WednesdayFinishTwo")));
                $("#ThursdayHours").text(CalcHours($(".ThursdayStartOne"), $(".ThursdayFinishOne"), $(".ThursdayStartTwo"), $(".ThursdayFinishTwo")));
                $("#FridayHours").text(CalcHours($(".FridayStartOne"), $(".FridayFinishOne"), $(".FridayStartTwo"), $(".FridayFinishTwo")));
                $("#SaturdayHours").text(CalcHours($(".SaturdayStartOne"), $(".SaturdayFinishOne"), $(".SaturdayStartTwo"), $(".SaturdayFinishTwo")));
                $("#SundayHours").text(CalcHours($(".SundayStartOne"), $(".SundayFinishOne"), $(".SundayStartTwo"), $(".SundayFinishTwo")));
            });

            function CalcHours(start1, finish1, start2, finish2) {
                var S1 = moment.utc(start1.val(), 'hh:mm'); // Takes Start Time 1
                var F1 = moment.utc(finish1.val(), 'hh:mm'); // Takes Finish Time 1
                var S2 = moment.utc(start2.val(), 'hh:mm'); // Takes Start Time 2
                var F2 = moment.utc(finish2.val(), 'hh:mm'); // Takes Finsh Time 2
                var H1 = parseFloat(((F1 - S1) / 60 / 60 / 1000).toFixed(1)); // Converts Result to Hours
                var H2 = parseFloat(((F2 - S2) / 60 / 60 / 1000).toFixed(1)); // Converts Result to Hours
                // Runs a check to see if the second time is a Number or Not
                if (isNaN(H1)) {
                    H1 = "";
                    return H1;
                }
                if (isNaN(H2)) {
                    var TH = H1 + " Hours";
                } else {
                    var TH = H1 + H2 + " Hours";
                }
                return TH; // Returns Total Hours
            }

            $(".monday").keyup(function () {
                //console.log(CalcHours($(".MondayStartOne"),$(".MondayFinishOne"),$(".MondayStartTwo"),$(".MondayFinishTwo")));
                $("#MondayHours").text(CalcHours($(".MondayStartOne"), $(".MondayFinishOne"), $(".MondayStartTwo"), $(".MondayFinishTwo")));
            });

            $(".tuesday").keyup(function () {
                //console.log(CalcHours($(".TuesdayStartOne"),$(".TuesdayFinishOne"),$(".TuesdayStartTwo"),$(".TuesdayFinishTwo")));
                $("#TuesdayHours").text(CalcHours($(".TuesdayStartOne"), $(".TuesdayFinishOne"), $(".TuesdayStartTwo"), $(".TuesdayFinishTwo")));
            });

            $(".wednesday").keyup(function () {
                //console.log(CalcHours($(".WednesdayStartOne"),$(".WednesdayFinishOne"),$(".WednesdayStartTwo"),$(".WednesdayFinishTwo")));
                $("#WednesdayHours").text(CalcHours($(".WednesdayStartOne"), $(".WednesdayFinishOne"), $(".WednesdayStartTwo"), $(".WednesdayFinishTwo")));
            });

            $(".thursday").keyup(function () {
                //console.log(CalcHours($(".ThursdayStartOne"),$(".ThursdayFinishOne"),$(".ThursdayStartTwo"),$(".ThursdayFinishTwo")));
                $("#ThursdayHours").text(CalcHours($(".ThursdayStartOne"), $(".ThursdayFinishOne"), $(".ThursdayStartTwo"), $(".ThursdayFinishTwo")));
            });

            $(".friday").keyup(function () {
                //console.log(CalcHours($(".FridayStartOne"),$(".FridayFinishOne"),$(".FridayStartTwo"),$(".FridayFinishTwo")));
                $("#FridayHours").text(CalcHours($(".FridayStartOne"), $(".FridayFinishOne"), $(".FridayStartTwo"), $(".FridayFinishTwo")));
            });

            $(".saturday").keyup(function () {
                //console.log(CalcHours($(".SaturdayStartOne"),$(".SaturdayFinishOne"),$(".SaturdayStartTwo"),$(".SaturdayFinishTwo")));
                $("#SaturdayHours").text(CalcHours($(".SaturdayStartOne"), $(".SaturdayFinishOne"), $(".SaturdayStartTwo"), $(".SaturdayFinishTwo")));
            });

            $(".sunday").keyup(function () {
                //console.log(CalcHours($(".SundayStartOne"),$(".SundayFinishOne"),$(".SundayStartTwo"),$(".SundayFinishTwo")));
                $("#SundayHours").text(CalcHours($(".SundayStartOne"), $(".SundayFinishOne"), $(".SundayStartTwo"), $(".SundayFinishTwo")));
            });


        </script>
    @endsection
</x-admin-master>
