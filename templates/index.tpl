{* Smarty *}

{extends file="base.tpl"}

{block name="header"}
	{include file="header_content.tpl"}
{/block}

{block name="sidebar"}
    {include file="info.tpl"}
    {include file="login_form.tpl"}	
{/block}
	
{block name="content"} 
			<div id='main_view'>
			</div>
{/block}

{block name="footer"}
     {include file="footer_content.tpl"}
{/block}
