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

<h1>Users File</h1>
<section>
    <h2>Probando el insert</h2>
    <p>Este si lo puedes cambiar.</p>
    <div id="login_body">
        <p class="pagetitle">Tabla de Usuarios</p>

        <div id="msgdiv" style="display: none" class="msgarea" title="Click para ocultar"></div>

        <!-- Our Search Controls -->
        <div id="searchdiv">
            <p class="sectionheader">To begin please use search to locate some products.</p>

            <form name="searchform">
                <input type="text" name="searchinp" size="20">
                <input type="hidden" name="pid" value="1-3">
                <input type="submit" name="submit" value="  Search  ">
                <span id="searchmsgspan"></span>
            </form>
        </div>

        <!-- Search Results section -->
        <DIV id="productdiv" class="searchresults" style="display: none"> <!-- style is here to remove slight flicker of page -->
            <p class="sectionheader">Search Results</p>
            <TABLE width="400" class="searchresultstable">
                <THEAD>
                    <TR class="tableheader">
                        <TD class="desc-header">Product</TD>
                        <TD class="price-header">Price</TD>
                        <TD class="control">Add</TD>
                    </TR>
                </THEAD>
                <!-- IE requires a TBODY for this to work -->
                <TBODY id="resultstable"></TBODY>
            </TABLE>
        </DIV>

        <!-- Cart Contents -->
        <DIV id="cartdiv" style="display: none"> <!-- style is here to remove slight flicker of page -->
            <p class="sectionheader">Shopping Cart</p>
            <TABLE width="400" class="searchresultstable">
                <THEAD>
                    <TR class="tableheader">
                        <TD>Amount</TD>
                        <TD class="desc-header">Product</TD>
                        <TD class="price-header">Price</TD>
                        <TD class="control">Delete</TD>
                    </TR>
                </THEAD>
                <!-- IE requires a TBODY for this to work -->
                <TBODY id="cartcontentstable"></TBODY>
            </TABLE>
        </DIV>


    </div>
</section>
