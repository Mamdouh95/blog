@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
                @php $user = Auth::user() @endphp
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.completeUpdate') }}">
                        @csrf
                        @method('put')

                        <p>{{ __('You completed 80% of your profile, please add your gender to continue using our site.') }}</p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" value="{{ $user->name }}" disabled required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="national_id" class="col-sm-4 col-form-label text-md-right">{{ __('National ID') }}</label>

                            <div class="col-md-6">
                                <input id="national_id" type="text" class="form-control" value="{{ $user->national_id }}" disabled required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" value="{{ $user->email }}" disabled required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-sm-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                <select id="gender" name="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                                    <option>{{ __('Choose your gender') }}</option>
                                    <option {{ old('gender') == \App\User::$gender['male'] ? 'selected':'' }} value="{{ \App\User::$gender['male'] }}">Male</option>
                                    <option {{ old('gender') == \App\User::$gender['female'] ? 'selected':'' }} value="{{ \App\User::$gender['female'] }}">Female</option>
                                </select>

                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="m-auto">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
