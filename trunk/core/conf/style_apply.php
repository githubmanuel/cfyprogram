<!--

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

-->
<!DOCTYPE HTML>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>CFY program</title>
        <link href="http://lab.pajarraco.com/cfy/styles/base/css/base.css" rel="stylesheet" type="text/css">
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="http://lab.pajarraco.com/cfy/core/scripts/menu_bar.js" ></script><script src="http://lab.pajarraco.com/cfy/core/scripts/jquery-1.4.4.js" ></script><script src="http://lab.pajarraco.com/cfy/core/scripts/jquery.form.js" ></script><script src="http://lab.pajarraco.com/cfy/core/scripts/general_function.js" ></script><link href="http://lab.pajarraco.com/cfy/core/css/menu_bar.css" rel="stylesheet" type="text/css" /><?php require_once(PATH_site.$CORE["module"]["head_content"]); ?><?php require_once(PATH_site.$CORE["page"]["head_content"]); ?>
    </head>

    <body>
        <div class="container">
            <header>
                <company_name>Lab pajarraco.com</company_name>
                CFY Business Management Suite
            </header>
            <div class="sidebar">
                <nav>
                    <ul><li><a href="?pid=2">Nomina</a></li><li><a href="?pid=3">Administración</a></li><li><a href="?pid=5">Presupuesto</a></li><li><a href="?pid=6">Condominio</a></li><li><a href="?pid=99">Configuración</a></li></ul>
                </nav>
                <aside>
                </aside>
                <!-- end .sidebar -->
            </div>
            <?php if ($CORE["page"]["menu"]){echo $myMenu->printMenu($CORE["page"]["menu"]);} ?>
            <content>
                <user>Usuario:&nbsp;<b><?php echo $_SESSION["MM_Username"]; ?></b></user><?php require_once(PATH_site.$CORE["page"]["content"]); ?>
                <!-- end .content -->
            </content>
            <footer>
                &copy; CFY Program
                <address>
                    http://www.pajarraco.com
                </address>
            </footer>
            <!-- end .container -->
        </div>
        <script type="text/javascript">var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"http://lab.pajarraco.com/cfy/core/image/MenuBarDownHover.gif", imgRight:"http://lab.pajarraco.com/cfy/core/image/MenuBarRightHover.gif"});</script>
    </body>
</html>