{* Smarty *}

{extends file="index.tpl"}

{block name="content"}
    <form class="user_forms" action='reset_password.php' method='post'>
    <p>Enter your email<input type='text' name='email' size=40 maxlength=256></p>
    <input type='submit' value='Change password'>
    </form> 
{/block}