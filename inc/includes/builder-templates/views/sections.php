<?php if (!defined('FW')) die('Forbidden');
/**
 * @var array $sections
 * @var array $sections_categories
 */

$prefix = 'thz-theme-';
$select_id = $prefix . fw_rand_md5();
ksort($sections,SORT_NATURAL);
ksort($sections_categories);
$current_user = wp_get_current_user();
$avatar = get_avatar($current_user->ID, 60 ); 
$avatar	= $avatar ? $avatar : '<span class="thzicon thzicon-creatus"></span>';
?>
<div class="<?php echo $prefix; ?>pred-tpl-container">
    <div class="<?php echo $prefix; ?>pred-tpl-holder">
        <?php if ($sections_categories): ?>
            <div class="<?php echo $prefix; ?>pred-tpl-cat">
                <div class="<?php echo $prefix; ?>pred-tpl-menu-holder">
                	<div class="<?php echo $prefix; ?>pred-tpl-menu-title">
                		<div class="<?php echo $prefix; ?>pred-tpl-cat-avatar">
                        	<?php echo $avatar ?>
                        </div>
                        <span class="title"><?php esc_html_e('Template Library', 'creatus') ?></span>
                        <div class="tsearch-container">
                        	<input id="tsearch" name="search" class="tsearch" placeholder="<?php esc_html_e('Quick search', 'creatus') ?>" type="text" data-list=".thz-theme-pred-tpl-thumb-list-inner">
                            <a href="#" class="dashicons dashicons-dismiss clear-tsearch"></a>
                        </div>
                    </div>
                    <ul id="<?php echo esc_attr($select_id) ?>" class="<?php echo $prefix; ?>pred-tpl-cat-select">
                        <li>
                            <a class="active" href="#" data-val="">
                                <?php esc_html_e('All Categories', 'creatus') ?> 
                                <span class="<?php echo $prefix; ?>items-count"><?php echo count($sections) ?></span>
                            </a>
                        </li>
                        <?php foreach ($sections_categories as $cat_id => $cat_title): ?>
                            <li>
                                <a href="#" data-val="<?php echo esc_attr($cat_id) ?>">
                                    <?php echo esc_html($cat_title) ?> 
                                    <span class="<?php echo $prefix; ?>items-count"></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($sections): ?>
            <div class="<?php echo $prefix; ?>pred-tpl-thumb-list">
            	<div class="<?php echo $prefix; ?>pred-tpl-thumb-list-inner">
                <?php foreach ($sections as $section_id => $section): $get_cp = isset($section['type']) && !$cpac ? ' thz-get-cp' :'';?>
                    <div class="<?php echo $prefix; ?>pred-tpl-thumb<?php echo $get_cp; ?>" data-categs="<?php echo fw_htmlspecialchars(json_encode(array_fill_keys(array_keys($section['categories']), true))) ?>" data-id="<?php echo esc_attr($section_id) ?>">
                    	<div class="<?php echo $prefix; ?>pred-tpl-thumb-in">
                            <div class="<?php echo $prefix; ?>pred-tpl-item-img <?php echo implode(' ',array_keys($section['categories'])) ?>">
                            <?php if ( isset($section['type']) && !$cpac ): ?>
                             <div class="<?php echo $prefix; ?>get-cp">
                             </div>
                             <?php endif; ?>
                            <img src="<?php echo esc_attr( $section['thumbnail'] ) ?>" alt="<?php echo esc_attr($section['desc']) ?>" title="<?php echo esc_attr($section['desc']) ?>" /></div>			
                            <div class="<?php echo $prefix; ?>pred-tpl-item-title">
                                <?php if ( isset($section['type']) && !$cpac ): ?>
                                 <a class="<?php echo $prefix; ?>get-cp-link" href="https://themezly.com/pricing/" target="_blank">
                                    <?php esc_html_e('Go Pro', 'creatus') ?>
                                 </a>
                                <?php endif; ?>
                            	<span class="<?php echo $prefix; ?>pred-tpl-item-desc">
									<?php echo esc_attr($section['desc']) ?>
                                </span>
                            	<div class="<?php echo $prefix; ?>pred-tpl-item-cats"><?php echo implode(',',array_keys($section['categories'])) ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
                <?php if( $can_update ) : ?>
                <div class="<?php echo $prefix; ?>pred-tpl-lib-update">
                    <span class="last-update"><?php echo esc_html__('Last updated', 'creatus').' '. thz_ago( $last_update ) ?></span>
                    <a href="#" class="force-update" title="<?php esc_html_e('Force Library Update', 'creatus') ?>">
                    	<span class="dashicons dashicons-update"></span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>