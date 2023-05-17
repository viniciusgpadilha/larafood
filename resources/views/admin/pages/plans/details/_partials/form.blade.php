@csrf

<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $details->name ?? old('name') }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-info">Enviar</button>
</div>