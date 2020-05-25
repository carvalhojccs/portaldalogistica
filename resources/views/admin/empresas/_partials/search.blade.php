<form action="{{ route(request()->segment(2).'.search') }}" method="POST" class="form form-inline">
    @csrf
    <input type="text" name="nome" placeholder="Nome da empresa" class="form-control-sm" value="{{ $filters['nome'] ?? '' }}">
    <input type="text" name="cnpj" placeholder="CNPJ" class="form-control-sm" value="{{ $filters['cnpj'] ?? '' }}">
    <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search">&nbsp;</i>Pesquisar</button>
    @if(isset($filters))
    <a href="{{ route(request()->segment(2).'.index') }}" class="btn btn-dark btn-sm"><i class="fas fa-sync"></i></a>
    @endif
</form>