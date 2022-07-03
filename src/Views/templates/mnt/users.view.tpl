<h1>Administración de Usuarios</h1>
<section>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>&nbsp;Usuario</th>
                <th>&nbsp;Correo</th>
                <th>&nbsp;Contraseña</th>
                <th>&nbsp;Ingreso</th>
                <th>&nbsp;PSW Estado</th>
                <th>&nbsp;PSW Expira</th>
                <th>&nbsp;Estado</th>
                <th>&nbsp;Código de Activación</th>
                <th>&nbsp;Contraseña de Cambio</th>
                <th>&nbsp;Tipo</th>
                <th>&nbsp;<a href="index.php?page=Mnt-User&mode=INS">Nuevo</a></th>
            </tr>
        </thead>
        <tbody>
            {{foreach Users}}
                <tr>
                    <td>{{usercod}}</td>
                    <td>&nbsp;<a href="index.php?page=Mnt-User&mode=DSP&id={{usercod}}">{{username}}</a></td>
                    <td>&nbsp;{{useremail}}</td>
                    <td>&nbsp;{{userpswd}}</td>
                    <td>&nbsp;{{userfching}}</td>
                    <td>&nbsp;{{userpswdest}}</td>
                    <td>&nbsp;{{userpswdexp}}</td>
                    <td>&nbsp;{{userest}}</td>
                    <td>&nbsp;{{useractcod}}</td>
                    <td>&nbsp;{{userpswdchg}}</td>
                    <td>&nbsp;{{usertipo}}</td>
                    <td>
                        &nbsp;<a href="index.php?page=Mnt-User&mode=UPD&id={{usercod}}">Actualizar</a>
                        &NonBreakingSpace;
                        &nbsp;<a href="index.php?page=Mnt-User&mode=DEL&id={{usercod}}">Eliminar</a>
                    </td>
                </tr>
            {{endfor Users}}
        </tbody>
    </table>
</section>