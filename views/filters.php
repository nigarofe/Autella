<!--Filtro - disciplina-->
<div id="disciplineSelection_container" class="w-25 mt-1 mr-3" hidden>
    <label for="disciplines">Disciplina:</label>
    <select name="disciplines" id="disciplines" class="form-control" onchange="updateSubjects()">
        <?php selectDisciplineNames(1); ?>
    </select>
</div>
<!--Filtro - matéria-->
<div name="selection_container" class="w-25 mt-1 mr-3">
    <label for="subjects">Matéria:</label>
    <select name="subjects" id="subjects" class="form-control">
        <!--updateSubjects()-->
    </select>
</div>
<!--Filtro - dificuldade-->
<div name="selection_container" class="w-25 mt-1 mr-3">
    <label for="dificulty">Dificuldade:</label>
    <select name="dificulty" id="dificulty" class="form-control">
        <option value="" selected>Escolha...</option>
        <option value="1">Fácil</option>
        <option value="2">Média</option>
        <option value="3">Difícil</option>
    </select>
</div>
<!--Filtro - data-->
<div name="selection_container" class="w-25 mt-1">
    <label for="date">Data de criação:</label>
    <input id="date" type="date" class="form-control">
</div>