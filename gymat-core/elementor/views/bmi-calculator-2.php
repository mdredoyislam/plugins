<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$uniqid = (int) rand();

$metric_checked = $imperial_checked = $metric_style = $imperial_style = '';
if ( $data['unit_default'] == 'imperial' ) {
    $imperial_checked = ' checked';
    $metric_style = ' style="display:none;"';
} else {
    $metric_checked = ' checked';
    $imperial_style = ' style="display:none;"';
}

$metric_radio_html = '<input class="form-check-input" id="rt-bmi-metric-' . $uniqid . '" type="radio" name="rt-bmi-unit" value="metric"' . $metric_checked . '><label for="rt-bmi-metric-' . $uniqid . '">' . __( 'Metric Units', 'gymat-core' ) . '</label>';
$imperial_radio_html = '<input class="form-check-input" id="rt-bmi-imperial-' . $uniqid . '" type="radio" name="rt-bmi-unit" value="imperial"' . $imperial_checked . '><label for="rt-bmi-imperial-' . $uniqid . '">' . __( 'Imperial Units', 'gymat-core' ) . '</label>';

if ( $data['unit_default'] == 'imperial' ) {
    $radio_html = $imperial_radio_html . $metric_radio_html;
} else {
    $radio_html = $metric_radio_html . $imperial_radio_html;
}
$bmi_chart = array(
    array( __( 'Below 18.5', 'gymat-core' ),   __( 'Underweight', 'gymat-core' ) ),
    array( __( '18.5 - 24.9', 'gymat-core' ),  __( 'Normal', 'gymat-core' ) ),
    array( __( '25 - 29.9', 'gymat-core' ),  __( 'Overweight', 'gymat-core' ) ),
    array( __( '30 and Above', 'gymat-core' ), __( 'Obese', 'gymat-core' ) ),
);
$bmi_chart_encoded = json_encode( $bmi_chart );
?>
<div class="rt-bmi-calculator <?php echo esc_attr( $data['style'] ); ?>">
    
    <div class="row align-items-center">
        <div class="col-lg-5">
            <h4 class="sec-subtitle  wow fadeInUp" data-wow-delay="200ms" data-wow-duration="800ms"><?php echo esc_html( $data['subtitle'] ); ?></h4>
            <h2 class="rt-title wow fadeInUp" data-wow-delay="400ms" data-wow-duration="800ms"><?php echo esc_html( $data['title'] ); ?></h2>
            <div class="rt-subtitle wow fadeInUp" data-wow-delay="600ms" data-wow-duration="800ms"><?php echo wp_kses_post($data['content']); ?></div>
        </div>
        <div class="col-lg-5">
            <form class="rt-bmi-form wow fadeInUp" data-wow-delay="600ms" data-wow-duration="800ms">
                <div class="rt-bmi-radio"<?php echo ( $data['unit_display'] != 'yes' ) ? ' style="display:none;"':'';?>>
                    <?php echo $radio_html; ?>
                </div>
                <div class="rt-bmi-fields">
                    <div class="input-form rt-bmi-fields-metric" <?php echo $metric_style; ?>>
                        <input type="text" class=" form-control" name="rt-bmi-weight" placeholder="<?php _e( 'Weight / kg', 'gymat-core' ); ?>">
                    </div>
                    <div class="input-form rt-bmi-fields-metric" <?php echo $metric_style; ?>>
                       <input type="text" class=" form-control" name="rt-bmi-height" placeholder="<?php _e( 'Height / cm', 'gymat-core' ); ?>">
                    </div>
                    <div class="input-form rt-bmi-fields-imperial" <?php echo $imperial_style; ?>>
                        <input type="text" class=" form-control" name="rt-bmi-pound" placeholder="<?php _e( 'Weight / lbs', 'gymat-core' ); ?>">
                    </div>
                    
                    <div class="input-form rt-bmi-fields-imperial" <?php echo $imperial_style; ?>>
                        <input type="text" class=" form-control" name="rt-bmi-feet" placeholder="<?php _e( 'Height / feet', 'gymat-core' ); ?>">
                    </div>
                    <div class="input-form rt-bmi-fields-imperial inch" <?php echo $imperial_style; ?>>
                        <input type="text" class=" form-control" name="rt-bmi-inch" placeholder="<?php _e( 'Height / inch', 'gymat-core' ); ?>">
                    </div>
                    <div class="input-form  submit">
                        <input type="submit" class= "rt-bmi-submit" value="<?php echo esc_html( $data['btn_text'] ); ?>">
                    </div>
                </div>
                <div class="rt-bmi-result" style="display:none;" data-chart="<?php echo esc_attr( $bmi_chart_encoded ); ?>"><?php _e( 'Your BMI is:', 'gymat-core' );?> <span class="rt-bmi-val"></span><?php _e( ', and weight status is:', 'gymat-core' );?> <span class="rt-bmi-status"></span></div>
                <div class="rt-bmi-error" data-emptymsg="<?php _e( 'Error: One or more fields are empty', 'gymat-core' );?>" data-numbermsg="<?php _e( 'Error: All field values must be a number', 'gymat-core' );?>"></div>
            </form>
        </div>
    </div>
    
</div>