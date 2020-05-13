@include('admin.includes.alerts')
<div class="form-group">
    <label>Local:</label>
    <select name="local_id" class="form-control" id="local">
        <option value="">Selecione um local...</option>
        @foreach($locais as $id => $local)
            <option value="{{$id}}"
                    @if(isset($data) && $data->local->id == $id)
                        selected
                    @endif
                    >{{$local}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" id="name" class="form-control" placeholder="Nome" value="{{ $data->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>Email:</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ $data->email ?? old('email') }}">
</div>
<div class="form-group">
    <label>Senha:</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Senha">
</div>
