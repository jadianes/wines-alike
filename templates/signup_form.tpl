{* Smarty *}

<form class="form-stacked" method='post' action='<script language=php> echo WA_WEBSITE_URL; </script>/useractions/signup'>
	<fieldset>
	<legend>Not a member? Join us today!</legend>
	
	<div class="clearfix">
	    <div class="input">
	    <input class="large" name="email" size="30" maxlength="100" type="text" placeholder="email" />
	    </div>
	</div><!-- /clearfix -->	
	
	<div class="clearfix">
	    <div class="input">
	    <input class="large" name="username" size="30" maxlength="16" type="text" placeholder="User name" />
	    </div>
	</div><!-- /clearfix -->
	
	<div class="clearfix">
	    <div class="input">
	    <input class="large" name="passwd" size="30" maxlength="16" type="password" placeholder="Password" />
	    </div>
	</div><!-- /clearfix -->
	
	<input  class="btn success" type='submit' value='Sign up'>
	
    </fieldset>
</form>