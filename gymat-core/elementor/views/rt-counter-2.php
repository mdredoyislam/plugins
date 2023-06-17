<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Gymat_Core;
use Elementor\Utils;

?>

<div class="counter-appear counter-default counter-<?php echo esc_attr( $data['style'] );?> rtin-<?php echo esc_attr( $data['iconalign'] );?>">
    <div class="success-count-wrap">
        <div class="count">
            <h3 class="counterUp" data-duration=<?php echo esc_attr( $data['speed'] ); ?> data-counter="<?php echo esc_attr( $data['number'] );?>"><?php echo esc_html( $data['number'] );?></h3>
            <div class="after-counter-text"><?php echo wp_kses_post($data['after_number_text']); ?></div>
        </div>
        <div class="count-title">
            <h4><?php echo wp_kses_post($data['title'] );?></h4>
        </div>
    </div>
</div>