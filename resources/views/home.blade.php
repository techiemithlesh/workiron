@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h3>Admin Dashboard</h3>
            <hr />
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-warning mb-3">
                        <div class="card-body users row" style="cursor: pointer;">
                            <div class="col">
                                <div class="lead">Users</div>
                                <h2 class="card-title">{{ $users }}</h2>
                            </div>
                            <div class="col text-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-success text-white mb-3">
                        <div class="card-body reports row" style="cursor: pointer;">
                            <div class="col">
                                <div class="lead">Inspections</div>
                                <h2 class="card-title">{{ $reports }}</h2>
                            </div>
                            <div class="col text-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-file-earmark-check-fill" viewBox="0 0 16 16">
                                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m1.354 4.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".card-body.users").on("click", function(){
                window.location = '{{ route('users') }}';
            });
            $(".card-body.reports").on("click", function(){
                window.location = '{{ route('vehicle-inspections') }}';
            });
        });
    </script>
@endpush
