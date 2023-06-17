<?php
namespace radiustheme\Gymat_Core;
use GymatTheme;
use GymatTheme_Helper;



$schedule = $this->get_schedule( $data['number'] );

$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-{$data['col_xs']} col-{$data['col_mobile']}";

$thumb_size='gymat-size5';
?>
<div class="class-default  class-grid-layout1 class-grid-<?php echo esc_attr( $data['style'] );?>">
    <?php if($schedule){ ?>
        <div class="row">
            <?php $i = $data['delay']; $j = $data['duration']; ?>
                <?php foreach ( $schedule as $class_data ): ?>
                    <?php 
                        $excerpt 	       = wp_trim_words( $class_data['content'],$data['content_limit']['size'],'');
                        $gymat_class_icon  =$class_data['gymat_icon']; 
                        $gymat_class_img   =$class_data['gymat_img']; 
                    ?>
                    <div class="<?php echo esc_attr( $col_class );?>">
                        <div class="class-item rt-animate <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $i );?>s" data-wow-duration="<?php echo esc_attr( $j );?>s">  
                            <div class="class-box-content">
                                <div class="class-content">
                                    <h3 class="class-title"><?php echo esc_html( $class_data['class'] );?></h3>
                                    <?php if($excerpt){ ?>
                                    <p><?php echo wp_kses( $excerpt , 'alltext_allow' ); ?></p>
                                    <?php } ?>
                                    <?php if($data['icon_display']=='yes'){ ?>
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
                                    <?php } ?>
                                </div>
                                <div class="thumbnail-img-wrap">
                                    <div class="class-thumbnail">
                                        <?php if(!empty($class_data['thumbnail'])){
                                            $thumbnail_img_id=attachment_url_to_postid($class_data['thumbnail']);
                                            echo wp_kses_post(wp_get_attachment_image( $thumbnail_img_id,$thumb_size));
                                        }
                                        else{
                                            echo '<img class="wp-post-image" src="' . GymatTheme_Helper::get_img( 'noimage_370X328.jpg' ) . '" alt="'. the_title_attribute( array( 'echo'=> false ) ) .'">';
                                        } ?>
                                    </div>
                                </div>
                                <div class="schedule-time">
                                    
                                    <ul class="schedule-meta">
                                        <?php
                                        $start_time    = $class_data['start_time'];
                                        $excerpt 	   = wp_trim_words( $class_data['content'],$data['content_limit']['size'], '' );
                                        ?>
                                        <li>
                                            <span class="day"><?php echo esc_html( $class_data['weekname'] ); ?>:</span>
                                            <span class="time"><?php echo esc_html( $start_time );?></span>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i = $i + 0.2;  ?>
                <?php endforeach; ?>
            
        </div>
        <?php if($data['new_more_button_display']=='yes') {?>
            <div class="class-button wow fadeInUp rt-animate" data-wow-delay="1.4s" data-wow-duration="0.8s"><a class="btn-style1" href="<?php echo esc_url( $data['new_see_button_link'] );?>"><span><?php echo esc_html( $data['new_see_button_text'] );?><i class="fas fa-long-arrow-alt-right"></i></span></a></div> 
        <?php } ?>   
    <?php } ?>
</div>
