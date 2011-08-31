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

<h1>Asignaciones</h1>
<section>
    <h2>Listado de asignaciones</h2>
    <p></p>
    <feditor style="display: none;">
        <flabel>Nombre:</flabel>
        <ffield><input type="text" id="name" value=""/></ffield>
        <flabel>Tipo:</flabel>
        <ffield><input type="text" id="type" value=""/></ffield>
        <flabel>Monto:</flabel>
        <ffield><input type="text" id="amount" value=""/></ffield>
        <flabel>Porcentaje:</flabel>
        <ffield><input type="text" id="percentage" value=""/></ffield>
        <fbotton id="botton-save">
            <a id="cancelbotton" title="Cancelar" class="cancelbotton" ></a>
            <a id="savebotton" title="Guardar" class="savebotton"></a>
        </fbotton>
    </feditor>
    <fcontainer>
        <table>
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>tipo</td>
                    <td>Monto</td>
                    <td>Porcentaje</td>
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

