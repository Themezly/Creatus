(function($, fwe) {

    fwe.on('fw:options:init', function(data) {
		
        data.$elements.find('.fw-option.fw-option-type-thz-ace:not(.thz-option-initialized)').each(function() {
				
		   var $id 			= $(this).attr('id');
		   var $editorid 	= $(this).parent().find('.thz-ace-editor').attr('id');
		   var $mode 		= $(this).attr('data-mode');
		   var $theme 		= $(this).attr('data-theme');
		   var textarea 	= $('#'+$id);
		   var editor 		= ace.edit($editorid);
		  
			editor.resize();// nudge the editor in case is hidden 
			//editor.renderer.updateFull();		   
		   editor.setTheme("ace/theme/" + $theme);
		   editor.getSession().setMode("ace/mode/" + $mode);
		   editor.setFontSize('16px');
		   editor.getSession().on('change', function () {
			   textarea.val(editor.getSession().getValue());
		   });
		   
		    if($mode != 'css'){
				var session = editor.getSession();
				session.setUseWorker(false);
			}
		   if($mode == 'html'){
/*				var session = editor.getSession();
				session.setUseWorker(false);
				session.on("changeAnnotation", function() {
				  var annotations = session.getAnnotations()||[], i = len = annotations.length;
				  while (i--) {
					if(/doctype first\. Expected/.test(annotations[i].text)) {
					  annotations.splice(i, 1);
					}
				  }
				  if(len>annotations.length) {
					session.setAnnotations(annotations);
				  }
				});*/
		   }
		
		   textarea.val(editor.getSession().getValue());

        }).addClass('thz-option-initialized');

    });

})(jQuery, fwEvents);