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
    <div id="login_body">
        <p class="pagetitle">Welcome to the Ajax Shopping Cart!</p>

        <div id="msgdiv" style="display: none" class="msgarea" title="Click to hide"></div>

        <!-- Our Search Controls -->
        <DIV id="searchdiv">
            <p class="sectionheader">To begin please use search to locate some products.</p>

            <form name="searchform">
                <INPUT type="text" name="searchinp" size="20">
                <input type="hidden" name="pid" value="1-4">
                <INPUT type="submit" name="submit" value="  Search  ">
                <SPAN id="searchmsgspan"></SPAN>
            </form>
        </DIV>

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

        <DIV id="userDetailsDiv" style="display: none">Please provide your
            name and email so we can contact you about your order.
            <p></p>
            <table>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="name" value="" size="0"
                               maxlength="40" id="name" /></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" value="" size="0"
                               maxlength="40" id="email" /></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="button"
                                                          name="Checkout" value="Checkout" id="finalcheckout" /></td>
                </tr>
            </table>

        </DIV>
    </div>
</section>