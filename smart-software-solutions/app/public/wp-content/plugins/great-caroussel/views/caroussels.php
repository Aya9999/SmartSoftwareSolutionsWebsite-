<script>

		jQuery(document).ready(function(){

			jQuery('#great-caroussels .remove').click(function(){
				var gc = jQuery(this).parent().parent('.great-caroussel');
				jQuery.post(ajaxurl, {action: 'remove_gc', id: jQuery(this).attr('rel'), _ajax_nonce: '<?= wp_create_nonce( "remove_gc" ); ?>' }, function(){
					jQuery(gc).remove();
				});
			});

		});

</script>

<h2>All great carrousels</h2>
<form action="" method="post" id="form_new_gc">
<?php wp_nonce_field( 'new_gc' ) ?>
<b>Add a new carrousel</b><br />
	<label>Name: </label><input type="text" name="name" /><br />
	<input type="submit" value="Add" />
</form>

<div id="great-caroussels">
<?php

if(sizeof($caroussels) > 0)
{
	foreach($caroussels as $caroussel)
	{
		echo '<div class="great-caroussel"><form action="" method="post" class="gc_form">'.wp_nonce_field( 'update_gc_'.$caroussel->id, "_wpnonce", true, false );
		echo '<label>Name : </label><input type="text" name="name" value="'.$caroussel->name.'" /><input type="hidden" name="id" value="'.$caroussel->id.'" /> <br />';
		echo '<input type="image" src="'.plugins_url( 'images/save.png', dirname(__FILE__)).'" title="Save" />	
		<a href="'.admin_url().'?page=great_caroussels&id='.$caroussel->id.'" title="Edit this great caroussel"><img src="'.plugins_url( '/images/contents.png', dirname(__FILE__)).'" class="action" /></a> <img title="Remove this great carrousel" class="remove action" rel="'.$caroussel->id.'" src="'.plugins_url( 'images/remove.png', dirname(__FILE__) ).'" />
		Shortcode : <i>[great-caroussel id='.$caroussel->id.']</i>
		</form>
		</div>';
	}
}
else
	echo 'No great caroussel found yet!';

?>
</div>

<h3><br />Need help? <a href="http://www.info-d-74.com" target="_blank">Click for support</a> <br/>
and like InfoD74 to discover my new plugins: <a href="https://www.facebook.com/infod74/" target="_blank"><img src="<?php echo plugins_url( 'images/fb.png', dirname(__FILE__)) ?>" alt="" /></a></h3>