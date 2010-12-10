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
        <link href="http://192.168.137.50/cfyprogram/styles/base/css/base.css" rel="stylesheet" type="text/css">
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="http://192.168.137.50/cfyprogram/core/scripts/menu_bar.js" ></script><script src="http://192.168.137.50/cfyprogram/core/scripts/msg_function.js" ></script><script src="http://192.168.137.50/cfyprogram/core/scripts/jquery-1.4.4.js" ></script><script src="http://192.168.137.50/cfyprogram/core/scripts/jquery.form.js" ></script><link href="http://192.168.137.50/cfyprogram/core/css/menu_bar.css" rel="stylesheet" type="text/css" /><?php require_once(PATH_site.$CORE["module"]["head_content"]); ?><?php require_once(PATH_site.$CORE["page"]["head_content"]); ?>
    </head>

    <body>
        <div class="container">
            <header>
                CFY Business Management Suite
            </header>
            <div class="sidebar">
                <nav>
                    <ul><li><a href="?pid=1">Inicio</a></li><li><a href="?pid=2">Personal</a></li><li><a href="?pid=3">Administración</a></li><li><a href="?pid=4">Reservaciones</a></li><li><a href="?pid=5">Presupuesto</a></li></ul>
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
        <script type="text/javascript">var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"http://192.168.137.50/cfyprogram/core/image/MenuBarDownHover.gif", imgRight:"http://192.168.137.50/cfyprogram/core/image/MenuBarRightHover.gif"});</script>
    </body>
</html>