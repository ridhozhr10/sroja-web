<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
	<div class="swiper-wrapper">
		<?php
		// Include items
		makao_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/loop', '', $params );
		?>
	</div>
	<?php if ( $slider_navigation !== 'no' ) { ?>
		<div class="swiper-button-next">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 39 24" style="enable-background:new 0 0 39 24;" xml:space="preserve">
             <style type="text/css">
                 .sld0{fill:#FFFFFF;stroke:#08422c;stroke-miterlimit:10;}
                 .sld1{fill:none;stroke:#08422c;stroke-miterlimit:10;}
             </style>
                    <line class="sld0" x1="2" y1="11.9" x2="38.2" y2="11.9"/>
                        <path class="sld0" d="M13.5,1.4"/>
                        <path class="sld0" d="M13.5,23"/>
                        <path class="sld1" d="M13.5,1.4"/>
                        <path class="sld1" d="M0.8,0.4"/>
                    <polyline class="sld1" points="13.7,0.8 2,11.9 13.7,23 "/>
            </svg>
        </div>
		<div class="swiper-button-prev">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 39 24" style="enable-background:new 0 0 39 24;" xml:space="preserve">
             <style type="text/css">
                 .sld0{fill:#FFFFFF;stroke:#08422c;stroke-miterlimit:10;}
                 .sld1{fill:none;stroke:#08422c;stroke-miterlimit:10;}
             </style>
                    <line class="sld0" x1="2" y1="11.9" x2="38.2" y2="11.9"/>
                        <path class="sld0" d="M13.5,1.4"/>
                        <path class="sld0" d="M13.5,23"/>
                        <path class="sld1" d="M13.5,1.4"/>
                        <path class="sld1" d="M0.8,0.4"/>
                    <polyline class="sld1" points="13.7,0.8 2,11.9 13.7,23 "/>
            </svg>
        </div>
	<?php } ?>
	<?php if ( $slider_pagination !== 'no' ) { ?>
		<div class="swiper-pagination"></div>
	<?php } ?>
</div>