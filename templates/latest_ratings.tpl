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
  {if $rating@iteration is div by 5}
  </div>
  <hr>
  <div class="row">
  {/if}
  <span class="span4">
    <h4>{$rating->producer_name}, {$rating->wine_name} {$rating->vintage_year}</h4>
    <p>{$rating->region_name}</p>
    <p>Average rating: {$rating->avg_rating|truncate:4:""} ({$rating->num_ratings} ratings)</p>
  </span>
{/foreach}
</div>

<hr>

{/block}