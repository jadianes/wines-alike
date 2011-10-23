{* Smarty *}

{extends file="member.tpl"}

{block name="content"}
    <form class="user_forms" action='change_password.php' method='post'>
	<fieldset>
		<legend>Change your password</legend>
		
		<div class="clearfix">
		    <label for="old_password">Old password</label>
		    <div class="input">
		    <input class="xlarge" name="old_password" size="30" maxlength="40" type="password" />
		    </div>
		</div><!-- /clearfix -->

		<div class="clearfix">
		    <label for="new_password">New password</label>
		    <div class="input">
		    <input class="xlarge" name="new_password" size="30" maxlength="40" type="password" />
		    </div>
		</div><!-- /clearfix -->
				
		<div class="clearfix">
		    <label for="new_password2">Repeat password</label>
		    <div class="input">
		    <input class="xlarge" name="new_password2" size="30" maxlength="40" type="password" />
		    </div>
		</div><!-- /clearfix -->

		<div class="actions">
				<input  class="btn primary" type='submit' value='Change password'>
		</div>
 
	</fieldset>
    </form>
{/block}