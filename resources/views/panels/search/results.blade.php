@foreach ($results as $res)
    <div class="col-md-3">
        <a href="{{route('entertainment.show',['entertainment' => $res->entertainment->id])}}">
            <div class="card">
                <img class="card-img-top" src="data:image/png;base64,{{$res->entertainment->poster->data}}"
                    alt="{{$res->title}}">
                <div class="card-body">
                    <h5 class="card-title">{{$res->title}}</h5>
                </div>
            </div>
        </a>
    </div>
@endforeach