<h1>Seccion de Funciones</h1>
<section>

</section>
<section>
  <table>
    <thead>
      <tr>
        <th>Código</th>
        <th>Descripción</th>
        <th>Tipo</th>
        <th>Estado</th>
        <th><a href="index.php?page=Mnt-Funcion&mode=INS">Nuevo</a></th>
      </tr>
    </thead>
    <tbody>
      {{foreach Funciones}}
      <tr>
        <td>{{fncod}}</td>
        <td> <a href="index.php?page=Mnt-Funcion&mode=DSP&id={{fncod}}">{{fndsc}}</a></td>
        <td>{{fntyp}}</td>
        <td>{{fnest}}</td>
        <td>
          <a href="index.php?page=Mnt-Funcion&mode=UPD&id={{fncod}}">Editar</a>
          &NonBreakingSpace;
          <a href="index.php?page=Mnt-Funcion&mode=DEL&id={{fncod}}">Eliminar</a>
        </td>
      </tr>
      {{endfor Funciones}}
    </tbody>
  </table>
</section>