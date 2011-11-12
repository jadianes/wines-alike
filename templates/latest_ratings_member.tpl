{*Smarty*}

{extends file="member.tpl"}

{block name="content"}

<!-- Featured Wine here -->
<div class="row">
  <div class="hero-unit">
    <h2>Featured wine!</h2>
      <p>Vestibulum id ligula porta felis euismod semper. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
    <p><a class="btn primary large">Learn more »</a></p>
  </div>
</div>

<!-- Latest Ratings -->
<h3>{$ratings_title}</h3>
<hr>
<div class="row">
{foreach $ratings as $rating}
  {if $rating@iteration is div by 5}
  </div>
  <hr>
  <div class="row">
  {/if}
  <span class="span4 rating">
    <h4>{$rating->producer_name}, {$rating->wine_name} {$rating->vintage_year}</h4>
    <p>{$rating->region_name}</p>
    <p>Average rating: {$rating->avg_rating|truncate:4:""} ({$rating->num_ratings} ratings)</p>
    <p>Your rating 
    {html_options name='your_rating$rating@index' options=$rating_options selected=0}</p>
  </span>
{/foreach}
</div>

<hr>

{/block}