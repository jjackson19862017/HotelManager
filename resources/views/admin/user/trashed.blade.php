<x-admin-master>
    @section('content')
        <div class="container-fluid  mt-1">
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header">
                        <i class="fas fa-trash"></i>
                        Deleted Users
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Deleted</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->username}}</a></td>
                                        <td>{{$user->name}}</td>
                                        <td>{{date('d M y, H:i:s', strtotime($user->deleted_at))}} by
                                            {{$user->deleted_by}}
                                        </td>
                                        <td>
                                            <a name="" id="" class="btn btn-primary btn-block" href="{{route('user.restore', $user)}}" role="button"><i class="fas fa-trash-restore"></i> Restore</a>

                                        </td>
                                        <td>
                                            <a name="" id="" class="btn btn-danger btn-block" href="{{route('user.erase', $user)}}" role="button"><i class="fas fa-trash-alt"></i> Erase!</a>

                                        </td>
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
