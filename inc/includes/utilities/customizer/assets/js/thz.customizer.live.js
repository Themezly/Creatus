/**
 * http://manual.unyson.io/en/latest/options/customizer.html
 */
( function( $ ) {
	
/*    wp.customize( 'fw_options[temp_custom_css]', function( value ) {

        value.bind( function( newval ) {

            newval = JSON.parse(newval);
            newval = thz_replace_palette_colors(newval[0].value);

			if ( $("#creatus-customizer-live").length > 0 ) {
				$("#creatus-customizer-live").remove();
			 }
				  			
			$('head').append('<style id="creatus-customizer-live">'+ newval + '</style>');
			
        } );
    });*/
	
	
    wp.customize( 'fw_options[layout_type]', function( value ) {
        value.bind( function( newval ) {

            newval = JSON.parse(newval);
 			
			if( 'boxed' == newval[0].value ){
				
				$('.thz-body-container').attr('style','');
				$('.thz-wrapper').addClass('thz-layout-boxed thz-site-width');
				
			}else{
				
				$('.thz-wrapper').removeClass('thz-layout-boxed thz-site-width');
				$(document).ThzSite('thzBodyContainerWidth');
			}
			
        } );
    });
	
    wp.customize( 'fw_options[site_width]', function( value ) {
        
		value.bind( function( newval ) {
		
            newval = JSON.parse(newval);
 			newval = thz_property_unit(newval[0].value,'px');
			 
			if ( $("#creatus-customizer-site-width").length > 0 ) {
				$("#creatus-customizer-site-width").remove();
			 }
				  			
			$('head').append('<style id="creatus-customizer-site-width">.thz-site-width,.thz-wrapper.thz-site-width .thz-reveal-footer,.thz-layout-boxed .header_holder{max-width:'+ newval + ';}</style>');
			if($('.thz-items-grid').length > 0){
				$(document).ThzMasonry('ThzMasnorySizeItems','.thz-items-grid');
			}
			
        } );
    });
	
	
} )( jQuery );

thz_replace_palette_colors = function(string) {
	
	if (string.indexOf('color_') !== -1) {

		if ($('#fw-option-theme_palette').length > 0) {
			
			var $theme_palette = JSON.parse($('#fw-option-theme_palette').attr('data-palette-set'));
			
		}else{
			
			var $theme_palette = JSON.parse(thz_customizer_vars.thz_palette);
		}

		$.each($theme_palette, function(name, color) {
			
			 if (color.indexOf('darker') !== -1 || color.indexOf('lighter') !== -1 || color.indexOf('contrast') !== -1) {
				 
				 var $data 		= color.split('_');
				 var $shade 	= $data[1];
				 var $percent 	= $data[2] ? $data[2] : null;
				 var $color_1 	= $theme_palette['color_1'];
				 
				 if($shade =='darker'){
					
					color  = tinycolor( $color_1 ).darken($percent).toString();
				 
				 }else if($shade =='lighter'){
					 
					 color  = tinycolor( $color_1 ).lighten($percent).toString();
					 
				 }else if($shade =='contrast'){
					 
					 color  = tinycolor( $color_1 ).getBrightness() >= 128 || tinycolor( $color_1 ).getAlpha() < 0.45 ? '#000000' : '#ffffff';
				 }

			 }
			 
			// https://jsfiddle.net/fqqLdxkz/3/
			string = string.replace(new RegExp('\\b' + name + '\\b', 'g'), color);

		});

	}

	return string;

};

thz_property_unit = function($val,$default,$auto,$none) {	
		
	if($val ==''){
		return;
	}
	
	
	if($auto && $val.indexOf('auto') !== -1){
		
		return 'auto';
	}
	
	if($none && $val.indexOf('none') !== -1){
		
		return 'none';
	}
	
	var $allowed = ['px','em','rem','%','vh','vw','vmin','vmax','auto'];	
	
	var $value 	= parseFloat($val);
	var $unit 	= $default;
	
	$.each($allowed, function (index, un){
		
		if($val.indexOf(un) !== -1){
			$unit = un;
		}
		
	});

	return $value + $unit;
};