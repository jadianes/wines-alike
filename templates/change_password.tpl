{* Smarty *}

{extends file="member.tpl"}

{block name="content"}
    <form class="user_forms" action='change_password.php' method='post'>
	<p>Old password</p>
   	<input type='password' name='old_passwd' size=30 maxlength=40>
   	<p>New password</p>
   	<input type='password' name='new_passwd' size=30 maxlength=40>
   	<p>Repeat new password</p>
   	<input type='password' name='new_passwd2' size=30 maxlength=40>
   	<p><input type='submit' value='Change password'></p>
    </form>
{/block}