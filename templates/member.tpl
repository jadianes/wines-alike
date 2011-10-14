{* Smarty *}

{extends file="index.tpl"}

{block name="heading"}
	{* include file="logo.tpl" *}
	{include file="user_menu.tpl"}
{/block}

{block name="sidebar"}
    {include file="action_menu.tpl"}	
{/block}
	
{block name="content"} 
	<div id='main_view'>
	</div>
{/block}