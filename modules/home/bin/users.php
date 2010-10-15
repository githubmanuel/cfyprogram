<?php
/*

  CFY program - CFY Business Management Suite

  Integrated enterprise applications to execute and optimize business and IT strategies.
  Enable you to perform essential, industry-specific, and business-support processes with modular solutions.

  Version: 0.0.0.1a
  Author: Ernesto La Fontaine
  Mail: mail@pajarraco.com
  License: New BSD License (see docs/license.txt)
  Redistributions of files must retain the copyright notice.

  File: index.php
  Commnents: Startup file.

 */
?>

<h1>Usuarios</h1>
<section>
    <h2>Tabla de Usuarios</h2>
    <div id="body_content">
        <div id="msgdiv" style="display: none" class="msgarea" title="Click para ocultar"></div>

        <!-- Our Search Controls -->
        <div id="searchdiv">
            <p class="sectionheader">To begin please use search to locate some products.</p>
            <form name="searchform">
                <input type="text" name="searchinp" size="20">
                <input type="hidden" name="pid" value="<?php echo $_GET["pid"]; ?>">
                <input type="hidden" name="table" value="usuarios">
                <input type="submit" name="submit" value="  Search  ">
                <span id="searchmsgspan"></span>
            </form>
        </div>

        <!-- Search Results section -->
        <div id="productdiv" class="searchresults" style="display: none"> <!-- style is here to remove slight flicker of page -->
            <p class="sectionheader">Search Results</p>
            <table width="400" class="searchresultstable" >
                <thead>
                    <tr class="tableheader">
                        <td class="desc-header">Usuario</td>
                        <td class="price-header">Clave</td>
                        <td class="price-header">Nivel</td>
                        <td class="price-header">Fecha</td>
                        <td class="price-header">Fecha</td>
                        <td class="control">Add</td>
                    </tr>
                </thead>
                <!-- IE requires a TBODY for this to work -->
                <tbody id="resultstable"></tbody>
            </table>
        </div>

        <!-- Cart Contents -->
        <div id="cartdiv" style="display: none"> <!-- style is here to remove slight flicker of page -->
            <p class="sectionheader">Shopping Cart</p>
            <table width="400" class="searchresultstable">
                <thead>
                    <tr class="tableheader">
                        <td>Amount</td>
                        <td class="desc-header">Product</td>
                        <td class="price-header">Price</td>
                        <td class="control">Delete</td>
                    </tr>
                </thead>
                <!-- IE requires a TBODY for this to work -->
                <tbody id="cartcontentstable"></tbody>
            </table>
        </div>


    </div>
</section>