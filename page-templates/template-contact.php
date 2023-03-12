<?php
/**
 * Template Name: Contact
 *
 * The template for contact page.
 *
 * @author Tomasz Załucki <info@innhouse.pl>
 */
get_header();
?>

<section class="page-contact">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <span class="subtitle"><?=get_field("contact_subtitle")?></span>
                <h1><?=get_field("contact_title")?></h1>
                <?=get_field("contact_desc")?>

                <div class="page-contact-hour">
                    <i class="icon-time"></i>
                    <span class="hours-wrapper">
                    <span class="days"><?=get_field("contact_open_1")?> <span class="hour"><?=get_field("contact_open_2")?></span></span>
                    <span class="days"><?=get_field("contact_open_3")?> <span class="hour"><?=get_field("contact_open_4")?></span></span>
                    <span class="days"><?=get_field("contact_open_5")?> <span class="hour"><?=get_field("contact_open_6")?></span></span>
                    </span>
                </div>
                <?=wp_get_attachment_image(get_field('contact_img'), 'medium', false, ["class" => "img-fluid banner-logo"])?>
            </div>
            <div class="col-12 col-lg-6">
                <div class="page-contact-data">
                    <div class="row">
                        <div class="col-2">
                            <span class="icon-circle-dark __white">
                                <i class="icon-pin"></i>
                            </span>
                        </div>
                        <div class="col-10">

                        <div class="page-contact-data-item">

                        
                            <span class="title"><?=get_field("contact_data_1")?></span>
                            <div class="page-contact-data-item-address">
                                <span class="title-address"><?=__("Adres:","optalex")?></span>
                                <address>
                                <?=get_field("contact_data_2")?> <br>
                                <?=get_field("contact_data_3")?><br>
                                <a href="<?=get_field("contact_data_5")?>" target="_blank" title="<?=get_field("contact_data_4")?>"><?=get_field("contact_data_4")?> <i class="icon-next"></i></a>
                                </address>
                                <div class="nip"><?=__("NIP:","optalex")?> <span class="nr"><?=get_field("contact_data_6")?></span></div>
                            </div>
                           
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-2">
                            <span class="icon-circle-dark __white">
                                <i class="icon-phone"></i>
                            </span>
                        </div>
                        <div class="col-10">

                        <div class="page-contact-data-item">

                        
                            <span class="title"><?=__("Kontakt telefoniczny:","optalex")?></span>
                            <div class="page-contact-data-item-address">
                                <span class="title-address"><?=__("Tel:","optalex")?></span>
                                <address> <?=get_field("contact_data_7")?> <br></address> 
                            </div>
                            <div class="page-contact-data-item-address">
                                <span class="title-address"><?=__("Tel:","optalex")?></span>
                                <address> <?=get_field("contact_data_8")?> <br></address> 
                            </div>
                            <div class="page-contact-data-item-address">
                                <span class="title-address"><?=__("Tel/fax:","optalex")?></span>
                                <address> <?=get_field("contact_data_9")?> <br></address> 
                            </div>
                           
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-2">
                            <span class="icon-circle-dark __white">
                                <i class="icon-email"></i>
                            </span>
                        </div>
                        <div class="col-10">

                        <div class="page-contact-data-item">

                        
                            <span class="title"><?=__("Kontakt mailowy:","optalex")?></span>
                            <div class="page-contact-data-item-address">
                                <span class="title-address"><?=__("E-mail:","optalex")?></span>
                                <address> <?=get_field("contact_data_10")?> <br></address> 
                            </div>
                             
                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer();