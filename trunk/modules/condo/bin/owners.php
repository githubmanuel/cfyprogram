<?php
/*

  CFY program = CFY Business Management Suite

  Integrated enterprise applications to execute and optimize business and IT strategies.
  Enable you to perform essential, industry-specific, and business-support processes with modular solutions.

  Version: 0.0.0.1a
  Author: Ernesto La Fontaine
  Mail: mail@pajarraco.com
  License: New BSD License (see docs/license.txt)
  Redistributions of files must retain the copyright notice.

  File:
  Commnents:

 */
?>

<h1>Configuración de Propietarios</h1>
<section>
    <h2>Propietarios</h2>
    <p>Crear, Editar o Borrar los propietarios</p>
    <feditor style="display: none;">
        Documento: <input type="text" id="id_doc" value=""/><br />
        Nombre: <input type="text" id="name" value=""/><br />
        Apellidos: <input type="text" id="lastname" value=""/><br />
        Direccion: <input type="text" id="address" value=""/><br />

    </feditor>
   <fcontainer>
          <table>
        <thead>
            <tr>
                <td>Documento</td>
                <td>Nombre</td>
                <td>Apellidos</td>
                <td>Direccion</td>
                <td>Fecha de Registro</td>
                <td>&nbsp;</td>
            </tr>
        </thead>
        <tbody id="trow">
        </tbody>
    </table>

    </fcontainer>

</section>

