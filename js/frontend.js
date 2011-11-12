$(document).ready(function() {
	// Add rating combo behaviour
	$('select[name*="your_rating"]').bind('change', function(event)
		{
			alert("al");
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
 
 