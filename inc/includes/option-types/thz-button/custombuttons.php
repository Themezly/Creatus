<?php  if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
$customButtonsArray = array();

/*
$customButtonsArray['thz-btn-sample']=array(
		'html' 	=> '',
		'css' 	=> '',
		'json' 	=> '',
);

*/

$customButtonsArray['thz-btn-readmore']=array(
		'html' 	=> '<div class="thz-btn-container thz-btn-readmore"><a class="thz-button thz-btn-none thz-align-center"><span class="thz-btn-text thz-fs-14 thz-fw-600">Read more</span></a></div>',
		'css' 	=> '',
		'json' 	=> '{"activeColor":"none","buttonSizeClass":"none","buttonText":"Read more","customClass":"thz-btn-readmore","fontWeight":"600"}',
);


$customButtonsArray['thz-btn-thumbs-up']=array(
		'html' 	=> '<div class="thz-btn-container thz-btn-thumbs-up thz-btn-icon-right"><a class="thz-button thz-btn-yellow thz-btn-small thz-radius-4 thz-btn-border-1 thz-align-center" href="#"><span class="thz-btn-text thz-fs-12 thz-fw-400"><i class="fa fa-thumbs-o-up thz-ifw-0 thz-is-md"></i></span></a></div>',
		'css' 	=> '',
		'json' 	=> '{"activeColor":"yellow","buttonSizeClass":"small","buttonText":"","customClass":"thz-btn-thumbs-up","buttonIcon":"fa fa-thumbs-o-up","iconType":"inline","iconSize":"thz-is-md","iconSpace":0}',
);


$customButtonsArray['thz-btn-gradient-tobottom']=array(
		'html' 	=> '<div class="thz-btn-container thz-btn-gradient-tobottom"><a class="thz-button thz-btn-pink thz-btn-medium thz-radius-4 thz-btn-border-1 thz-align-center" href="#"><span class="thz-btn-text thz-fs-14 thz-fw-400">Lovely!</span><span class="thz-btn-gradient-overlay thz-btn-ga-tobottom"></span></a></div>',
		'css' 	=> '',
		'json' 	=> '{"activeColor":"pink","buttonSizeClass":"medium","customClass":"thz-btn-gradient-tobottom","buttonGradient":"tobottom"}',
);


$customButtonsArray['thz-btn-topinset']=array(
		'html' 	=> '<div class="thz-btn-container thz-btn-topinset"><a class="thz-button thz-btn-medium thz-btn-border-1 thz-align-center thz-boxshadow-inset-02" href="#"><span class="thz-btn-text thz-fs-16 thz-fw-400">Lovely!</span></a></div>',
		'css' 	=> '.thz-btn-topinset .thz-button{color:#ffffff;background-color:#1ecb67;border-color:#319f5f;box-shadow:inset 0px 0px 15px 5px rgba(0,0,0,0.16),inset 0px 1px 0px 0px rgba(255,255,255,0.68);}.thz-btn-topinset .thz-button:hover,.thz-btn-topinset.thz-btn-hover .thz-button {color:#ffffff;background-color:#319f5f;border-color:#319f5f;}',
		'json' 	=> '{"createButton":"on","activeColor":"green","buttonSizeClass":"medium","customClass":"thz-btn-topinset","borderRadius":0,"boxShadow":"inset","boxShadowOpacity":0.2,"shadowInset1":"on","boxshadowBlurRadius1":15,"boxshadowSpreadRadius1":5,"boxshadow1Color":"rgba(0,0,0,0.16)","shadowInset2":"on","boxshadowY2":1,"boxshadow2Color":"rgba(255,255,255,0.68)"}',
);



$customButtonsArray['thz-btn-custom-outline']=array(
		'html' 	=> '<div class="thz-btn-container thz-btn-custom-outline thz-btn-icon-right thz-btn-outline"><a class="thz-button thz-btn-trans thz-btn-medium thz-radius-4 thz-btn-border-2 thz-align-center" href="#"><span class="thz-btn-text thz-fs-16 thz-fw-400">Lovely!<i class="thzicon thzicon-heart4 thz-ifw-8 thz-ngv-n1 thz-fs-16"></i></span></a></div>',
		'css' 	=> '.thz-btn-custom-outline .thz-button{color:#319f5f;border-color:#319f5f;}.thz-btn-custom-outline .thz-button:hover,.thz-btn-custom-outline.thz-btn-hover .thz-button {color:#ffffff;background-color:#ffb401;border-color:#319f5f;}.thz-btn-custom-outline i.thzicon{color:#1ecb67;}.thz-btn-custom-outline:hover i.thzicon,.thz-btn-custom-outline.thz-btn-hover i.thzicon{color:rgba(15,15,15,0.41);}',
		'json' 	=> '{"createButton":"on","activeColor":"green","buttonSizeClass":"medium","buttonTransition":"on","buttonType":"outline","customClass":"thz-btn-custom-outline","borderWidth":2,"normalTextColor":"#319f5f","normalBgColor":"","hoveredBgColor":"#ffb401","normalIconColor":"#1ecb67","hoveredIconColor":"rgba(15,15,15,0.41)","buttonIcon":"thzicon thzicon-heart4","iconType":"inline","iconNudgeV":-1}',
);



