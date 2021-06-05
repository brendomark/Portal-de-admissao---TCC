<div class="row dependentes dependente-{{DEP}}">
  <div class="col-10 title">
    dependente #{{DEP}}
    <i class="fas fa-trash dependente__del" data-id="{{DEP}}"></i>
  </div>
</div>
<div class="row dependente-{{DEP}}">
  <div class="col-4 col-12-xsmall" id="nometeste">
    <h5>Nome Completo</h5>
    <input type="text" name="nomedep[]" id="nomedep[]" value="" placeholder="Nome" style="text-transform:uppercase"/>
  </div>
  <div class="col-4 col-12-xsmall" id="datanascimentoteste">
    <h5>Data Nascimento </h5>
    <input type="text" name="dtnascdep[]" id="dtnascdep[]" value="" placeholder="Data" style="text-transform:uppercase" maxlength="10" onkeypress="$(this).mask('00/00/0000')"/>
  </div>
  <div class="col-4 col-12-xsmall">
    <h5>Parentesco</h5>
    <select id="parentescodep[]" name="parentescodep[]" style="text-transform:uppercase">
      <option value="">Parentesco</option>
      <option value="0">Filho(a)</option>
      <option value="1">Pai</option>
      <option value="2">Mãe</option>
      <option value="3">Outros</option>
    </select>
  </div>
</div>
<div class="row dependentes__row2 dependente-{{DEP}}">
  <div class="col-4 col-12-xsmall">
    <h5>CPF</h5>
    <input type="text" name="cpfdep[]" id="cpfdep[]" value="" placeholder="CPF" maxlength="14" onkeypress="$(this).mask('000.000.000-00');" style="text-transform:uppercase"/>
  </div>
  <div class="col-4 col-12-xsmall">
    <h5>I.R</h5>
    <select id="irdep[]" name="irdep[]" style="text-transform:uppercase">
      <option value="">IR</option>
      <option value="0">Não</option>
      <option value="1">Sim</option>
    </select>
  </div>
  <div class="col-4 col-12-xsmall">
    <h5>Mãe do Dependente</h5>
    <input type="text" name="maedep[]" id="maedep[]" value="" placeholder="Nome" style="text-transform:uppercase"/>
  </div>
</div>
