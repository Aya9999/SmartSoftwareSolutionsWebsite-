<script>
	jQuery(document).ready(function($){

		//changement d'ordre des contents
		jQuery('#great-caroussel').sortable({
			update: function( event, ui ) {
				//effectuer le changement de position en BDD par Ajax
				jQuery.post(ajaxurl, {action: 'gc_order_content', id: jQuery(ui.item).attr('rel'), order: (ui.item.index()+1), _ajax_nonce: '<?= wp_create_nonce( "order_content_gc" ); ?>' });
			}
		});

	    //ajout de la carte
	    jQuery('#form_new_gc').submit(function(){
	    	//save TinyMCE
	    		tinyMCE.triggerSave();
	    	if(jQuery('#form_new_gc textarea[name=content]').val() == '')
	    		alert('Content can\'t be empty !');
	    	else
	    	{	    		
	    		//on ajoute le contenu en ajax
	    		jQuery.post(ajaxurl, jQuery(this).serialize(), function(id_img){
	    			window.location.reload();
		    	});
			}
	    	return false;
	    });

		//click suppression
	    jQuery('#great-caroussel img.remove').click(function(){
	    	var _this = this;
	    	jQuery.post(ajaxurl, {action: 'gc_remove_content', id: jQuery(_this).attr('rel'), _ajax_nonce: '<?= wp_create_nonce( "remove_content_gc" ); ?>'}, function(){
	    		jQuery(_this).parent('li').remove();
	    	});
	    });

	    //click sauvegarde
	    jQuery('.form_edit_gc_content').submit(function(){
	    	var _this = this;
	    	//save TinyMCE
	    	tinyMCE.triggerSave();
	    	if(jQuery(_this).find('textarea[name=content]').val() == '')
	    		alert('Text can\'t be empty !');
	    	else
	    	{
		    	//affiche le gif loading
		    	jQuery(_this).find('img.loading').show();

		    	//enregistre les données saisies dans l'éditeur TinyMCE avant envoi Ajax
		    	editor = tinyMCE.get( jQuery(this).find('.wp-editor-area').attr('id') );
		    	if(editor)
		    		editor.save();

		    	//save ajax
		    	jQuery.post(ajaxurl, jQuery(this).serialize(), function(){
		    		//récupère la nouvelle image		    		
		    		jQuery(_this).find('img.loading').hide();
		    	});
		    }
	    	return false;
	    });
	});
</script>

<h2><?= $caroussel->name ?></h2>
<form action="" method="post" id="form_new_gc">
	<?php wp_nonce_field( 'new_content_gc' ) ?>
	<input type="hidden" name="id" value="<?= $caroussel->id ?>" />
	<input type="hidden" name="action" value="gc_add_content" />
	<b>Add a new content</b><br />
	<label>Text: </label> <?php wp_editor( '', 'content') ?><br />
	<input type="submit" value="Add the content" />
</form>

<ul id="great-caroussel">
<?php

	if(sizeof($contents) > 0)
	{
		foreach($contents as $content)
		{
			echo '<li rel="'.$content->id.'"><img class="remove" rel="'.$content->id.'" src="'.plugins_url( 'images/remove.png', dirname(__FILE__) ).'" />
			<form class="form_edit_gc_content">'.
				wp_nonce_field( 'update_content_gc_'.$content->id, "_wpnonce", true, false ).'
				<input type="hidden" name="id" value="'.$content->id.'" />
				<input type="hidden" name="action" value="gc_save_content" />				
				<label>Text: </label>';
				wp_editor( $content->content, 'text_'.$content->id, array('textarea_name' => 'content'));
				echo '<br />				
				<input type="submit" value="Save" /><img src="'.plugins_url( 'images/loading.gif', dirname(__FILE__) ).'" class="loading" />
			</form>
			</li>';
		}
	}
	else
		echo 'No content found for this great carrousel!';

?>
</ul>