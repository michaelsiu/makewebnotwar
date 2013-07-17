<div id="event">
	<?php get_social_icons(); ?>

	<div class="thumb">#_EVENTIMAGE</div>
	
	#_NOTES
	
	<div class="clear"></div>
	
	<h3><?php _e( 'Event Information' , 'webnotwar' ); ?></h3>
	<div class="col2-set">
		<div class="col-1">
			<div class="item">	
				<strong class="category">Date/Time</strong><br/>
				<strong>#l</strong><br />
				#M #j#S, #Y #@_{ \u\n\t\i\l M jS, Y}<br />
				<i>#_12HSTARTTIME to #_12HENDTIME</i>
			</div>
			<div class="item">	
				<strong class="category">Location</strong><br/>
				#_LOCATIONLINK
			</div>
			<div class="item">	
				<strong class="category">Category(ies)</strong>
				#_CATEGORIES
			</div>
		</div>
		<div class="col-2">
			#_LOCATIONMAP
		</div>			
	</div>
	
	<div class="clear"></div>
	
	{has_bookings}
	<h3>Attendees</h3>
	<div class="attendees">
		#_ATTENDEES
	</div>
	
	<h3>Bookings</h3>
	#_BOOKINGFORM
	{/has_bookings}
</div>	
