{*Smarty*}

{extends file="member.tpl"}

{block name="content"}
<form id='add_rating_form' class="user_forms" action='add_ratings.php' method='post'>
<table>
	<tr><td>Wine name</td><td><input type='text' name='wine_name'  value="" size=30 maxlength=255></td></tr>
	<tr><td>Vintage year</td><td><input type='text' name='vintage_year'  value="" size=30 maxlength=255></td></tr>
	<tr><td>Region</td><td><input type='text' name='region'  value="" size=30 maxlength=255></td></tr>
	<tr><td>Winemaker</td><td><input type='text' name='producer'  value="" size=30 maxlength=255></td></tr>
	<tr><td>Your rating </td><td id="add_rating_your_rating">
		<select name="rating">
		 	<option value="1">Don't like it</option>
		 	<option value="2">Enjoyable</option>
		 	<option value="3">Nice one</option>
		 	<option value="4">Love it!</option>
		 	<option value="5">Religious experience...</option>
		</select>
	</td></tr>		 
<!--	<tr><td>Wine rating:</td><td><input type='text' name='rating'  value="" size=30 maxlength=255></td></tr>-->
	<tr><td colspan=2><input type='submit' value='Add rating'></td></tr>
</table>
</form>
{/block}