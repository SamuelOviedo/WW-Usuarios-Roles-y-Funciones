<!--Por medio de mode_desc veremos que estamos haciendo en el formulario-->
<h1>{{mode_desc}}</h1>
<section>
    <form action="index.php?page=mnt_user" method="post">
        <!--Colocamos los campos que nos ayudaran con la descripción y la seguridad-->
        <input type="hidden" name="mode" value="{{mode}}" />
        <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
        <input type="hidden" name="usercod" value="{{usercod}}" />

        <!--Campos para poder agregar un nuevo usuario-->
        <fieldset>
            <label for="useremail">Correo electrónico: </label>
            <input {{if readonly}}readonly{{endif readonly}} type="text" name="useremail" id="useremail" placeholder="ejemplo@gmail.com" value="{{useremail}}">
        
            <!-- Realizamos la validación correspondinte al campo -->
            {{if error_useremail}}
                {{foreach error_useremail}}
                    <div class="error">{{this}}</div>
                {{endfor error_useremail}}
            {{endif error_useremail}}
        </fieldset>

        <fieldset>
            <label for="username">Nombre usuario: </label>
            <input {{if readonly}}readonly{{endif readonly}} type="text" name="username" id="username" placeholder="Nombre de usuario" value="{{username}}">
        
            <!--Realizamos condiciones por posibles errores que se presenten-->
            {{if error_username}}
                {{foreach error_username}}
                    <div class="error">{{this}}</div>
                {{endfor error_username}}
            {{endif error_username}}
        </fieldset>

        <fieldset>
            <label for="userpswd">Contraseña: </label>
            <input {{if readonly}}readonly{{endif readonly}} type="text" name="userpswd" id="userpswd" placeholder="Escriba la contraseña" value="{{userpswd}}">

            <!-- Realizamos las validaciones correspondientes -->
            {{if error_userpswd}}
                {{foreach error_userpswd}}
                    <div class="error">{{this}}</div>
                {{endfor error_userpswd}}
            {{endif error_userpswd}}
        </fieldset>

        <fieldset>
            <label for="userfching">Fecha de Ingreso: </label>
            <input type="text" name="userfching" id="userfching" placeholder="AAAA-MM-DD" value="{{userfching}}">
        
            <!-- Realizamos las validaciones correspondientes -->
            {{if error_userfching}}
                {{foreach error_userfching}}
                    <div class="error">{{this}}</div>
                {{endfor error_userfching}}
            {{endif error_userfching}}
        </fieldset>

        <fieldset>
            <label for="userpswdest">Estado contraseña: </label>
            <select name="userpswdest" id="userpswdest" {{if readonly}}readonly disabled{{endif readonly}}>
                {{foreach userpswdestArr}}
                    <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor userpswdestArr}}
            </select>
        </fieldset>

        <fieldset>
            <label for="userpswdexp">Expiración de contraseña: </label>
            <input type="text" name="userpswdexp" id="userpswdexp" placeholder="Expira: AAAA-MM-DD" value="{{userpswdexp}}">
        
            <!-- Realizamos las validaciones correspondientes -->
            {{if error_userpswdexp}}
                {{foreach error_userpswdexp}}
                    <div class="error">{{this}}</div>
                {{endfor error_userpswdexp}}
            {{endif error_userpswdexp}}
        </fieldset>

        <fieldset>
            <label for="userest">Estado: </label>
            <select name="userest" id="userest" {{if readonly}}readonly disabled{{endif readonly}}>
                {{foreach userestArr}}
                    <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor userestArr}}
            </select>
        </fieldset>

        <fieldset>
             <label for="useractcod">Código de activación: </label>
            <input type="text" name="useractcod" id="useractcod" placeholder="Código usuario activo" value="{{useractcod}}">
        
            <!-- Realizamos las validaciones correspondientes -->
            {{if error_useractcod}}
                {{foreach error_useractcod}}
                    <div class="error">{{this}}</div>
                {{endfor error_useractcod}}
            {{endif error_useractcod}}
        </fieldset>

        <fieldset>
             <label for="userpswdchg">Cambio de contraseña: </label>
            <input type="text" name="userpswdchg" id="userpswdchg" placeholder="Cualquier cosa" value="{{userpswdchg}}">
        
            <!-- Realizamos las validaciones correspondientes -->
            {{if error_userpswdchg}}
                {{foreach error_userpswdchg}}
                    <div class="error">{{this}}</div>
                {{endfor error_userpswdchg}}
            {{endif error_userpswdchg}}
        </fieldset>
        
        <fieldset>
            <label for="usertipo">Cargo: </label>
            <select name="usertipo" id="usertipo" {{if readonly}}readonly disabled{{endif readonly}}>
                {{foreach usertipoArr}}
                    <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor usertipoArr}}
            </select>
        </fieldset>

    <!--Botones de confirmación a las operaciones-->
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
      window.location.href = 'index.php?page=mnt_users';
    });
  });
</script>