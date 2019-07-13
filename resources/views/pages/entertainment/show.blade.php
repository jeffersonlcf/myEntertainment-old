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
            <div>
                <e-seen :entertainment={{ $entertainment->id }} 
                :seen={{ empty(Auth::user()->entertainments()->find($entertainment->id)->pivot->seen) ? 'false' : 'true' }}>
                </e-seen>
            </div>
            <div class="col-md-4 offset-md-4">
                <s-rating :entertainment={{ $entertainment->id }} 
                :rating={{ empty(Auth::user()->entertainments()->find($entertainment->id)->pivot->rating) ? 0 : Auth::user()->entertainments()->find($entertainment->id)->pivot->rating }}>
                </s-rating>
            </div>
        </div>
    </div>
</div>
@endsection
