<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_ThzSeparator extends FW_Option_Type
{
    public function get_type()
    {
        return 'thz-separator';
    }

    /**
     * @internal
     */
    protected function _enqueue_static($id, $option, $data){}

    /**
     * @internal
     */
    protected function _render($id, $option, $data)
    {

        $wrapper_attr = array(
            'id'    => $option['attr']['id'],
            'class' => $option['attr']['class'],
        );

        unset(
            $option['attr']['id'],
            $option['attr']['class']
        );
		
       	$html  = '<div '. fw_attr_to_html($wrapper_attr) .'>';
        $html .= $option['html'];
        $html .= '</div>';

        return $html;
    }

    /**
     * @internal
     */
    protected function _get_value_from_input($option, $input_value)
    {
        return false;
    }

    /**
     * @internal
     */
    protected function _get_defaults()
    {

        return array(
            'value' => false,
			'html' => ''
        );
    }
}

FW_Option_Type::register('FW_Option_Type_ThzSeparator');