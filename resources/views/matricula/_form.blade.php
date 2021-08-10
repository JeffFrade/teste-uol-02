<div class="row">
    @include('util.errors')

    <div class="col-md-3">
        <div class="form-group">
            <label for="aluno_id"><span class="required">*</span> Nome do Aluno:</label>
            <select id="aluno_id" name="aluno_id" class="form-control select2">
                @foreach($alunos as $aluno)
                    <option value="{{ $aluno->id }}" {{ (old('aluno_id', $matricula->aluno_id ?? '') == $aluno->id?'selected="selected"':'') }}>{{ $aluno->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="curso_id"><span class="required">*</span> Nome do Curso:</label>
            <select id="curso_id" name="curso_id" class="form-control select2">
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ (old('curso_id', $matricula->curso_id ?? '') == $curso->id?'selected="selected"':'') }}>{{ $curso->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="ativo"><span class="required">*</span> Status:</label>
            <select id="ativo" name="ativo" class="form-control select2">
                <option value="1" {{ (old('ativo', $matricula->ativo ?? '') == 1?'selected="selected"':'') }}>Ativo</option>
                <option value="0" {{ (old('ativo', $matricula->ativo ?? '') == 0?'selected="selected"':'') }}>Inativo</option>
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="data_admissao"><span class="required">*</span> Data de Admissão:</label>
            <input type="text" id="data_admissao" name="data_admissao" class="form-control datepicker" placeholder="Data de Admissão" value="{{ old('data_admissao', $matricula->data_admissao ?? '') }}">
        </div>
    </div>
</div>
