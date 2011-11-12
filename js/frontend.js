$(document).ready(function() {
	window.alert("jQuery loaded");
	// Add rating combo behaviour
	$('select[name*="your_rating"]').bind('change', function(event)
		{
			window.alert("al");
			/*
			$.post('actions/add_rating',
				{wine_name:$(), 
				 producer:$(), 
				 region:$(), 
				 vintage_year:$(),
				 rating:$()
				 }
			);*/
		}
	);
});
 
 