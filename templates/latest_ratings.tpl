{*Smarty*}

{extends file="index.tpl"}

{block name="content"}
<div id="main_view">
<div id="ratings_title">{$ratings_title}</div>
{foreach $ratings as $rating}
<div class="wine-rating">
  <h3>{$rating->producer_name}, {$rating->wine_name} {$rating->vintage_year}</h3>
  <p>{$rating->region}</p>
  <p>Average rating: {$rating->avg_rating} ({$rating->num_ratings} ratings)</p>
</div>
{/foreach}
</div>
{/block}