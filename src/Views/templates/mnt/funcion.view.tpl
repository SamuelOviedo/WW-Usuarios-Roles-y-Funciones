<h1>{{mode_desc}}</h1>
<section>
  <form action="index.php?page=mnt_funcion" method="post">
    <input type="hidden" name="mode" value="{{mode}}" />
    <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
    <input type="hidden" name="fncod" value="{{fncod}}" />
    <fieldset>
      <label for="fndsc">Descripción</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="fndsc" name="fndsc" placeholder="Descripcion" value="{{fndsc}}"/>
      {{if error_fndsc}}
        {{foreach error_fndsc}}
          <div class="error">{{this}}</div>
        {{endfor error_fndsc}}
      {{endif error_fndsc}}
    </fieldset>
    <fieldset>
      <label for="fntyp">Tipo</label>
      <select name="fntyp" id="fntyp" {{if readonly}}readonly disabled{{endif readonly}}>
        {{foreach fntypArr}}
        <option value="{{value}}" {{selected}}>{{text}}</option>
        {{endfor fntypArr}}
      </select>
    </fieldset>
    <fieldset>
      <label for="fnest">Estado</label>
      <select name="fnest" id="fnest" {{if readonly}}readonly disabled{{endif readonly}}>
        {{foreach fnestArr}}
        <option value="{{value}}" {{selected}}>{{text}}</option>
        {{endfor fnestArr}}
      </select>
    </fieldset>
    <fieldset>
      {{if showBtn}}
        <button type="submit" name="btnEnviar">{{btnEnviarText}}</button>
        &nbsp;
      {{endif showBtn}}
      <button name="btnCancelar" id="btnCancelar">Cancelar</button>
    </fieldset>
  </form>
</section>
<script>
  document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('btnCancelar').addEventListener('click', function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.href = 'index.php?page=mnt_funciones';
    });
  });
</script>