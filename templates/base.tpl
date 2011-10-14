 {* Smarty *}

<!DOCTYPE html>
<html>
<head>
    {block name="header"}{/block}
</head>

<body>
     <div id="container">
	    <div id="heading">
		    {include file="logo.tpl"}
	    	{block name="heading"}{/block}
	    </div>
	    
        <div id="sidebar">
            {block name="sidebar"}{/block}            		
        </div>
		
        <div id="content">
            {block name="content"}{/block}
	    </div>

        <div id="adds">
		    {block name="adds"}
			  {include file="adds.tpl"} 
			{/block} 
		</div> 

        <div id="footer">
            {block name="footer"}{/block}
        </div>
    </div>
</body>
</html>