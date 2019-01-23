<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
/*
 * Modification of Lessphp Class darken lighten functions
 * http://leafo.net/lessphp
 * adapted from http://lesscss.org
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

class Thz_Color {
	
	public function __construct($hex){
		$this->thzcolor = $hex;
	}

	public function colorArgs($args) {
		
		if ($args[0] != 'list' || count($args[2]) < 2) {
			return array(array('color', 0, 0, 0), 0);
		}
		list($color, $delta) = $args[2];
		$delta = floatval($delta[1]);

		return array($color, $delta);
	}

	public function lib_lighten($args) {
		list($color, $delta) = $this->colorArgs($args);

		$hsl = $this->toHSL($color);
		$hsl[3] = $this->clamp($hsl[3] + $delta, 100);
		return $this->toRGB($hsl);
	}

	public function lib_darken($args) {
		list($color, $delta) = $this->colorArgs($args);

		$hsl = $this->toHSL($color);
		$hsl[3] = $this->clamp($hsl[3] - $delta, 100);
		return $this->toRGB($hsl);
	}

	public function toHSL($color) {
		if ($color[0] == 'hsl') return $color;

		$r = $color[1] / 255;
		$g = $color[2] / 255;
		$b = $color[3] / 255;

		$min = min($r, $g, $b);
		$max = max($r, $g, $b);

		$L = ($min + $max) / 2;
		if ($min == $max) {
			$S = $H = 0;
		} else {
			if ($L < 0.5)
				$S = ($max - $min)/($max + $min);
			else
				$S = ($max - $min)/(2.0 - $max - $min);

			if ($r == $max) $H = ($g - $b)/($max - $min);
			elseif ($g == $max) $H = 2.0 + ($b - $r)/($max - $min);
			elseif ($b == $max) $H = 4.0 + ($r - $g)/($max - $min);

		}

		$out = array('hsl',
			($H < 0 ? $H + 6 : $H)*60,
			$S*100,
			$L*100,
		);

		if (count($color) > 4) $out[] = $color[4]; // copy alpha
		return $out;
	}

	public function toRGB_helper($comp, $temp1, $temp2) {
		
		if ($comp < 0) $comp += 1.0;
		elseif ($comp > 1) $comp -= 1.0;

		if (6 * $comp < 1) return $temp1 + ($temp2 - $temp1) * 6 * $comp;
		if (2 * $comp < 1) return $temp2;
		if (3 * $comp < 2) return $temp1 + ($temp2 - $temp1)*((2/3) - $comp) * 6;

		return $temp1;
	}

	public function toRGB($color) {
		if ($color == 'color') return $color;

		$H = $color[1] / 360;
		$S = $color[2] / 100;
		$L = $color[3] / 100;

		if ($S == 0) {
			$r = $g = $b = $L;
		} else {
			$temp2 = $L < 0.5 ?
				$L*(1.0 + $S) :
				$L + $S - $L * $S;

			$temp1 = 2.0 * $L - $temp2;

			$r = $this->toRGB_helper($H + 1/3, $temp1, $temp2);
			$g = $this->toRGB_helper($H, $temp1, $temp2);
			$b = $this->toRGB_helper($H - 1/3, $temp1, $temp2);
		}

		$out = array('color', round($r*255), round($g*255), round($b*255));
		if (count($color) > 4) $out[] = $color[4]; // copy alpha
		return $out;
	}


	public function clamp($v, $max = 1, $min = 0) {
		return min($max, max($min, $v));
	}


	public function printColor($color) {
		
		if ($color[0] != 'color'){
			throw new exception("color expected for rgbahex");
		}
		
		if(strpos($this->thzcolor,'rgba') !==false){
			
			return 'rgba( '.$color[1].', '.$color[2].', '.$color[3].','.$color[4].')';
			
		}else{

			return sprintf("#%02x%02x%02x",$color[1],$color[2], $color[3]);
			
		}
	}
	
	public function colorRgb($color) {
		
		if(strpos($color,'rgba') !==false){
			
			$rgba = str_replace(array('rgba','(',')'), '', $color);
			$rgba = explode(',',$rgba);			
			
			$r = $rgba[0];
			$g = $rgba[1];
			$b = $rgba[2];
			$a = $rgba[3];
			
			 $rgb = array('color',$r, $g, $b, $a);
			
		}else{
		   
		   $color = preg_replace("/[^0-9A-Fa-f]/", '', $color);
		 
		   if(strlen($color) == 3) {
			  $r = hexdec(substr($color,0,1).substr($color,0,1));
			  $g = hexdec(substr($color,1,1).substr($color,1,1));
			  $b = hexdec(substr($color,2,1).substr($color,2,1));
		   } else {
			  $r = hexdec(substr($color,0,2));
			  $g = hexdec(substr($color,2,2));
			  $b = hexdec(substr($color,4,2));
		   }
		   
		   $rgb = array('color',$r, $g, $b);
		}
	  
	   return $rgb;
	}



	public function lighter($percent){
		$percent = str_replace('%', '', $percent);
		$args = array('list', ',', array($this->colorRgb($this->thzcolor), array('%', $percent)));
		return $this->printColor($this->lib_lighten($args));
	}


	public function darker($percent){
		$percent = str_replace('%', '', $percent);
		$args = array('list', ',', array($this->colorRgb($this->thzcolor), array('%', $percent)));
		return $this->printColor($this->lib_darken($args));
	}
	
	
    public function isLight($value) {
		
        $value = str_replace(' ', '', $value);
        $rgb = new \stdClass;
        $opacity = 1;
        
		if (substr($value, 0, 3) != 'rgba') {
			
            $value = str_replace('#', '', $value);
            if (strlen($value) == 3) {
                $h0 = str_repeat(substr($value, 0, 1), 2);
                $h1 = str_repeat(substr($value, 1, 1), 2);
                $h2 = str_repeat(substr($value, 2, 1), 2);
                $value = $h0 . $h1 . $h2;
            }
            $rgb->r = hexdec(substr($value, 0, 2));
            $rgb->g = hexdec(substr($value, 2, 2));
            $rgb->b = hexdec(substr($value, 4, 2));
			
        } else {
			
            preg_match("/(\\d+),\\s*(\\d+),\\s*(\\d+)(?:,\\s*(1\\.|0?\\.?[0-9]?+))?/uim", $value, $matches);
            $rgb->r = $matches[1];
            $rgb->g = $matches[2];
            $rgb->b = $matches[3];
            $opacity = isset($matches[4]) ? $matches[4] : 1;
            $opacity = substr($opacity, 0, 1) == '.' ? '0' . $opacity : $opacity;
        }
		
		
        $yiq = ((($rgb->r * 299) + ($rgb->g * 587) + ($rgb->b * 114)) / 1000) >= 128;
        $contrast = $yiq || ($opacity == 0 || (float) $opacity < 0.45);
		
		return $contrast;
      
    }
	
	
	public function isDark($value) {
		
		return !$this->isLight($value);
	}
	
	
    public function brightness($color) {
		
		$rgb = $this->colorRgb($color);
		
        $brightness = ((($rgb[1] * 299) + ($rgb[2] * 587) + ($rgb[3] * 114)) / 1000);
        
		return $brightness;
      
    }	
}