jQuery(document).ready(function($){
	
	//Append minimal admin variable to all urls if set - if statement done by PHP in wp_enqueue
	$('a[href]').each(function() {
				
		if ( !$(this).parent().hasClass('wp-editor-tabs') && $(this).attr('target') != "_blank" )
		{
	  		this.href += (/\?/.test(this.href) ? '&' : '?') + 'mp-stacks-minimal-admin=true';
		}
	});
			
});

