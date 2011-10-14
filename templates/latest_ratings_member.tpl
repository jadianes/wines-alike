{*Smarty*}

{extends file="member.tpl"}

{block name="content"}
<div id="main_view">
<div id="ratings_title">{$ratings_title}</div>
{foreach $ratings as $rating}
<div class="wine-rating">
  <h3>{$rating->producer_name}, {$rating->wine_name} {$rating->vintage_year}</h3>
  <p>{$rating->region}</p>
  <p>Average rating: {$rating->avg_rating} ({$rating->num_ratings} ratings)</p>
  <p>Your rating 
{html_options name='your_rating$rating@index' options=$rating_options selected=0}</p>

</div>
{/foreach}
</div>
{/block}