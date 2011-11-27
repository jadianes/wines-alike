{*Smarty*}

{extends file="member.tpl"}

{block name="content"}

<!-- User stats here -->
<div class="row">
  <div class="hero-unit">
    <h3>Some insight about your taste...</h3>
      <li><a href="<script language=php> echo WA_WEBSITE_URL; </script>/reports/complete">my taste</a></li>
  </div>
</div>

	
<h3>{$ratings_title}</h3>
<hr>
<div class="row">
{foreach $ratings as $rating}
  {if $rating@iteration is div by 5}
  </div>
  <hr>
  <div class="row">
  {/if}
  <span class="span4 wine_rating">
  <h4>{$rating->producer_name}, {$rating->wine_name} {$rating->vintage_year}</h4>
  <p>{$rating->region_name}</p>
  <p>Average rating: {$rating->avg_rating} ({$rating->num_ratings} ratings)</p>
  <p>Your rating 
  {html_options name='your_rating$rating@index' options=$rating_options selected=$rating->rating}</p>
  </span>
{/foreach}
</div>

<hr>

{/block}