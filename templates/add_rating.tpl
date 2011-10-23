{*Smarty*}

{extends file="member.tpl"}

{block name="content"}
<form id='add_rating_form' action='add_ratings.php' method='post'>
	<fieldset>
		<legend>Add new rating</legend>
		
		<div class="clearfix">
		    <label for="region">Region</label>
		    <div class="input">
		    <input class="xlarge" name="region" size="30" maxlength="255" type="text" />
		    </div>
		</div><!-- /clearfix -->
		
		<div class="clearfix">
		    <label for="producer">Winemaker</label>
		    <div class="input">
		    <input class="xlarge" name="producer" size="30" maxlength="255" type="text" />
		    </div>
		</div><!-- /clearfix -->
		
		<div class="clearfix">
		    <label for="wine_name">Wine name</label>
		    <div class="input">
		    <input class="xlarge" name="wine_name" size="30" maxlength="255" type="text" />
		    </div>
		</div><!-- /clearfix -->		

		<div class="clearfix">
		    <label for="vintage_year">Vintage year</label>
		    <div class="input">
		    <input class="xlarge" name="vintage_year" value="" size="30" maxlength="255" type="text" />
		    </div>
		</div><!-- /clearfix -->
			
		<div class="clearfix">
		    <label for="rating">Your rating</label>
		    <div class="input">
				<select name="rating">
				 	<option value="1">Don't like it</option>
				 	<option value="2">Enjoyable</option>
				 	<option value="3">Nice one</option>
				 	<option value="4">Love it!</option>
				 	<option value="5">Religious experience...</option>
				</select>
		    </div>
		</div><!-- /clearfix -->

		<div class="actions">
				<input  class="btn primary" type='submit' value='Add rating'>
		</div>
    
    </fieldset>
</form>
{/block}