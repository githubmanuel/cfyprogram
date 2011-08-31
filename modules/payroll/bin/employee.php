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

<h1>Empleados</h1>
<section>
    <h2>Listado de emleados</h2>
    <p></p>
    <feditor style="display: none;">
        <flabel>Nombre:</flabel>
        <ffield><input type="text" id="name" value=""/></ffield>
        <flabel>Cargo:</flabel>
        <ffield><input type="text" id="position" value=""/></ffield>
        <flabel>Fecha de Ingreso:</flabel>
        <ffield><input type="text" id="started_date" value=""/></ffield>
          <flabel>Sueldo:</flabel>
        <ffield><input type="text" id="income" value=""/></ffield>
           <flabel>Periodo:</flabel>
        <ffield><input type="text" id="period" value=""/></ffield>
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
                    <td>Cargo</td>
                    <td>Fecha de Ingreso</td>
                    <td>Sueldo</td>
                    <td>Periodo</td>
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

