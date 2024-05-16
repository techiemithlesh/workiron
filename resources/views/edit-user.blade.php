@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3 class="col-md-8 my-1">Edit User</h3>
                        {{-- <div class="col-md-4 text-end">
                            <a href="{{ route('create-user') }}" class="btn btn-primary">Add</a>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                	<form action="{{ route('update-user', [$user->id]) }}" method="POST">
                        <input type="hidden" value="PUT" name="_method" />
                		@csrf
                		<div class="form-group row mb-4">
                            <label class="col-md-4">Name</label>
                            <div class="col-md-8">
                                <input type="text" value="{{ old('name', $user->name) }}" name="name" class="form-control @error('name') is-invalid @enderror" />
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-md-4">Email</label>
                            <div class="col-md-8">
                                <input type="text" value="{{ old('email', $user->email) }}" name="email" class="form-control @error('email') is-invalid @enderror" />
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-md-4">Status</label>
                            <div class="col-md-8">
                                <input type="checkbox" {{ !empty($user->status) ? 'checked="checked"' : '' }} name="status" value="1" />
                            </div>
                        </div>

                        <p class="text-danger">If you want to change the password then fill the password fields, otherwise leave it blank</p>
                        <div class="form-group row mb-4">
                            <label class="col-md-4">Password</label>
                            <div class="col-md-8">
                                <input type="password" value="{{ old('password') }}" name="password" class="form-control @error('password') is-invalid @enderror" />
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-md-4">Confirm Password</label>
                            <div class="col-md-8">
                                <input type="password" value="{{ old('password_confirmation') }}" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" />
                                @error('password_confirmation')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('users') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                	</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection