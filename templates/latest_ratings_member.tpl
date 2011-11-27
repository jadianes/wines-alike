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
  <span class="span4 wine_rating">
    <h5><span id="producer">{$rating->producer_name}</span> <span id="name">{$rating->wine_name}</span> 
		<span id="vintage">{$rating->vintage_year}</span>
	</h5>
    <p><span id="region">{$rating->region_name}</span></p>
	<p>Rating: {$rating->rating} (by {$rating->user_name})</p>
    <p>Average: {$rating->avg_rating|truncate:4:""} ({$rating->num_ratings} ratings)</p>
	<p>Your rating</p>
	{if isset($rating->user_rating)}
    	{html_options name='your_rating' options=$rating_options selected=$rating->user_rating}
	{else}
		{html_options name='your_rating' options=$rating_options selected=0}
	{/if}
  </span>
{/foreach}
</div>

<hr>

{/block}