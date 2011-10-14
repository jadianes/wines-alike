{* Smarty *}

{extends file="index.tpl"}

{block name="sidebar"}
    <div class="sidebar_isolated_message"> 
	<p>Join our wine community today and enjoy the most accurate recommentation engine. The more we know about your taste, the most accurate our suggestions will be.</p>
	</div>
{/block}

{block name="content"}
<h1>Not a member? Join us today!</h1>
<form id="register_form" method='post' action='register_new.php'>
    <p>Email address<input type='text' name='email' size=30 maxlength=100></p>
    <p>Username (max 16 chars)<input type='text' name='username' size=30 maxlength=16></p>
    <p>Password<input type='password' name='passwd' size=30 maxlength=16></p>
    <p>Confirm password<input type='password' name='passwd2' size=30 maxlength=16></p>
    <p><input type='submit' value='Register'></p>
</form>
{/block}

{block name="adds"}

{/block}