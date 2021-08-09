<div class="row">
    @include('util.errors')

    <div class="col-md-4">
        <div class="form-group">
            <label for="nome"><span class="required">*</span> Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="{{ old('nome', $aluno->nome ?? '') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="email"><span class="required">*</span> E-mail:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email', $aluno->email ?? '') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="senha"><span class="required">*</span> Senha:</label>
            <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" value="{{ old('senha', '') }}">
        </div>
    </div>
</div>
