<form action="{{ route(request()->segment(2).'.search') }}" method="POST" class="form form-inline">
    @csrf
    <input type="text" name="nome" placeholder="Nome do Local" class="form-control-sm" value="{{ $filters['nome'] ?? '' }}">
    <input type="text" name="sigla" placeholder="Sigla do Local" class="form-control-sm" value="{{ $filters['sigla'] ?? '' }}">
    <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search">&nbsp;</i>Pesquisar</button>
    @if(isset($filters))
    <a href="{{ route(request()->segment(2).'.index') }}" class="btn btn-dark btn-sm"><i class="fas fa-sync"></i></a>
    @endif
</form>