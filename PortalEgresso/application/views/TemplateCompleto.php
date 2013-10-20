<?php echo doctype();?>
<html>
<head>
{css}
        {meta}
<title>{title}</title>
{js}
</head>
<body>
<div id="wrapper">
  <div id="header">{header}</div>
  <div id="navigation">{navigation}</div>
  <div id="content">
    <div id="largura">
      <div id="login"> {menu} <div style="clear:both"></div></div>
      
      <div id="conteudo"> {content} </div>
   
    <div id="footer">{rodape}</div>
    </div>
  </div>
</div>
</body>
</html>
