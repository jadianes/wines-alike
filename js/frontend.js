$(document).ready(function() {
	// Add rating combo behaviour
	$('#wine_rating select').bind('change', function(event)
		{
			var name = $(this).parent().find('#name').text();
			var producer = $(this).parent().find('#producer').text();
			var region = $(this).parent().find('#region').text();
			var vintage = $(this).parent().find('#vintage').text();
			var rating = $(this).val();
			var base_url = <?php require_once('../models/config.php'); out.print('WA_WEBSITE_URL'); ?>;
			$.post(base_url+'/actions/add_rating',
				{wine_name: name, 
				 producer: producer, 
				 region: region, 
				 vintage_year: vintage,
				 rating: rating
				 }
			); /* do something when succeed? -> update other combos in the list... */
		}
	);
});
 
 