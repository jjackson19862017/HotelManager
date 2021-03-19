<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Customers <span class="float-right"><a name="" id="" class="btn btn-success btn-sm"
                                                                   href="{{route('customer.create')}}"
                                                                   role="button">Add Customer</a></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Couple</th>
                                    <th>Telephone</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{$customer->couple}}</td>
                                        <td>{{$customer->telephone}}</td>
                                        <td>{{$customer->email}}</td>
                                        <td><a href="{{route('customer.edit', $customer)}}" class="btn btn-sm btn-success">Edit</a></td>
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

        @section('js')

            <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
            <script src="{{asset('assets/demo/datatables-demo.js')}}"></script>
        @endsection

</x-admin-master>
