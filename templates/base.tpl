 {* Smarty *}

<!DOCTYPE html>
<html>
<head>
    {block name="head"}{/block}
</head>

<body>
	<div class="topbar" data-dropdown="dropdown" >
		<div class="topbar-inner">
			<div class="container">
				<h3><a href="latest_ratings_html.php">{$sitename}</a></h3>
				{block name="header"}{/block}
			</div>
		</div>
	</div>

    <div class="container">
        <div class="content">
            {block name="content"}{/block}
			<div id="footer">
				{block name="footer"}{/block}
			</div>
	    </div>
	</div>
	
</body>
</html>