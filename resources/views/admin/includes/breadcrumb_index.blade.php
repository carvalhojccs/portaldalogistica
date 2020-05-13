<div class="row mb-2">
    <div class="col-sm-6">
        <h1>{{ ucfirst(request()->segment(2)) }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dasboard</a></li>
            <li class="breadcrumb-item">{{ ucfirst(request()->segment(2)) }}</li>
        </ol>
    </div>
</div>