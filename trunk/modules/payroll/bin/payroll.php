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

<h1>Nomina</h1>
<section>
    <h2>Nomina de Empleados</h2>
    <p>Asignaciones por empleado</p>
    <feditor style="display: none;">
        <flabel>Nombre de Empleado:</flabel>
        <input type="hidden" id="id" value="" />
        <ffield>
            <select name="employee_name" id="employee_name" >
            </select>
        </ffield>
        <flabel>Asignación:</flabel>
        <ffield>
            <select name="assignment_name" id="assignment_name">
            </select>
        </ffield>
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
                    <td>Cargo</td>
                    <td>Sueldo</td>
                    <td>Asignación</td>
                    <td>Monto de Asignación</td>
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

