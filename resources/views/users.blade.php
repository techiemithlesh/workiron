@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3 class="col-md-8 my-1">Users</h3>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('create-user') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th># of Inspections</th>
                                <th>Last updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ !empty($user->status) ? 'Enabled' : 'Disabled' }}</td>
                                    <td>{{ $user->inspectionDetails->count() }}
                                    <td>{{ $user->updated_at->format("Y-m-d H:i:s") }}</td>
                                    <td>
                                        <a href="{{ route('edit-user', [$user->id]) }}" class="btn btn-primary"><i class="bi-pencil"></i></a>
                                        @if($user->id !== auth('web')->user()->id)
                                            <a href="{{ route('delete-user', [$user->id]) }}" class="btn btn-danger delete-btn"><i class="bi-trash"></i></a>
                                            <form method="post" action="{{ route('delete-user', [$user->id]) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE" />
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function(){
        $(".delete-btn").click(function(e){
            e.preventDefault();
            if(confirm("Are you sure you want tot delete this user?")){
                $(this).next("form").submit();
            }
        });
    });
</script>
@endpush
