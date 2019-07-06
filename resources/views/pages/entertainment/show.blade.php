@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <div class="profile-picture">
                <img src="data:image/png;base64,{{$entertainment->poster->data}}" class="img-responsive" alt="">
            </div>
            <div class="profile-title">
                <a href="{{$entertainment->urls->first()->url}}">{{$entertainment->entertainmentDetails->title}}</a>
            </div>
            <e-seen :entertainment={{ $entertainment->id }} 
            :seen={{ empty(Auth::user()->entertainments()->find($entertainment->id)->pivot->seen) ? 'false' : 'true' }}>
            </e-seen>
            <star-rating></star-rating>
        </div>
    </div>
</div>
@endsection
