{* Smarty *}

{extends file="member.tpl"}

{block name="content"}
<h2>{$username}, some statistics about your taste</h2>

<div class="stats-frame">
<h3>General</h3>
<p>Number of ratings: {$numratings}</p>
<p>Total average rating: {$avgrating}</p>
</div>

<div class="stats-frame">
<h3>By region</h3>
<p>Number of regions tasted: {$numregions}</p>

</div>

<div class="stats-frame">
<h3>By vintage</h3>
<p>Number of vintages: {$numvintages}</p>

</div>

<div class="stats-frame">
<h3>By rating</h3>
<p>Number of 5 stars ratings: {$num5ratings}</p>
<p>Number of 4 stars ratings: {$num4ratings}</p>
<p>Number of 3 stars ratings: {$num3ratings}</p>
<p>Number of 2 stars ratings: {$num2ratings}</p>
<p>Number of 1 stars ratings: {$num1ratings}</p>
</div>

<div class="stats-frame">
<h3>Affinity statistics</h3>
<p>Your wines-alike users: </p>
<p>- Distance with user 1: </p>
<p>- Suggestions received from user 1: </p>
<p>- Suggestions given to user 1: </p>
<p>Total given suggestions: </p>
<p>Total received suggestions: </p>
</div>

{/block}

