<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100 border border-dark">
                    <div class="card-header h3 bg-dark text-white">
                        <a class="btn btn-success btn-sm" href="{{route('staff.edit', $staff->id)}}"><i class="far fa-edit"></i></a> {{$staff->FullName}}
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
                                                <td> <a class="text-dark" data-toggle="modal" data-target="#addPositionModal">@if(count($staff->positions) != 0)
                                                            @foreach ($staff->positions as $position)
                                                                {!!$position->icon!!} {{$position->name}} <br>
                                                            @endforeach
                                                        @else
                                                            <a class="btn btn-outline-secondary text-danger btn-sm" data-toggle="modal" data-target="#addPositionModal">
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
                                    <div class="card-header bg-dark text-white">Holiday Details</div>
                                    <div class="card-body">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Change Staff Positions Modal-->
                <div class="modal fade" id="addPositionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit {{$staff->forename}}'s Position?</h5>
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



    @endsection
</x-admin-master>
