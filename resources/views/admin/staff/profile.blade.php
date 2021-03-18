<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100 border border-dark">
                    <div class="card-header h3 bg-dark text-white">
                        <a class="btn btn-success btn-sm" href="{{route('staff.edit', $staff->id)}}"><i
                                class="far fa-edit"></i></a> {{$staff->FullName}}
                        @if(auth()->user()->userHasRole('super')||auth()->user()->userHasRole('admin')||auth()->user()->userHasRole('owner'))
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-cog fa-fw"></i></a>
                        @endif
                        <span class="float-right"><form action="{{route('staff.destroy', $staff->id)}}" method="post">
                                    @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                    </button>
                                </form></span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <!-- Personal Details -->
                                <div class="card mb-3 border border-dark">
                                    <div class="card-header bg-dark text-white">Contact Details</div>
                                    <div class="card-body">
                                        <table class="table table-sm table-borderless">
                                            <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td>{{$staff->FullName}}</td>
                                            </tr>
                                            <tr>
                                                <td>Telephone:</td>
                                                <td>{{$staff->telephone}}</td>
                                            </tr>
                                            <tr>
                                                <td>E-mail:</td>
                                                <td><a href="mailto:{{$staff->email}}">{{$staff->email}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Address:</td>
                                                <td>{{$staff->address}}<br>
                                                    {{$staff->townCity}}<br>
                                                    {{$staff->county}}<br>
                                                    {{$staff->postCode}}</td>
                                            </tr>
                                            <tr>
                                                <td>Next Of Kin:</td>
                                                <td>{{$staff->who}} - {{$staff->contactnumber}}
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- / Personal Details -->
                                <!-- Other Information -->
                                <div class="card mb-3 border border-dark">
                                    <div class="card-header bg-dark text-white">Employment Details</div>
                                    <div class="card-body">
                                        <table class="table table-sm table-borderless">
                                            <tbody>
                                            <tr>
                                                <td>Position:</td>
                                                <td><a class="text-dark" data-toggle="modal"
                                                       data-target="#addPositionModal">@if(count($staff->positions) != 0)
                                                            @foreach ($staff->positions as $position)
                                                                {!!$position->icon!!} {{$position->name}} <br>
                                                            @endforeach
                                                        @else
                                                            <a class="btn btn-outline-secondary text-danger btn-sm"
                                                               data-toggle="modal" data-target="#addPositionModal">
                                                                Setup
                                                            </a>
                                                        @endif</a></td>
                                            </tr>
                                            <tr>
                                                <td>Personal License:</td>
                                                <td>{{$staff->getRawOriginal('personallicense')}}</td>
                                            </tr>
                                            <tr>
                                                <td>Salary / Hourly:</td>
                                                <td>{{$staff->employmenttype}}</td>
                                            </tr>
                                            <tr>
                                                <td>Hotel:</td>
                                                <td>{{$staff->hotel->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Status:</td>
                                                <td>{{$staff->status}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- / Other Information -->
                            </div>

                            <div class="col-sm-7">
                                <div class="card h-100 border border-dark">
                                    <div class="card-header bg-dark text-white">Holiday Details
                                        <span class="float-right"><a class="btn btn-success btn-sm" data-toggle="modal"
                                                                     data-target="#addHolidayModal">Add Holiday</a></span>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless table-sm">
                                            <tbody>
                                            <tr>
                                                <td>Holidays Taken:</td>
                                                <td>{{$daysTaken}}</td>
                                            </tr>
                                            <tr>
                                                <td>Holidays Left:</td>
                                                <td>{{$staff->holidaysleft}}</td>
                                            </tr>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <hr class="border border-dark">
                                        @if(count($holidays)==0)
                                        @else
                                            <table class="table table-borderless table-small">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th>Start</th>
                                                    <th>Finish</th>
                                                    <th>Days Taken</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($holidays as $hol)
                                                    <tr>
                                                        <td>{{$hol->start}}</td>
                                                        <td>{{$hol->finish}}</td>
                                                        <td>{{$hol->daystaken}}</td>
                                                        <td>
                                                            <form action="{{route('holidays.destroy', $hol->id)}}"
                                                                  method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                                        class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Change Staff Positions Modal-->
                <div class="modal fade" id="addPositionModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit {{$staff->forename}}'s
                                    Position?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span></span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <table class="table table-sm table-borderless">
                                    <tbody>
                                    @foreach ($positions as $position)
                                        <tr class="">
                                            <td class="h4 align-middle">{!!$position->icon!!} {{$position->name}}</td>
                                            <td>
                                                @if(!$staff->positions->contains($position))
                                                    <form
                                                        action="{{route('staff.position.attach', $staff->id)}}"
                                                        method="post">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="hidden" name="position" id="position"
                                                                   value="{{$position->id}}">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary btn-block">Assign

                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{route('staff.position.detach', $staff->id)}}"
                                                          method="post">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="hidden" name="position" id="position"
                                                                   value="{{$position->id}}">
                                                        </div>
                                                        <button type="submit" class="btn btn-danger btn-block">Unassign

                                                        </button>
                                                    </form>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Holiday Modal-->
                <div class="modal fade" id="addHolidayModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Holiday for {{$staff->forename}}</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span></span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="{{route('staffs.storeHoliday', $staff)}}" method="post"
                                      class="form-horizontal">
                                    @csrf

                                    <input type="hidden"
                                           class="form-control" name="staff_id" id="staff_id" aria-describedby="helpId"
                                           value="{{$staff->id}}">

                                    <div class="form-group row">
                                        <label for="start" class="col-form-label col-sm-5">Start
                                            Date</label>
                                        <div class="col-sm-7">
                                            <input type="date"
                                                   class="form-control @error('start') is-invalid @enderror"
                                                   name="start" id="start"
                                                   aria-describedby="helpId"
                                                   placeholder="yyyy-mm-dd"
                                                   value="{{ old('start') }}">
                                            @error('start')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="finish" class="col-form-label col-sm-5">Finish
                                            Date</label>
                                        <div class="col-sm-7">
                                            <input type="date"
                                                   class="form-control @error('finish') is-invalid @enderror"
                                                   name="finish" id="finish"
                                                   aria-describedby="helpId"
                                                   placeholder="yyyy-mm-dd"
                                                   value="{{ old('finish') }}">
                                            @error('finish')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Create Holiday</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Edit Wages Modal-->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Wages</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('staff.wages.update', $staff->id)}}" method="post"
                                      class="form-horizontal">
                                    @csrf
                                    @method('PUT')
                                    <div class="card">
                                        <div class="card-header">
                                            Extra Options for {{$staff->fullname}}
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="wage" class="col-form-label col-sm-4">{{$staff->employmenttype}} wage:</label>
                                                <div class="col-sm-8">
                                                    <input type="number"
                                                           class="form-control @error('wage') is-invalid @enderror"
                                                           name="wage" id="wage" aria-describedby="helpId"
                                                           placeholder="">
                                                    @error('wage')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <button type="submit" class="btn btn-success float-right">Accept</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>




    @endsection
</x-admin-master>
