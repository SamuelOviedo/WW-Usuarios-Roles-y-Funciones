<h1>{{mode_desc}}</h1>
<section>
  <form action="index.php?page=mnt_rol" method="post">
    <input type="hidden" name="mode" value="{{mode}}" />
    <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
    <input type="hidden" name="rolescod" value="{{rolescod}}" />
    <fieldset>
      <label for="rolescod">Código</label>
      <input {{if readonlyId}}readonly{{endif readonlyId}} type="text" id="rolescod" name="rolescod" placeholder="Código" value="{{rolescod}}"/>
      {{if error_rolescod}}
        {{foreach error_rolescod}}
          <div class="error">{{this}}</div>
        {{endfor error_rolescod}}
      {{endif error_rolescod}}
    </fieldset>
    <fieldset>
      <label for="rolesdsc">Descrición</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="rolesdsc" name="rolesdsc" placeholder="Descrición" value="{{rolesdsc}}" />
      {{if error_rolesdsc}}
        {{foreach error_rolesdsc}}
          <div class="error">{{this}}</div>
        {{endfor error_rolesdsc}}
      {{endif error_rolesdsc}}
    </fieldset>

    <fieldset>
      <label for="rolesest">Estado</label>
      <select name="rolesest" id="rolesest" {{if readonly}}readonly disabled{{endif readonly}}>
        {{foreach rolesestArr}}
        <option value="{{value}}" {{selected}}>{{text}}</option>
        {{endfor rolesestArr}}
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
      window.location.href = 'index.php?page=mnt_roles';
    });
  });
</script>