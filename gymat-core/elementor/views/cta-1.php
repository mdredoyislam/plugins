<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;
use Elementor\Group_Control_Image_Size;
extract($data);
$btn = $attr = '';
$svg='<svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
</svg>';
if ( !empty( $data['buttonurl']['url'] ) ) {
	$attr  = 'href="' . $data['buttonurl']['url'] . '"';
	$attr .= !empty( $data['buttonurl']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['buttonurl']['nofollow'] ) ? ' rel="nofollow"' : '';
}
if ( !empty( $data['buttontext'] ) ) {
	$btn = '<a class="btn-style2" ' . $attr . '>'.'<span>' . $data['buttontext'] .$svg.'</span>'. '</a>';
}
?>
<div class="cta-default cta-<?php echo esc_attr( $data['style'] ); ?>">
	<ul class="shape-element">
		<?php if($data['shape1_display']){ ?>
			<li><img width="242" height="144" src="<?php echo GYMAT_ASSETS_URL . 'element/material-1.png'; ?>" alt="blog"></li>
		<?php } ?>
		<?php if($data['shape2_display']){ ?>
			<li class="black-shape"><img width="339" height="186" src="<?php echo GYMAT_ASSETS_URL . 'element/Shape.png'; ?>" alt="black-shape"></li>
		<?php } ?>
	</ul>
	<div class="action-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="call-to-action-box-1">
						<h2 class="item-title"><?php echo wp_kses_post($data['title']); ?></h2> 
						<div class="item-button">
							<?php if ( $btn ) { ?>
								<div class="button "><?php echo wp_kses_post( $btn );?></div>		
							<?php } ?>
						</div>
						<div class="item-shape">
							<svg width="165" height="228" viewBox="0 0 165 228" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M121.5 18H89.5L0 227.5H31.5L121.5 18Z" fill="#FF0034"/>
							<path d="M164.5 0.5H148L103 105H117.5L164.5 0.5Z" fill="#FF0034"/>
							<path d="M111.5 119.5H97.5L81 157H96L111.5 119.5Z" fill="#FF0034"/>
							</svg>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
