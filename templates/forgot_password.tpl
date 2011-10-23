{* Smarty *}

{extends file="index.tpl"}

{block name="content"}
    <form action='reset_password.php' method='post'>
		<fieldset>
			<legend>Reset your password</legend>
			<div class="clearfix">
			    <label for="email">e-mail</label>
			    <div class="input">
			    <input class="xlarge" name="email" size="40" maxlength="256" type="text" />
			    </div>
			</div><!-- /clearfix -->
			<div class="actions">
    		<input class="btn primary" type='submit' value='Change password'>
			</div>
		</fieldset>
    </form> 
{/block}