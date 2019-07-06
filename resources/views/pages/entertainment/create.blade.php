@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Add New Entertainment') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('entertainment.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('URL') }}</label>

                            <div class="col-md-6">
                                <input id="url" type="text" class="form-control{{ $errors->has("url") ? ' is-invalid' : '' }}" name="url" value="{{ old("url") }}" required autofocus>

                                @if ($errors->has("url"))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first("url") }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <div class="col-md-6 offset-md-4">
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
