<?php
namespace radiustheme\Gymat_Core;
use GymatTheme;
use GymatTheme_Helper;
$schedule = $this->get_schedule( $data['item_no'] );

if($data['slider_autoplay']=='yes'){
	$data['slider_autoplay']=true;
}
else{
	$data['slider_autoplay']=false;
}

$swiper_data = array(
	'slidesPerView' 	=>2,
	'loop'				=>$data['slider_loop']=='yes' ? true:false,
	'spaceBetween'		=>$data['space']['size'],
	'slidesPerGroup'	=>$data['slider_per_group']['size'],
	'centeredSlides'	=>$data['centered_slide']=='yes' ? true:false ,
	'slideToClickedSlide' =>true,
	'autoplay'				=>array(
		'delay'  => $data['autoplayspeed']['size'],
	),
	'speed'      =>$data['speed']['size'],
	'breakpoints' =>array(
		'0'    =>array('slidesPerView' =>1),
		'576'    =>array('slidesPerView' =>$data['item_mobile']['size']),
		'768'    =>array('slidesPerView' =>$data['item_tablet']['size']),
		'992'    =>array('slidesPerView' =>$data['medium_item']['size']),
		'1200'    =>array('slidesPerView' =>$data['medium_item']['size']),				
		'1600'    =>array('slidesPerView' =>$data['item']['size'])
	),
	'auto'   =>$data['slider_autoplay']
);
$swiper_data = json_encode( $swiper_data );
$thumb_size='gymat-size6';
?>
<div class="class-default upcomming-class-layout2">
    <?php if($schedule){ ?>
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="upcoming-class-heading">
                    <div class="section-heading">
                        <?php if($data['section_subtitle']){ ?>
                            <div class="subtitle">
                                <?php echo wp_kses_post($data['section_subtitle']); ?>
                            </div>
                        <?php } if($data['section_title']){ ?>
                            <h2 class="heading-title"><?php echo wp_kses_post($data['section_title']); ?></h2>
                        <?php } if($data['section_content']){ ?>    
                            <p><?php echo wp_kses_post($data['section_content']); ?></p>
                        <?php } ?>
                    </div>
                    <div class="swiper-button">
                        <div class="swiper-button-arrow  swiper-button-prev">
                           <img width="21" height="12" src="<?php echo GYMAT_ASSETS_URL . 'img/arrow-left.svg'; ?>" alt="arrow-left" >
                        </div>
                        <div class="swiper-button-arrow  active swiper-button-next">
                            <img width="21" height="12" src="<?php echo GYMAT_ASSETS_URL . 'img/arrow-right.svg'; ?>" alt="arrow-right" >
                        </div>
                    </div>
				</div>
            </div>
            <div class="col-lg-8">
                <div class="slider-wrapper">
                    <div class="upcomming-class-slider" data-xld = '<?php echo esc_attr( $swiper_data )  ;?>'>
                        <div class="swiper-wrapper">
                            <?php foreach ( $schedule as $class_data ): ?>
                                <div class="swiper-slide">
                                    <div class="class-item">  
                                        <div class="class-box-wrapper">
                                            <div class="class-thumbnail">
                                                <?php if(!empty($class_data['thumbnail'])){
                                                    $thumbnail_img_id=attachment_url_to_postid($class_data['thumbnail']);
                                                    echo wp_kses_post(wp_get_attachment_image( $thumbnail_img_id,$thumb_size));
                                                }
                                                else{
                                                    echo '<img class="wp-post-image" src="' . GymatTheme_Helper::get_img( 'noimage_370X328.jpg' ) . '" alt="'. the_title_attribute( array( 'echo'=> false ) ) .'">';
                                                } ?>
                                                <?php
                                                    $start_time        = $class_data['start_time'];
                                                    $end_time          = $class_data['end_time'];
                                                    $gymat_class_icon  =$class_data['gymat_icon']; 
                                                    $gymat_class_img   =$class_data['gymat_img']; 
                                                    $weekday           = $class_data['weekname'];
                                                    $button_text       =$class_data['button_text'];
                                                    $button_link       =$class_data['button_link'];
                                                    $time              = $start_time."-".$end_time;
                                                    $gymat_icon_class  = $gymat_class_img ? 'has-img':'has-icon';
                                                ?>
                                                <div class="schedule-shape-box <?php echo esc_attr($gymat_icon_class); ?>">
                                                    <div class="schedule-time">
                                                        <div class="class-media">
                                                            <?php if($gymat_class_img){ ?>
                                                                <div class="class-img">
                                                                    <?php echo wp_get_attachment_image( $gymat_class_img,'full' );?> 
                                                                </div>
                                                            <?php } else { ?>
                                                                <div class="class-icon">
                                                                        <i class="<?php echo wp_kses_post( $gymat_class_icon  );?>"></i>
                                                                </div>
                                                            <?php } ?>	
                                                        </div>
                                                        <h3 class="class-title"><?php echo esc_html( $class_data['class'] );?></h3>
                                                        <ul class="schedule-meta">
                                                            <li>
                                                            <i class="flaticon-clock-1"></i><span class="day"><?php echo esc_html($weekday);?>: </span><span class="time"><?php echo esc_html( $time );?></span>
                                                            </li>
                                                            
                                                        </ul>
                                                        <div class="class-button">
                                                            <a class="btn-style1" href="<?php echo esc_url( $button_link); ?>"><span><?php if($button_text) echo esc_html($button_text);  ?><svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
                                                                </svg></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    <?php } ?>
</div>

  