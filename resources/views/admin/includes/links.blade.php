@if(isset($filter))
    {{ $data->appends($filter)->links() }}
@else
    {{ $data->links() }}
@endif