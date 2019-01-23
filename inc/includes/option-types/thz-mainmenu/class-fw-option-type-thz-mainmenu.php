<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_Thzmainmenu extends FW_Option_Type
{
    public function get_type()
    {
        return 'thz-mainmenu';
    }

    /**
     * @internal
     */
    protected function _enqueue_static($id, $option, $data)
    {
        $uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';

        wp_enqueue_style(
            'fw-option-'. $this->get_type(),
            $uri .'/css/styles.css'
        );
		wp_enqueue_style("wp-jquery-ui-dialog");
        wp_enqueue_script(
            'fw-option-'. $this->get_type().'-ThzMenuPreview',
            $uri .'/js/ThzMenuPreview.js',
            array('fw-events', 'jquery')
        );

        wp_enqueue_script(
            'fw-option-'. $this->get_type(),
            $uri .'/js/scripts.js',
            array('fw-events', 'jquery','jquery-ui-dialog','jquery-effects-scale')
        );
		
		
		wp_localize_script('fw-option-'. $this->get_type(), '_thzmp', array(
				'dialog_title'=>__('Top menu preview','creatus'),
			)
		);
		
    }

    /**
     * @internal
     */
    protected function _render($id, $option, $data)
    {
        /**
         * $data['value'] contains correct value returned by the _get_value_from_input()
         * You decide how to use it in html
         */
        $option['attr']['value'] = (string)$data['value'];
		
		$html ='<div class="mainmenu_preview_holder">';
			$html .='<ul class="tm_toplevel">';
				$html .='<li class="tm_link"><a data-tm_link="color"  data-tm_link_bg="background-color" href="#">Toplevel link</a></li>';
				$html .='<li class="tm_hovered"><a data-tm_link_hover="color" data-tm_link_hover_bg="background-color" href="#">Toplevel hovered<i class="childicon child-toplevel fa fa-caret-down"></i></a></li>';
				$html .='<li class="tm_active"><a data-tm_active_link="color" data-tm_active_link_bg="background-color" href="#">Toplevel active</a></li>';
			$html .='</ul>';
			$html .='<div class="sub_level_holder">';
				$html .='<ul class="tm_sublevel">';
					$html .='<li class="tm_sublevel_link" data-tm_subli_border="border-bottom-color"><a data-tm_subul_link="color" data-tm_subul_link_bg="background-color" href="#">Sublevel link</a></li>';
					$html .='<li class="tm_sublevel_hovered" data-tm_subli_border="border-bottom-color"><a data-tm_subul_link_hover="color" data-tm_subul_link_hover_bg="background-color" href="#">Sublevel hovered <i class="childicon child-sublevel fa fa-caret-down"></i></a>';
						$html .='<ul class="tm_sublevel tm_childul">';
						$html .='<li class="tm_child" data-tm_subul_style="border-color"><a data-tm_subul_link_hover="color" data-tm_subul_link_hover_bg="background-color" href="#">Next sublevel</a></li>';
						$html .='<li class="tm_child" data-tm_subul_style="border-color"><a data-tm_subul_link_hover="color" data-tm_subul_link_hover_bg="background-color" href="#">Next sublevel</a></li>';
						$html .='</ul>';
					$html .='</li>';
					$html .='<li class="tm_sublevel_active"><a data-tm_subul_active_link="color" data-tm_subul_active_link_bg="background-color" href="#">Sublevel active</a></li>';
				$html .='</ul>';
			$html .='</div>';
		$html .='</div>';

		$defaultvalue = isset($data['value']) && !empty($data['value']) ? $data['value'] : $html;
		
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
		
			'id' 			=> $id,
			'option'		=> $option,
			'data'			=> $data,
			'html'			=> $html,
			'defaultvalue'	=> $defaultvalue
			
		));
		
    }
	
	


	/**
	 * @internal
	 */
	protected function _get_value_from_input( $option, $input_value ) {
		return (string) ( is_null( $input_value ) ? $option['value'] : $input_value );
	}

    /**
     * @internal
     */
    protected function _get_defaults()
    {
        return array(
            'value' => ''
        );
    }
}

FW_Option_Type::register('FW_Option_Type_Thzmainmenu');