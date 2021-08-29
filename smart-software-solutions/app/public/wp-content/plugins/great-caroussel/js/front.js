
	function position_content_caroussel(caroussel)
	{
		var width = jQuery(caroussel).width();
		var outerWidth = jQuery(caroussel).outerWidth();
		console.log(width);
		jQuery(caroussel).css('height', outerWidth/2);
		//on refait une fois car si scroll bar la width change
		width = jQuery(caroussel).width();
		outerWidth = jQuery(caroussel).outerWidth();
		jQuery(caroussel).css('height', outerWidth/2);
		jQuery(caroussel).find('.rotator').height(width);

		var nb = jQuery(caroussel).find('.content').length;
		jQuery(caroussel).find('.content').each(function(i, el){
			var deg = i * 360 / nb;
			var rad = deg * Math.PI / 180;
			var cos = Math.cos(rad);
			var sin = Math.sin(rad);
			var offset_x = (width/2 - 75) * sin;
			var offset_y = -(width/2 - 75) * cos;

			jQuery(el).css('transform', 'translate('+offset_x+'px, '+offset_y+'px) rotate('+deg+'deg)');
		});
	}

	jQuery(document).ready(function(){

		jQuery('.great_caroussel').each(function(){
			position_content_caroussel(this);
			jQuery('.great_caroussel .rotator').data('rotate', 0);
		});	

		jQuery(window).resize(function(){
			jQuery('.great_caroussel').each(function(){
				position_content_caroussel(this);
			});
		});
		
		jQuery('.great_caroussel .prev').click(function(){
			var rotator = jQuery(this).parent().find('.rotator')
			var deg = jQuery(rotator).data('rotate');
			var nb = jQuery(rotator).attr('rel');
			var new_deg = deg+360/nb;
			jQuery(rotator).css('transform', 'rotate('+new_deg+'deg)');
			jQuery(rotator).data('rotate', new_deg);
			return false;
		});

		jQuery('.great_caroussel .next').click(function(){
			var rotator = jQuery(this).parent().find('.rotator')
			var deg = jQuery(rotator).data('rotate');
			var nb = jQuery(rotator).attr('rel');
			var new_deg = deg-360/nb;
			jQuery(rotator).css('transform', 'rotate('+new_deg+'deg)');
			jQuery(rotator).data('rotate', new_deg);
			return false;
		});

	});