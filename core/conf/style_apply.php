<!DOCTYPE HTML>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>CFY program</title>
        <link href="http://pajarraco.homeip.net/cfyprogram/styles/base/css/base.css" rel="stylesheet" type="text/css">
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="core/scripts/menu_bar.js" type="text/javascript"></script><link href="core/css/menu_bar.css" rel="stylesheet" type="text/css" /><link href="core/css/login.css" rel="stylesheet" type="text/css" /><script type="text/javascript" src="core/scripts/jquery-1.3.2.min.js"></script>
    </head>

    <body>
        <div class="container">
            <header>
                CFY Business Management Suite
            </header>
            <div class="sidebar">
                <nav>
                    <ul><li><a href="?pid=1">Home</a></li><li><a href="?pid=2">Administración</a></li><li><a href="?pid=3">Presupuesto</a></li></ul>
                </nav>
                <aside>
                    <p>prueba final de estilo</p>
                </aside>
                <!-- end .sidebar -->
            </div>
            <?php require($CORE["page"]["menu"]); ?>
            <article class="content">
                <?php require($CORE["page"]["content"]); ?>
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
        <script type="text/javascript">var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"core/image/MenuBarDownHover.gif", imgRight:"core/image/MenuBarRightHover.gif"});</script>
    </body>
</html>