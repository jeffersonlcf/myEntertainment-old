<div class="card">
    <div class="card-header @role('admin', true) bg-secondary text-white @endrole">
        Welcome {{ Auth::user()->name }}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <a href="{{route('entertainment.create')}}" class="btn btn-primary btn-block">Create</a>
            </div>
            <div class="col-lg-4">
                <a href="{{route('entertainment.search')}}" class="btn btn-primary btn-block">Search</a>
            </div>
            <div class="col-lg-4">
                <a href="{{route('entertainment.create')}}" class="btn btn-primary btn-block">Create</a>
            </div>
        </div>
    </div>
</div>
