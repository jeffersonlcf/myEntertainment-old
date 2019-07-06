@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Search Entertainment') }}</div>

                <div class="card-body">
                    <form method="GET" action="{{ route('entertainment.search_results') }}">
                        <div class="form-group row text-center">
                            <div class="col-md-12">
                                <input id="q" type="text" class="form-control{{ $errors->has("q") ? ' is-invalid' : '' }}" name="q" value="{{ old("q") }}" required autofocus>

                                @if ($errors->has("q"))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first("q") }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-4 text-center">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @isset($results)
    <div class="row justify-content-center py-4">
        <div class="col-md-10">
            <div class="row">
                @include('panels.search.results')
            </div>
        </div>
    </div>
    @endisset

</div>
@endsection
