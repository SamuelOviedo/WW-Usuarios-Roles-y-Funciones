<h1>Trabajar con Roles</h1>
<section>

</section>
<section>
    <table>
       <thead>
           <tr>
               <th>Id</th>
               <th>Descrición</th>
               <th>Estado</th>
               <th><a href="index.php?page=Mnt-Rol&mode=INS">Nuevo</a></th>
           </tr>
       </thead> 
       <tbody>
           {{foreach Roles}}
           <tr>
               <td>{{rolescod}} </td>
               <td><a href="index.php?page=Mnt-Rol&mode=DSP&id={{rolescod}}">{{rolesdsc}}</a></td>
               <td>{{rolesest}}</td>
               <td>
                   <a href="index.php?page=Mnt-Rol&mode=UPD&id={{rolescod}}">Editar</a>
                   &NonBreakingSpace;
                   <a href="index.php?page=Mnt-Rol&mode=DEL&id={{rolescod}}">Eliminar</a>
               </td>
           </tr>
           {{endfor Roles}}
       </tbody>
    </table>
</section>