$customButtonsArray['thz-custom-btn-upload']=array(
		'html' 	=> '<div class="thz-btn-container thz-custom-btn-upload thz-btn-icon-boxed-right"><a class="thz-button thz-btn-theme thz-btn-trans thz-btn-medium thz-radius-4 thz-btn-border-1 thz-align-center" href="#"><span class="thz-btn-text thz-fs-16 thz-fw-400">Upload</span><span class="thz-btn-icon"><i class="thzicon thzicon-upload3 thz-ifw-8 thz-fs-16"></i></span></a></div>',
		'css' 	=> '',
		'json' 	=> '{"activeColor":"theme","buttonSizeClass":"medium","buttonTransition":"on","buttonText":"Upload","customClass":"thz-custom-btn-upload","buttonIcon":"thzicon thzicon-upload3"}',
);


$customButtonsArray['thz-btn-mega-gradient']=array(
		'html' 	=> '<div class="thz-btn-container thz-btn-mega-gradient thz-btn-icon-boxed-right thz-btn-flat"><a class="thz-button thz-btn-trans thz-radius-4 thz-align-left" href="#"><span class="thz-btn-text thz-btn-has-subtext thz-vp-13 thz-hp-19 thz-fs-18 thz-fw-600 thz-ngv-n3"><span class="thz-btn-maintext">Button Magic<span class="thz-btn-subtext thz-fs-12 thz-fw-400 thz-lsp0 thz-ngv-4 thz-text-uppercase">Magic button generatror</span></span></span><span class="thz-btn-icon"><i class="thzicon thzicon-magic-wand thz-ifw-8 thz-is-lg"></i></span></a></div>',
		'css' 	=> '.thz-btn-mega-gradient .thz-button{color:#ffffff;background-color:#27b7f8;}.thz-btn-mega-gradient .thz-button:hover,.thz-btn-mega-gradient.thz-btn-hover .thz-button {color:#ffffff;background-color:#ffb401;}.thz-btn-mega-gradient i.thzicon{color:#ffffff;}.thz-btn-mega-gradient:hover i.thzicon,.thz-btn-mega-gradient.thz-btn-hover i.thzicon{color:#ffffff;}.thz-btn-mega-gradient.thz-btn-icon-boxed-right .thz-btn-icon{background:#ffb401;}.thz-btn-mega-gradient.thz-btn-icon-boxed-right:hover .thz-btn-icon,.thz-btn-mega-gradient.thz-btn-icon-boxed-right.thz-btn-hover .thz-btn-icon{background:#3bafda;}',
		'json' 	=> '{"createButton":"on","activeColor":"blue","buttonSizeClass":"custom","buttonTransition":"on","buttonType":"flat","buttonText":"Button Magic","customClass":"thz-btn-mega-gradient","textNudgeV":-3,"paddingX":19,"paddingY":13,"fontSize":18,"fontWeight":600,"textAlign":"left","borderWidth":0,"hoveredBgColor":"#ffb401","normalIconBg":"#ffb401","hoveredIconBg":"#3bafda","buttonIcon":"thzicon thzicon-magic-wand","iconSize":"thz-is-lg","buttonSubText":"Magic button generatror","SubTextNudgeV":4,"SubTextUppercase":"uppercase"}',
);


$customButtonsArray['thz-green-down']=array(
		'html' 	=> '<div class="thz-btn-container thz-green-download thz-btn-icon-boxed-right thz-btn-3d"><a class="thz-button thz-btn-green thz-btn-trans thz-radius-4 thz-align-left" href="#"><span class="thz-btn-text thz-text-uppercase thz-btn-has-subtext thz-vp-15 thz-hp-23 thz-fs-16 thz-fw-600 thz-ngv-n1"><span class="thz-btn-maintext">Download<span class="thz-btn-subtext thz-fs-12 thz-fw-500 thz-lsp0 thz-ngv-3 thz-text-uppercase">Latest version 2.0.0</span></span></span><span class="thz-btn-icon"><i class="fa fa-cloud-download thz-ifw-8 thz-is-lg"></i></span><span class="thz-btn-3d-line"></span><span class="thz-btn-gradient-overlay thz-btn-ga-toright"></span></a></div>',
		'css' 	=> '',
		'json' 	=> '{"activeColor":"green","buttonSizeClass":"custom","buttonTransition":"on","buttonType":"3d","buttonText":"Download","customClass":"thz-green-download","textNudgeV":-1,"paddingX":23,"paddingY":15,"fontSize":16,"fontWeight":"600","textAlign":"left","textUppercase":"uppercase","borderWidth":0,"buttonIcon":"fa fa-cloud-download","iconSize":"thz-is-lg","buttonGradient":"toright","buttonSubText":"Latest version 2.0.0","SubTextNudgeV":3,"SubTextfontWeight":"500","SubTextUppercase":"uppercase"}',
);
