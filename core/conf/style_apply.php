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
        <link href="http://localhost/cfy/styles/base/css/base.css" rel="stylesheet" type="text/css">
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="http://localhost/cfy/core/scripts/menu_bar.js" type="text/javascript"></script><link href="http://localhost/cfy/core/css/menu_bar.css" rel="stylesheet" type="text/css" /><link href="http://localhost/cfy/core/css/login.css" rel="stylesheet" type="text/css" /><script type="text/javascript" src="http://localhost/cfy/core/scripts/jquery-1.3.2.min.js"></script><?php require_once(PATH_site.$CORE["module"]["head_content"]); ?><?php require_once(PATH_site.$CORE["page"]["head_content"]); ?>
    </head>

    <body>
        <div class="container">
            <header>
                CFY Business Management Suite
            </header>
            <div class="sidebar">
                <nav>
                    <ul><li><a href="?pid=1">Inicio</a></li><li><a href="?pid=2">Adminitración</a></li><li><a href="?pid=3">Nomina</a></li><li><a href="?pid=4">Presupuesto</a></li></ul>
                </nav>
                <aside>
                    <p>prueba final de estilo</p>
                </aside>
                <!-- end .sidebar -->
            </div>
            <?php echo $myMenu->printMenu($CORE["page"]["menu"]); ?>
            <article class="content">
                <?php require_once(PATH_site.$CORE["page"]["content"]); ?>
                <!-- end .content -->
            </article>
            <footer>
                <p>&copy; CFY Program</p>
                <address >
                    http://www.pajarraco.com
                </address>
            </footer>
            <!-- end .container -->
        </div>
        <script type="text/javascript">var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"http://localhost/cfy/core/image/MenuBarDownHover.gif", imgRight:"http://localhost/cfy/core/image/MenuBarRightHover.gif"});</script>
    </body>
</html>