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

<h1>Gastos</h1>
<section>
    <h2>Gastos Generales</h2>
    <p>Crear, Editar o Borrar los gastos</p>
    <feditor style="display: none;">
        <flabel>Codigo:</flabel>
        <ffield><input type="text" id="code" value=""/></ffield>
        <flabel>Nombre:</flabel>
        <ffield><input type="text" id="name" value=""/></ffield>
        <flabel>Descripcion:</flabel>
        <ffield><input type="text" id="description" value=""/></ffield>
        <flabel>Tipo:</flabel>
        <ffield><input type="text" id="type" value=""/></ffield>
          <flabel>Monto:</flabel>
        <ffield><input type="text" id="amount" value=""/></ffield>
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
                    <td>Codigo</td>
                    <td>Nombre</td>
                    <td>Descripcion</td>
                    <td>Tipo</td>
                    <td>Monto</td>
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

