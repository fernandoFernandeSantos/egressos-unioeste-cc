<?php echo doctype();?>
<html>
    <head>
        {css}
        {meta}
        <title>{title}</title>
    </head>
    <body>

        <div id="wrapper">
            <div id="header">{header}</div>
            <div id="navigation">{navigation}</div>
            <div id="content">


                <div id="content-main">
                    {content}
                </div>

                <div id="content-right">
                    {left_menu}
                </div>


            </div>
            <div id="footer">{rodape}</div>
            <div id="bottom"></div>
        </div>


    </body>
</html>

