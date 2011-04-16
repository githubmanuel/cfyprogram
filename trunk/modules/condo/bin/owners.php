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
        <flabel>Documento:</flabel>
        <ffield><input type="text" id="id_doc" value=""/></ffield>
        <flabel>Nombre:</flabel>
        <ffield><input type="text" id="name" value=""/></ffield>
        <flabel>Apellidos:</flabel>
        <ffield><input type="text" id="lastname" value=""/></ffield>
        <flabel>Direccion:</flabel>
        <ffield><input type="text" id="address" value=""/></ffield>
        <flabel>
            <fbotton id="botton-save">
                <a id="cancelbotton" title="Cancelar" class="cancelbotton" ></a>
                <a id="savebotton" title="Guardar" class="savebotton"></a>
            </fbotton>
        </flabel>

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
        <ftotal>
            <span></span>
            <a id="newbotton"  title="Nuevo" class="newbotton" ></a>
        </ftotal>
    </fcontainer>

</section>

