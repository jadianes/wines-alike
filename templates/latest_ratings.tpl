{*Smarty*}

{extends file="index.tpl"}

{block name="content"}

<!-- Featured Wine here -->
<div class="row">
  	<div class="hero-unit ">
	<span class="span8">	
		{include file="info.tpl"}
	</span>
	<div class="span6">
		{include file="signup_form.tpl"}
	</div>
	
	</div>
</div>

<!-- Latest Ratings -->
<hr>
<div class="row">
{foreach $ratings as $rating}
	<span id="wine_rating" class="span4 rating">
		<h5><span id="producer">{$rating->producer_name}</span> <span id="name">{$rating->wine_name}</span> 
			<span id="vintage">{$rating->vintage_year}</span>
		</h5>
  		<p><span id="region">{$rating->region_name}</span></p>
		<p>Rating: {$rating->rating} (by {$rating->user_name})</p>
  		<p>Average: {$rating->avg_rating|truncate:4:""} ({$rating->num_ratings} ratings)</p>
</span>
{/foreach}
</div>

<hr>

{/block}