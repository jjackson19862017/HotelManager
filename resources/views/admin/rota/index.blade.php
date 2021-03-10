<x-admin-master>
    @section('content')
        <div class="container-fluid mt-1">
            <div class="row">
                <div class="card mb-4 w-100">
                    <div class="card-header h4">
                        {{$hotel->name}} - Week Commencing: {{date('l jS M Y', strtotime($IsAMonday))}}
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
@endsection
</x-admin-master>
