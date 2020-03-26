<?php
/**
 * Represents the view for slider panel.
 *
 * @package   MasterSlider
 * @author    averta [averta.net]
 * @license   LICENSE.txt
 * @link      http://masterslider.com
 * @copyright Copyright © 2015 averta
 */

?>

<!-- markup for slider panel page here. -->
<div id="msp-header">
    <div class="msp-logo"><a href="?page=masterslider"><img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/masterslider.gif" ></a></div>
</div>
<div id="panelLoading" class="msp-loading">
    <img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/loading.gif">
    <?php _e('Loading data...', MSWP_TEXT_DOMAIN); ?>
</div>
<?php echo MSP_Notices::get_instance()->get_notice( 'ms-notice-info-panel' ); ?>

<div id="msp-root" class="msp-container"> </div>
<div id="mspHiddenEditor" style="display:none">
    <?php wp_editor( '', 'msp-hidden' , array( 'textarea_rows' => 8 ) );  ?>
</div>

<!-- Application Template -->
<script type="text/x-handlebars">

    {{#if hasError}}
        <div class="msp-error-cont">
            {{partial errorTemplate}}
        </div>
    {{else}}
        <nav class="msp-main-nav">
            <ul>
                <li>{{#link-to 'settings'}} <?php _e('Slider Settings', MSWP_TEXT_DOMAIN); ?> <span class="msp-ico msp-ico-settings"></span>{{/link-to}}</li>
                {{#if isFlickr }}<li>{{#link-to 'flickr'}} <?php _e('Flickr Settings', MSWP_TEXT_DOMAIN); ?> <span class="msp-ico msp-ico-flickr"></span>{{/link-to}}</li>{{/if}}
                {{#if isFacebook }}<li>{{#link-to 'facebook'}} <?php _e('Facebook Settings', MSWP_TEXT_DOMAIN); ?> <span class="msp-ico msp-ico-facebook"></span>{{/link-to}}</li>{{/if}}
                {{#if isPost }}<li>{{#link-to 'post'}} <?php _e('Posts Settings', MSWP_TEXT_DOMAIN); ?> <span class="msp-ico msp-ico-posts"></span>{{/link-to}}</li>{{/if}}
                {{#if isWcproduct }}<li>{{#link-to 'wcproduct'}} <?php _e('Product Slider Settings', MSWP_TEXT_DOMAIN); ?> <span class="msp-ico msp-ico-wooc"></span>{{/link-to}}</li>{{/if}}
                <li>{{#link-to 'slides'}} <?php _e('Slides', MSWP_TEXT_DOMAIN); ?> <span class="msp-ico msp-ico-slides"></span>{{/link-to}}</li>
                <li>{{#link-to 'controls'}} <?php _e('Slider Controls', MSWP_TEXT_DOMAIN); ?> <span class="msp-ico msp-ico-controls"></span>{{/link-to}}</li>
                <li>{{#link-to 'callbacks'}} <?php _e('Slider Callbacks', MSWP_TEXT_DOMAIN); ?> <span class="msp-ico msp-ico-api"></span>{{/link-to}}</li>
                <li class="msp-upgrade-btn"> {{#link-to 'pro-features'}}Upgrade to PRO <span class="msp-ico msp-ico-pro"></span>{{/link-to}}</li>
            </ul>
        </nav>
        <div class="clear"></div>
        {{outlet}}
        <div class="msp-shortcode-cont">
            <span><?php _e('Shortcode :', MSWP_TEXT_DOMAIN); ?> </span>
            {{view MSPanel.SimpleCodeBlock value=shortCode width=120}}
            <span><?php _e('PHP function :', MSWP_TEXT_DOMAIN); ?> </span>
            {{view MSPanel.SimpleCodeBlock value=phpFunction width=160}}
        </div>
        <div class="msp-save-bar-placeholder" id="saveBarPlaceHolder"></div>
        <div class="msp-save-bar" id="saveBar">
            <button id="msp-preview-btn" {{action showPreview}} class="msp-blue-btn msp-save-changes"> <?php _e('Preview', MSWP_TEXT_DOMAIN); ?></button>
            {{#if isSending}}
                <button class="msp-blue-btn msp-save-changes disabled"> <?php _e('Saving...', MSWP_TEXT_DOMAIN); ?></button>
            {{else}}
                <button class="msp-blue-btn msp-save-changes" {{action "saveAll"}}> <?php _e('Save Changes', MSWP_TEXT_DOMAIN); ?></button>
            {{/if}}
            <div class="msp-saving-msg-cont">
                <span {{bind-attr class=":msp-save-status savingStatus"}}>{{statusMsg}}</span>
                <div {{bind-attr class=":msp-time-ago savingStatus"}}><?php _e('Saved', MSWP_TEXT_DOMAIN); ?> <span  id="timeAgo"></span>.</div>
            </div>
        </div>
    {{/if}}
</script>

<?php
    /**
     * Display the new or previous type of pro tab paged
     * Valid numbers for $pro_content_type are: 1, 2
     */
    //$pro_content_type = get_option( 'master-slider_ab_pro_feature_panel_content_type', 1 );
    $pro_content_type = 1;
    // ab testing check
    if( 1 == $pro_content_type ){
?>

<script type="text/x-handlebars" id="pro-features">
    {{#meta-box title="Upgrade to Master Slider Pro Edition"}}
        <div class="msp-metabox-row msp-new-pro-tab">
            <div class="msp-new-pro-header">
                <div class="msp-content-wrapper">
                    <div class="msp-new-pro-logo">
                        <h2>Boost Your Creativity by</h2>
                        <h1> Master Slider PRO</h1>
                    </div>
                    <div class="msp-new-pro-headerBg">
                        <p>BUNDLED WITH 70+ PREBUILT PREMIUM STARTER SLIDERS</p>
                    </div>
                </div>
            </div>
            <div class="msp-new-pro-features">
                <div class="msp-content-wrapper">
                    <h3>What's Included in Pro Edition?</h3>
                    <p>You will have access to tons of premium features which help you to create professional looking sliders with ease. Some of the remarkable features:</p>

                    <div class="msp-new-pro-flex-container">
                        <div class="msp-new-pro-features-items">
                            <ul>
                                <li>
                                    70+ Starter Sliders
                                </li>
                                 <li>
                                    Animated Layers
                                </li>
                                 <li>
                                    Parallax Effect
                                </li>
                                 <li>
                                    Fullscreen Layout
                                </li>
                            </ul>
                        </div>
                        <div class="msp-new-pro-features-items">
                            <ul>
                                <li>
                                    8+ Slide Transitions
                                </li>
                                 <li>
                                    Post Slider
                                </li>
                                 <li>
                                    Facebook and Flickr Slider
                                </li>
                                 <li>
                                    WooCommerce Slider
                                </li>
                            </ul>
                        </div>
                        <div class="msp-new-pro-features-items">
                            <ul>
                                <li>
                                    Video Background
                                </li>
                                 <li>
                                    Hotspots and Tooltips
                                </li>
                                 <li>
                                    Custom Slider Templates
                                </li>
                                 <li>
                                    Dedicated Support
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="msp-new-pro-testimonials">
                <div class="msp-content-wrapper">
                    <h3>What Others Say</h3>
                        {{#tabs-panel}}
                          <ul class="tabs-content">
                            <li id="s1">
                                <p>We cannot believe how simple is using MasterSlider! The interface is so simple, easy to use and extraordinary intuitive. The sample sliders library and auto importing feature was our dream that came true by you guys! The documentation, video tutorials and variety of options for customizing everything was totally beyond our expectation! You really nailed it!</p>
                                <img class="msp-new-pro-avatar" src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/testimonials/pixflow.png" alt="">
                                <h4>PixFlow<br><span>WordPress Theme Author</span></h4>
                            </li>
                            <li id="s2">
                                <p>The best user experience I have ever had so far with a slideshow plugin for WordPress so far. Easy to learn, easy to set up, lots of predefined slides, fast growing, soon coming updates, lots of great features, I can go on for days and days about it, easily the best money I have spent on a project.</p>
                                <img class="msp-new-pro-avatar" src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/testimonials/captial-themes.jpg" alt="">
                                <h4>Capital Themes<br><span>WordPress Theme Author</span></h4>
                            </li>
                            <li id="s3">
                                <p>I've used all the best selling sliders and whilst you can achieve great things with them, I've always struggled when I pass the site over to a client. They are inundated with confusing interfaces. Master slider changes all that. I honestly feel I could give this to any of my clients and within minutes, they would be building their own sliders. I am going back over previous sites and swapping out revolution slider, with a big smile on my face. Thank you.</p>
                                <img class="msp-new-pro-avatar" src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/testimonials/massImpressions.png" alt="">
                                <h4>MassImpressions<br><span>Web Design Agency</span></h4>
                            </li>
                            <li id="s4">
                                <p>I've used all sliders available to WordPress and this is by far the easiest to use and with the best results.</p>
                                <img class="msp-new-pro-avatar" src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/testimonials/theorian.jpg" alt="">
                                <h4>TheOrian82</h4>
                            </li>
                            <li id="s5">
                                <p>Excellent plugin. Siemple and easy to use and understand. It offers freedom to configure. Highly recommended!</p>
                                <img class="msp-new-pro-avatar" src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/testimonials/pabloegrande.jpg" alt="">
                                <h4>Pabloegrande</h4>
                            </li>
                          </ul>
                          <ul class="tabs">
                            <li class="active"><a href="#s1"></a></li>
                            <li><a href="#s2"></a></li>
                            <li><a href="#s3"></a></li>
                            <li><a href="#s4"></a></li>
                            <li><a href="#s5"></a></li>
                          </ul>
                        {{/tabs-panel}}
                </div>
            </div>

            <div class="msp-new-pro-guarantee">
                <div class="msp-content-wrapper">
                    <img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/badge.png" alt="">
                    <h3>10-Day Money Back Guarantee</h3>
                    <p>To ensure your satisfaction, we offer 10 days money back guarantee with your purchase if you are not satisfied with Master Slider Pro, we kindly refund 100% of your money without any condition!</p>
                </div>
            </div>

            <div class="msp-new-pro-buy">
                <div class="msp-content-wrapper">
                    <h2>Join the <?php echo msp_get_pro_users_num(); ?> Pro users today!</h2>
                    <a href="http://avt.li/mspnpt" target="_blank" class="msp-new-pro-btn" target="_blank">Get a License Instantly</a>
                </div>
            </div>

        </div>
    {{/meta-box}}
</script>

<?php
    } else {
?>

<script type="text/x-handlebars" id="pro-features">
	{{#meta-box title="Upgrade Master Slider to PRO"}}
		<div class="msp-metabox-row msp-pro-tab">
			<div class="msp-pro-featurs">
				<h2>Add  Features to Master Slider</h2>
				<p>Take your WordPress site to the next level with Master Slider PRO. This plugin crunches all types of contents, making it a dead-simple way to display dynamic slides in the exact way YOU want them to look.
				Best of all, Master Slider PRO works perfectly with any existing WordPress theme and doesn’t affect overall site performance. Which means, less bloat and more control!</p>
				<div class="msp-pf-figure">
					<img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/layers.jpg" alt="Animated layers">
					<h6>Animated Layers</h6>
				</div>
				<div class="msp-pf-figure">
					<img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/videos.jpg" alt="Videos">
					<h6>Videos</h6>
				</div>
				<div class="msp-pf-figure">
					<img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/sample-sliders.jpg" alt="Sample sliders">
					<h6>Sample Sliders</h6>
				</div>
				<div class="msp-pf-figure">
					<img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/dynamic-sources.jpg" alt="Dynamic sources">
					<h6>Dynamic Sources</h6>
				</div>
				<div class="msp-pf-figure">
					<img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/parallax.jpg" alt="Prallax effect">
					<h6>Parallax Effect</h6>
				</div>
				<div class="msp-pf-figure">
					<img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/dedicated-support.jpg" alt="Dedicated support">
					<h6>Dedicated Support</h6>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="msp-metabox-row msp-pro-tab msp-pf-admin-section">
			<div class="msp-pf-admin-ss">
				<div class="msp-pf-figure">
					<a data-featherlight="image" href="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/layers.jpg">
						<img  src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/thumbs/layers.jpg" alt="layers">
						<div class="msp-pf-thumb-ol"><img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/zoom.png" alt="zoom-ico"></div>
					</a>
				</div>
				<div class="msp-pf-figure">
					<a data-featherlight="image" href="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/sample-sliders.jpg">
						<img  src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/thumbs/sample-sliders.jpg" alt="sample sliders">
						<div class="msp-pf-thumb-ol"><img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/zoom.png" alt="zoom-ico"></div>
					</a>
				</div>
				<div class="msp-pf-figure">
					<a data-featherlight="image" href="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/templates.jpg">
						<img  src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/thumbs/templates.jpg" alt="slider templates">
						<div class="msp-pf-thumb-ol"><img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/zoom.png" alt="zoom-ico"></div>
					</a>
				</div>
				<div class="msp-pf-figure">
					<a data-featherlight="image" href="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/transition-editor.jpg">
						<img  src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/thumbs/transition-editor.jpg" alt="transition editor">
						<div class="msp-pf-thumb-ol"><img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/zoom.png" alt="zoom-ico"></div>
					</a>
				</div>
				<div class="msp-pf-figure">
					<a data-featherlight="image" href="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/style-editor.jpg">
						<img  src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/thumbs/style-editor.jpg" alt="style editor">
						<div class="msp-pf-thumb-ol"><img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/zoom.png" alt="zoom-ico"></div>
					</a>
				</div>
				<div class="msp-pf-figure">
					<a data-featherlight="image" href="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/button-editor.jpg">
						<img  src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/thumbs/button-editor.jpg" alt="style editor">
						<div class="msp-pf-thumb-ol"><img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/admin-area/zoom.png" alt="zoom-ico"></div>
					</a>
				</div>

				<div class="clear"></div>
				<h3>See It In Action</h3>
				<p>Want to give it a shot right away ? Just give it a test drive and create your own slider, or try some of our ready-made samples !</p>
				<a class="msp-blue-btn msp-pf-testdrive" href="http://avt.li/msptd" target="_blank"> <span class="msp-ico msp-ico-testdrive"></span> Test Drive Now</a>
			</div>
			<div class="clear"></div>
		</div>
		<div class="msp-metabox-row msp-pro-tab msp-pf-join-section">
			<img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/join.png" alt="Join the PRO version" class="msp-join-ico">
			<h3>Join The <?php echo msp_get_pro_users_num(); ?> PRO Users</h3>
            <p>Unlock all Master Slider Pro features and build an eye-caching slider for your website today. </p>
			<a class="msp-pf-btn msp-pf-upgrade-btn" href="http://avt.li/mspup" target="_blank">Upgrade Now</a>
			<a class="msp-pf-btn msp-pf-more-btn" href="http://avt.li/mspt" target="_blank">See All Features</a>
			<div class="clear"></div>
		</div>
	{{/meta-box}}
</script>

<?php
    }
?>

<!-- Slider Settings Page -->
<script type="text/x-handlebars" id="settings">

    {{#meta-box title="<?php _e('General Settings', MSWP_TEXT_DOMAIN); ?>"}}

        <div class="msp-metabox-row">

            <h4><?php _e('Slider name and dimensions', MSWP_TEXT_DOMAIN); ?></h4>

            <div class="msp-metabox-indented">
                <label><?php _e('Slider name :', MSWP_TEXT_DOMAIN); ?> </label> {{input value=name size="40"}}
            </div>
            <div class="msp-metabox-indented">
                 <label><?php _e('Slider width :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=width}} px
                <span class="msp-form-space"></span>
                <label><?php _e('Slider height :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=height}} px
            </div>

            <div class="msp-metabox-indented">
               {{switch-box value=autoCrop}}<label><?php _e('Automatically crop and resize slider images based on the size above.', MSWP_TEXT_DOMAIN); ?></label>
            </div>

            <h4><?php _e('Slider sizing method', MSWP_TEXT_DOMAIN); ?></h4>

            <div class="msp-metabox-indented">
                {{#view MSPanel.Select value=layout width="400" }}
                    <option value="boxed"><?php _e('Boxed layout', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="fullwidth"><?php _e('Full-width', MSWP_TEXT_DOMAIN); ?></option>
                {{/view}}
                {{#if showAutoHeight}}
                    <span class="msp-form-space"></span>
                    {{switch-box value=autoHeight}}<label><?php _e('Auto-height slider', MSWP_TEXT_DOMAIN); ?></label>
                {{/if}}
            </div>
            {{#if showMinHeight}}
                <div class="msp-metabox-indented">
                    <label><?php _e('Minimum height amount :', MSWP_TEXT_DOMAIN); ?> </label>{{number-input value=minHeight}} px
                </div>
            {{/if}}
            {{#if showWrapperWidth}}
               <div class="msp-metabox-indented">
                    <label><?php _e('Slider wrapper width :', MSWP_TEXT_DOMAIN); ?> </label>{{number-input value=wrapperWidth}}
                    {{#view MSPanel.Select value=wrapperWidthUnit width="40" }}
                        <option value="px">px</option>
                        <option value="%">%</option>
                    {{/view}}
                </div>
            {{/if}}

        </div>

    {{/meta-box}}

    {{#meta-box title="<?php _e('Slider Transition', MSWP_TEXT_DOMAIN); ?>"}}
        <div class="msp-metabox-row">
            <h4><?php _e('Change slider transition, transition speed and spacing between slides', MSWP_TEXT_DOMAIN); ?></h4>

            <div class="msp-metabox-indented">
                <label><?php _e('Transition :', MSWP_TEXT_DOMAIN); ?> </label>
                {{#view MSPanel.Select value=trView width=150}}
                    <option value="basic">Normal</option>
                    <option value="fade">Fade</option>
                {{/view}}
                <span class="msp-form-space"></span>
                <label><?php _e('Transition speed :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=speed}}
            </div>
            <div class="msp-metabox-indented">
                <label><?php _e('Direction :', MSWP_TEXT_DOMAIN); ?> </label>
                {{#view MSPanel.Select value=dir width="120"}}
                    <option value="h"><?php _e('Horizontal', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="v"><?php _e('Vertical', MSWP_TEXT_DOMAIN); ?></option>
                {{/view}}
                <span class="msp-form-space"></span>
                <label><?php _e('Slide spacing :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=space}} px
            </div>
        </div>
    {{/meta-box}}


    {{#meta-box title="<?php _e('Navigation', MSWP_TEXT_DOMAIN); ?>"}}

        <div class="msp-metabox-row">
            <h4><?php _e('Slideshow behavior and sorting slides', MSWP_TEXT_DOMAIN); ?></h4>
            <div class="msp-metabox-indented">
                {{switch-box value=autoplay}}<label><?php _e('Autoplay (Slideshow)', MSWP_TEXT_DOMAIN); ?></label>
                <span class="msp-form-space"></span>
                {{switch-box value=loop}}<label><?php _e('Loop navigation', MSWP_TEXT_DOMAIN); ?> </label>
                <span class="msp-form-space"></span>
                {{switch-box value=endPause}}<label><?php _e('Pause at the final slide', MSWP_TEXT_DOMAIN); ?></label>
            </div>
            <div class="msp-metabox-indented">
                {{switch-box value=overPause}}<label><?php _e('Pause on hover', MSWP_TEXT_DOMAIN); ?></label>
                <span class="msp-form-space"></span>
                {{switch-box value=shuffle}}<label><?php _e('Random order', MSWP_TEXT_DOMAIN); ?></label>
            </div>
            <div class="msp-metabox-indented">
                <label><?php _e('Start with slide :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=start min=1}}
            </div>
            <h4><?php _e('Slider navigation methods', MSWP_TEXT_DOMAIN); ?></h4>
            <div class="msp-metabox-indented">
                {{switch-box value=swipe}}<label><?php _e('Touch swipe navigation', MSWP_TEXT_DOMAIN); ?></label>
                <span class="msp-form-space"></span>
                {{switch-box value=mouse}}<label><?php _e('Mouse swipe navigation', MSWP_TEXT_DOMAIN); ?></label>
                <span class="msp-form-space"></span>
                {{switch-box value=grabCursor}}<label><?php _e('Use grab mouse cursor', MSWP_TEXT_DOMAIN); ?></label>
            </div>
            <div class="msp-metabox-indented">
                {{switch-box value=wheel}}<label><?php _e('Mouse wheel navigation', MSWP_TEXT_DOMAIN); ?></label>
            </div>
            <div class="msp-metabox-indented">
                {{switch-box value=startOnAppear}}<label><?php _e('Start slider when appears in browser window.', MSWP_TEXT_DOMAIN); ?></label>
            </div>
            <h4><?php _e('Slide preloading', MSWP_TEXT_DOMAIN); ?></h4>
            <div class="msp-metabox-indented">
                {{#view MSPanel.Select value=preloadMethod width="200" }}
                    <option value="nearby"><?php _e('Load nearby slides', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="-1"><?php _e('Load slides in sequence', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="all"><?php _e('Load all slides before init', MSWP_TEXT_DOMAIN); ?></option>
                {{/view}}
                {{#if showNearbyNum}}
                    <span class="msp-form-space"></span>
                   <?php _e('Number of slides :', MSWP_TEXT_DOMAIN); ?> {{number-input value=preload }}
                {{/if}}
            </div>
        </div>

    {{/meta-box}}

    {{#meta-box title="<?php _e('Appearance', MSWP_TEXT_DOMAIN); ?>"}}

        <div class="msp-metabox-row">
            <h4><?php _e('Slider Skin', MSWP_TEXT_DOMAIN); ?></h4>
            <div class="msp-metabox-indented">
                <label><?php _e('Skin :', MSWP_TEXT_DOMAIN); ?> </label>
                {{#dropdwon-List value=skin width=180}}
                    {{#each skin in sliderSkins}}
                        <option {{bind-attr value=skin.class}}>{{skin.label}}</option>
                    {{/each}}

                    {{!--
                    <option value="ms-skin-default"><?php _e('Default', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="ms-skin-minimal"><?php _e('Minimal', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="ms-skin-light-2"><?php _e('Light 2', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="ms-skin-light-3"><?php _e('Light 3', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="ms-skin-light-4"><?php _e('Light 4', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="ms-skin-light-5"><?php _e('Light 5', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="ms-skin-light-6"><?php _e('Light 6', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="ms-skin-light-6 round-skin"><?php _e('Light 6 Round', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="ms-skin-contrast"><?php _e('Contrast', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="ms-skin-black-1"><?php _e('Black 1', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="ms-skin-black-2"><?php _e('Black 2', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="ms-skin-black-2 round-skin"><?php _e('Black 2 Round', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="ms-skin-metro"><?php _e('Metro', MSWP_TEXT_DOMAIN); ?></option>
                    --}}
                {{/dropdwon-List}}
            </div>
            <div class="msp-metabox-indented">
                <label><?php _e('Align center slider controls :', MSWP_TEXT_DOMAIN); ?> </label> {{switch-box value=centerControls}}
            </div>
            <h4><?php _e('Slider background settings', MSWP_TEXT_DOMAIN); ?></h4>
            <div class="msp-metabox-indented">
                <label><?php _e('Background image :', MSWP_TEXT_DOMAIN); ?> </label> {{view MSPanel.ImgSelect value=bgImage thumb=bgImageThumb}}
                <span class="msp-form-space"></span>
                <label><?php _e('Background color :', MSWP_TEXT_DOMAIN); ?> </label> {{color-picker value=bgColor}}
            </div>
            <h4><?php _e('Slider custom class name and style', MSWP_TEXT_DOMAIN); ?></h4>
            <div class="msp-metabox-indented">
                <label><?php _e('Class name :', MSWP_TEXT_DOMAIN); ?> </label> {{input value=className}}
            </div>
            {{!--<div class="msp-metabox-indented">
                <label><?php _e('Inline style :', MSWP_TEXT_DOMAIN); ?> </label> {{input value=inlineStyle size="50"}}
            </div>--}}
           <div class="msp-metabox-indented">
                <label><?php _e('Slider custom styles :', MSWP_TEXT_DOMAIN); ?> </label>
            </div>
            <div class="msp-metabox-indented">
                {{#code-mirror width="880" height="250" mode="css" value=customStyle}}{{/code-mirror}}
            </div>

        </div>

    {{/meta-box}}
</script>

<!-- Slides Page -->
<script type="text/x-handlebars" id="slides">
    {{#if customSlider}}
        <!-- Slides List -->
        {{#meta-box title="<?php _e('Slides', MSWP_TEXT_DOMAIN); ?>"}}
        <div class="msp-metabox-row">
         {{view MSPanel.SlideList}}
        </div>
        {{/meta-box}}
        {{#if currentSlide}}
            {{partial "slide-settings"}}
        {{/if}}
    {{/if}}
</script>

<!-- Slide Settings Partial -->
<script type="text/x-handlebars" id="slide-settings">

    {{#tabs-panel id="slide-settings"}}
    <div class="msp-metabox-handle">

        <ul class="tabs">
            <li class="active"><a href="#sl-bg"><?php _e('Background', MSWP_TEXT_DOMAIN); ?></a></li>
            <li><a href="#sl-val"><?php _e('Video and Link', MSWP_TEXT_DOMAIN); ?></a></li>
            <li><a href="#sl-inf"><?php _e('Slide Info', MSWP_TEXT_DOMAIN); ?></a></li>
            <li><a href="#sl-misc"><?php _e('Misc', MSWP_TEXT_DOMAIN); ?></a></li>
        </ul>

        <div class="msp-metabox-toggle"></div>
    </div>

    <ul class="tabs-content">
        <li id="sl-bg">{{partial 'slide-background'}}</li>
        <li id="sl-val">{{partial 'slide-video-and-link'}}</li>
        <li id="sl-inf">{{partial 'slide-info'}}</li>
        <li id="sl-misc">{{partial 'slide-misc'}}</li>
    </ul>

    {{/tabs-panel}}

    {{#meta-box title="Slide"}}
        <div class="msp-metabox-row">
           <div class="msp-metabox-indented">
             <label><?php _e('Slide duration :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input class="msp-number-input" min=0 max=300 step="0.1" value=currentSlide.duration}} s
            </div>
        </div>
        <hr class="msp-metabox-hr">
        {{view MSPanel.StageArea}}
    {{/meta-box}}
</script>

<!-- Slide Background Settings Partial -->
<script type="text/x-handlebars" id="slide-background">
    <div class="msp-metabox-row">
        <h4><?php _e('Choose slide background and thumbnail', MSWP_TEXT_DOMAIN); ?></h4>
        <div class="msp-metabox-indented">
            <label><?php _e('Background :', MSWP_TEXT_DOMAIN); ?> </label> {{view MSPanel.ImgSelect value=currentSlide.bg thumb=currentSlide.bgThumb }}
            <span class="msp-form-space"></span>
            <label><?php _e('Fillmode :', MSWP_TEXT_DOMAIN); ?> </label> {{view MSPanel.Fillmode value=currentSlide.fillMode}}
            <span class="msp-form-space"></span>
            <label><?php _e('Thumbnail :', MSWP_TEXT_DOMAIN); ?> </label> {{view MSPanel.ImgSelect value=currentSlide.thumbOrginal thumb=currentSlide.thumb}}
        </div>
    </div>
</script>
<!-- Slide Embeded Video and Link -->
<script type="text/x-handlebars" id="slide-video-and-link">
    <div class="msp-metabox-row">
        <h4><?php _e('Link this slide', MSWP_TEXT_DOMAIN); ?> </h4>
        <div class="msp-metabox-indented">
            <label><?php _e('URL :', MSWP_TEXT_DOMAIN); ?> </label> {{input class="msp-path-input" value=currentSlide.link}}
            {{view MSPanel.URLTarget  value=currentSlide.linkTarget }}
        </div>
        <div class="msp-metabox-indented">
            <label><?php _e('Link id :', MSWP_TEXT_DOMAIN); ?> </label> {{input size=20 value=currentSlide.linkId}}
             <span class="msp-form-space"></span>
            <label><?php _e('Link class :', MSWP_TEXT_DOMAIN); ?> </label> {{input size=20 value=currentSlide.linkClass}}
        </div>
        <div class="msp-metabox-indented">
            <label><?php _e('Link rel :', MSWP_TEXT_DOMAIN); ?> </label> {{input size=20 value=currentSlide.linkRel}}
             <span class="msp-form-space"></span>
            <label><?php _e('Link title :', MSWP_TEXT_DOMAIN); ?> </label> {{input size=20 value=currentSlide.linkTitle}}
        </div>
        <h4><?php _e('Youtube or Vimeo video as slide', MSWP_TEXT_DOMAIN); ?></h4>
        <div class="msp-metabox-indented">
            <label><?php _e('Video embed src :', MSWP_TEXT_DOMAIN); ?> </label> {{input size=60 value=currentSlide.video}}
            <span class="msp-form-space"></span>
            <label><?php _e('Autoplay video :', MSWP_TEXT_DOMAIN); ?> </label>  {{switch-box value=currentSlide.autoplayVideo}}
        </div>
        <div class="msp-metabox-indented">
            <a href="http://masterslider.com/doc/wp/#embed-url" target="_blank"><?php _e('Where to find the Youtube/Vimeo embed URL.', MSWP_TEXT_DOMAIN); ?></a>
        </div>
    </div>
</script>

<!-- Slide Info -->
<script type="text/x-handlebars" id="slide-info">
    <div class="msp-metabox-row">
        <div class="msp-metabox-indented">
            <label><?php _e('The info. will appear next to the slider when it reaches that specific slide, or it can represent as a tab in tabs control. Please note that it is relative to the selected slider\'s template.', MSWP_TEXT_DOMAIN); ?></label>
        </div>

        {{#if MSPanel.dynamicTags}}
            <div class="msp-metabox-indented">
                <label><?php _e('Insert dynamic content : ', MSWP_TEXT_DOMAIN); ?></label>
                {{view MSPanel.AddDynamicTag editorId=infoEditor}}
            </div>
        {{/if}}
        <div class="msp-metabox-indented">
            {{view MSPanel.WPEditor tabs="slide-settings" tab="sl-inf" _id=infoEditor value=currentSlide.info}}
            {{!-- {{view MSPanel.HTMLTextArea value=currentSlide.info}} --}}
        </div>
    </div>
</script>

<!-- Slide Misc -->
<script type="text/x-handlebars" id="slide-misc">
    <div class="msp-metabox-row">
        <h4><?php _e('Custom class name and ID for slide element', MSWP_TEXT_DOMAIN); ?> </h4>
        <div class="msp-metabox-indented">
            <label><?php _e('Class name :', MSWP_TEXT_DOMAIN); ?> </label> {{input size=30 value=currentSlide.cssClass}}
             <span class="msp-form-space"></span>
            <label><?php _e('CSS ID :', MSWP_TEXT_DOMAIN); ?> </label> {{input size=30 value=currentSlide.cssId}}
        </div>
        <h4><?php _e('Background color and slide background alt text ', MSWP_TEXT_DOMAIN); ?></h4>
        <div class="msp-metabox-indented">
            <label><?php _e('Background color :', MSWP_TEXT_DOMAIN); ?> </label> {{color-picker value=currentSlide.bgColor}}
             <span class="msp-form-space"></span>
            <label><?php _e('Alt text :', MSWP_TEXT_DOMAIN); ?> </label> {{input size=30 value=currentSlide.bgAlt}}
        </div>
        <div class="msp-metabox-indented">
            <label><?php _e('Background image title :', MSWP_TEXT_DOMAIN); ?> </label> {{input size=30 value=currentSlide.bgTitle}}
        </div>
        <h4><?php _e('Slide color and pattern overlay ', MSWP_TEXT_DOMAIN); ?></h4>
        <div class="msp-metabox-indented">
           <label><?php _e('Color overlay :', MSWP_TEXT_DOMAIN); ?> </label> {{color-picker value=currentSlide.colorOverlay}}
           <div class="msp-form-space-med"></div>
           <label><?php _e('Pattern overlay :', MSWP_TEXT_DOMAIN); ?> </label> {{pattern-picker value=currentSlide.pattern}}
        </div>
    </div>
</script>
<!-- Slider Controls -->
<script type="text/x-handlebars" id="controls">
{{#if controllers.application.disableControls}}
     {{#meta-box title="Slider Controls"}}
        <div class="msp-metabox-row">
            <div class="msp-metabox-indented">
                <?php _e('The selected tempalte for slider does not support custom controls.', MSWP_TEXT_DOMAIN); ?>
            </div>
        </div>
    {{/meta-box}}
{{else}}
    {{#meta-box title="Slider Controls"}}
        <div class="msp-metabox-row">

            <h4><?php _e('Here you can add or remove controls to slider', MSWP_TEXT_DOMAIN); ?></h4>

            <div class="msp-metabox-indented">
                <label><?php _e('Add new control', MSWP_TEXT_DOMAIN); ?></label>
                {{#if noMore}}
                    <button class="msp-add-btn disabled"><span class="msp-ico msp-ico-whiteadd"></span></button>
                {{else}}
                    <button {{action addControl}} class="msp-add-btn"><span class="msp-ico msp-ico-whiteadd"></span></button>
                {{/if}}

                {{#dropdwon-List value=selectedControl width=200}}
                    {{#each control in availableControls}}
                        <option {{bind-attr value=control.value}}>{{control.label}}</option>
                    {{else}}
                        <option><?php _e('-- All controls are used --', MSWP_TEXT_DOMAIN); ?></option>
                    {{/each}}
                {{/dropdwon-List}}
            </div>
        </div>
        <hr class="msp-metabox-hr">
        <div class="msp-metabox-row">
            <h4><?php _e('Used controls:', MSWP_TEXT_DOMAIN); ?></h4>
            <div class="msp-metabox-indented">
                {{#each control in controller}}
                    {{view MSPanel.ControlBtn control=control}}
                {{/each}}
            </div>
        </div>
    {{/meta-box}}

    {{partial controlOptions}}
{{/if}}
</script>

<script type="text/x-handlebars" id="arrows-options">
    {{#meta-box title="Arrows Control Options"}}
        <div class="msp-metabox-row">
            <div class="msp-metabox-indented">
                {{switch-box value=currentControl.autoHide}} <label><?php _e('Hide arrows when mouse leaves slider', MSWP_TEXT_DOMAIN); ?></label>
                <div class="msp-form-space-med"></div>
                {{switch-box value=currentControl.overVideo}} <label><?php _e('Show arrows over Youtube/Vimeo video player', MSWP_TEXT_DOMAIN); ?></label>
            </div>
            <div class="msp-metabox-indented">
                <label><?php _e('Hide arrows for window width less than :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.hideUnder}} px
            </div>

            {{!--<div class="msp-metabox-indented">
                {{switch-box value=currentControl.inset}} <label><?php _e('Insert arrows inside slider', MSWP_TEXT_DOMAIN); ?></label>
            </div>
            <div class="msp-metabox-indented">
                <label><?php _e('Arrows margin :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.margin min=null}} px
            </div>--}}
        </div>
    {{/meta-box}}
</script>

<script type="text/x-handlebars" id="timebar-options">
    {{#meta-box title="Line Timer Control Options"}}
        <div class="msp-metabox-row">
            <div class="msp-metabox-indented">
                {{switch-box value=currentControl.autoHide}} <label><?php _e('Hide line timer when mouse leaves slider', MSWP_TEXT_DOMAIN); ?></label>
                <div class="msp-form-space-med"></div>
                {{switch-box value=currentControl.overVideo}} <label><?php _e('Show line timer over Youtube/Vimeo video player', MSWP_TEXT_DOMAIN); ?></label>
            </div>
            <div class="msp-metabox-indented">
                <?php _e('Align control :', MSWP_TEXT_DOMAIN); ?>
                {{#dropdwon-List value=currentControl.align width=100}}
                    <option value="top"><?php _e('Top', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="bottom"><?php _e('Bottom', MSWP_TEXT_DOMAIN); ?></option>
                {{/dropdwon-List}}
                <div class="msp-form-space-med"></div>
                <label><?php _e('Hide line timer for window width less than :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.hideUnder}} px
            </div>
            <div class="msp-metabox-indented">
                <label><?php _e('Line timer color :', MSWP_TEXT_DOMAIN); ?> </label> {{color-picker value=currentControl.color}}
                <div class="msp-form-space-med"></div>
                <label><?php _e('Line timer width :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.width}} px
            </div>
        </div>
    {{/meta-box}}
</script>

<script type="text/x-handlebars" id="bullets-options">
    {{#meta-box title="Bullets Control Options"}}
        <div class="msp-metabox-row">
            <div class="msp-metabox-indented">
                {{switch-box value=currentControl.autoHide}} <label><?php _e('Hide bullets when mouse leaves slider', MSWP_TEXT_DOMAIN); ?></label>
                <div class="msp-form-space-med"></div>
                {{switch-box value=currentControl.overVideo}} <label><?php _e('Show bullets over Youtube/Vimeo video player', MSWP_TEXT_DOMAIN); ?></label>
            </div>
           {{!-- <div class="msp-metabox-indented">
                {{switch-box value=currentControl.inset}} <label><?php _e('Insert bullets inside slider', MSWP_TEXT_DOMAIN); ?></label>
            </div> --}}
            <div class="msp-metabox-indented">
                <?php _e('Align control :', MSWP_TEXT_DOMAIN); ?>
                {{#dropdwon-List value=currentControl.align width=100}}
                    <option value="top"><?php _e('Top', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="right"><?php _e('Right', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="left"><?php _e('Left', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="bottom"><?php _e('Bottom', MSWP_TEXT_DOMAIN); ?></option>
                {{/dropdwon-List}}
                <div class="msp-form-space-med"></div>
                <label><?php _e('Bullets margin :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.margin min=null}} px
                <div class="msp-form-space-med"></div>
                <label><?php _e('Space between bullets :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.space min=null}} px
            </div>
            <div class="msp-metabox-indented">
                <label><?php _e('Hide bullets for window width less than :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.hideUnder}} px
            </div>
        </div>
    {{/meta-box}}
</script>

<script type="text/x-handlebars" id="scrollbar-options">
    {{#meta-box title="Scrollbar Control Options"}}
        <div class="msp-metabox-row">
            <div class="msp-metabox-indented">
                {{switch-box value=currentControl.autoHide}} <label><?php _e('Hide scrollbar when mouse leaves slider', MSWP_TEXT_DOMAIN); ?></label>
                 <div class="msp-form-space-med"></div>
                {{switch-box value=currentControl.overVideo}} <label><?php _e('Show scrollbar over Youtube/Vimeo video player', MSWP_TEXT_DOMAIN); ?></label>
            </div>
            <div class="msp-metabox-indented">
                {{switch-box value=currentControl.inset}} <label><?php _e('Insert scrollbar inside slider', MSWP_TEXT_DOMAIN); ?></label>
            </div>

            {{!--<div class="msp-metabox-indented">
                <label><?php _e('Scrollbar direction :', MSWP_TEXT_DOMAIN); ?> </label>
                {{#dropdwon-List value=currentControl.dir width=100}}
                    <option value="h"><?php _e('Horizontal', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="v"><?php _e('Vertical', MSWP_TEXT_DOMAIN); ?></option>
                {{/dropdwon-List}}
                <div class="msp-form-space-med"></div>
            </div>--}}

            <div class="msp-metabox-indented">
               <label><?php _e('Scrollbar handle color :', MSWP_TEXT_DOMAIN); ?> </label> {{color-picker value=currentControl.color}}
               <div class="msp-form-space-med"></div>
               <label><?php _e('Hide scrollbar for window width less than :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.hideUnder}} px
            </div>
            <div class="msp-metabox-indented">
                <?php _e('Align control :', MSWP_TEXT_DOMAIN); ?>
                {{#dropdwon-List value=currentControl.align width=100}}
                    <option value="top"><?php _e('Top', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="right"><?php _e('Right', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="left"><?php _e('Left', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="bottom"><?php _e('Bottom', MSWP_TEXT_DOMAIN); ?></option>
                {{/dropdwon-List}}
                <div class="msp-form-space-med"></div>
                <label><?php _e('Scrollbar width :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.width}} px
                <div class="msp-form-space-med"></div>
                <label><?php _e('Scrollbar margin :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.margin min=null}} px
            </div>
        </div>
    {{/meta-box}}
</script>

<script type="text/x-handlebars" id="circletimer-options">
    {{#meta-box title="Circle Timer Control Options"}}
        <div class="msp-metabox-row">
            <div class="msp-metabox-indented">
                {{switch-box value=currentControl.autoHide}} <label><?php _e('Hide cricle timer when mouse leaves slider', MSWP_TEXT_DOMAIN); ?></label>
                <div class="msp-form-space-med"></div>
                {{switch-box value=currentControl.overVideo}} <label><?php _e('Show circle timer over Youtube/Vimeo video player', MSWP_TEXT_DOMAIN); ?></label>
            </div>
             {{!--<div class="msp-metabox-indented">
                <?php _e('Align control :', MSWP_TEXT_DOMAIN); ?>
                {{#dropdwon-List value=currentControl.align width=100}}
                    <option value="tl"><?php _e('Top Left', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="tr"><?php _e('Top Right', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="bl"><?php _e('Bottom Left', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="br"><?php _e('Bottom Right', MSWP_TEXT_DOMAIN); ?></option>
                {{/dropdwon-List}}
            </div>--}}
            <div class="msp-metabox-indented">
                <label><?php _e('Hide circle timer for window width less than :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.hideUnder}} px
            </div>
            <div class="msp-metabox-indented">
                {{!--<label><?php _e('Circle timer margin :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.margin min=null}} px
                <div class="msp-form-space-med"></div>--}}
                <label><?php _e('Circle stroke :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.stroke}} px
                <div class="msp-form-space-med"></div>
                <label><?php _e('Circle radius :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.radius}} px
                <div class="msp-form-space-med"></div>
                <label><?php _e('Circle color :', MSWP_TEXT_DOMAIN); ?> </label> {{color-picker value=currentControl.color}}
            </div>
        </div>
    {{/meta-box}}
</script>

<script type="text/x-handlebars" id="slideinfo-options">
    {{#meta-box title="Slide Info Control Options"}}
        <div class="msp-metabox-row">
            <div class="msp-metabox-indented">
                {{switch-box value=currentControl.autoHide}} <label><?php _e('Hide slide info when mouse leaves slider', MSWP_TEXT_DOMAIN); ?></label>
                <div class="msp-form-space-med"></div>
                {{switch-box value=currentControl.overVideo}} <label><?php _e('Show slide info over Youtube/Vimeo video player', MSWP_TEXT_DOMAIN); ?></label>
            </div>
            <div class="msp-metabox-indented">
                {{switch-box value=currentControl.inset}} <label><?php _e('Insert slide info inside slider', MSWP_TEXT_DOMAIN); ?></label>
            </div>
            <div class="msp-metabox-indented">
                <?php _e('Align control :', MSWP_TEXT_DOMAIN); ?>
                {{#dropdwon-List value=currentControl.align width=100}}
                    <option value="top"><?php _e('Top', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="right"><?php _e('Right', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="left"><?php _e('Left', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="bottom"><?php _e('Bottom', MSWP_TEXT_DOMAIN); ?></option>
                {{/dropdwon-List}}
                <div class="msp-form-space-med"></div>
                <label><?php _e('Slide info margin :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.margin min=null}} px
            </div>
            <div class="msp-metabox-indented">
                <label><?php _e('Slide info width :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.width}} px
                <div class="msp-form-space-med"></div>
                <label><?php _e('Slide info height :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.height}} px
            </div>
        </div>
            <div class="msp-metabox-indented">
                <label><?php _e('Hide slide info for window width less than :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.hideUnder}} px
            </div>
        </div>
    {{/meta-box}}
</script>

<script type="text/x-handlebars" id="thumblist-options">
    {{#meta-box title="Thumblist/Tabs Control Options"}}
        <div class="msp-metabox-row">
            <div class="msp-metabox-indented">
                {{switch-box value=currentControl.autoHide}} <label><?php _e('Hide thumblist/tabs when mouse leaves slider', MSWP_TEXT_DOMAIN); ?></label>
                <div class="msp-form-space-med"></div>
                {{switch-box value=currentControl.overVideo}} <label><?php _e('Show thumblist/tabs over Youtube/Vimeo video player', MSWP_TEXT_DOMAIN); ?></label>
            </div>
            <div class="msp-metabox-indented">
                {{switch-box value=currentControl.inset}} <label><?php _e('Insert thumblist/tabs inside slider', MSWP_TEXT_DOMAIN); ?></label>
                <div class="msp-form-space-med"></div>
                {{switch-box value=currentControl.arrows}} <label><?php _e('Insert navigation arrows', MSWP_TEXT_DOMAIN); ?></label>
            </div>
            <div class="msp-metabox-indented">
                {{switch-box value=currentControl.hoverChange}} <label><?php _e('Change slides on hovering over thumbs/tabs.', MSWP_TEXT_DOMAIN); ?></label>
            </div>
            <div class="msp-metabox-indented">
                <?php _e('Align control :', MSWP_TEXT_DOMAIN); ?>
                {{#dropdwon-List value=currentControl.align width=100}}
                    <option value="top"><?php _e('Top', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="right"><?php _e('Right', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="left"><?php _e('Left', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="bottom"><?php _e('Bottom', MSWP_TEXT_DOMAIN); ?></option>
                {{/dropdwon-List}}
                <div class="msp-form-space-med"></div>
                <label><?php _e('Thumblist/Tabs margin :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.margin min=null}} px
            </div>
            <div class="msp-metabox-indented">
                <?php _e('Appearance :', MSWP_TEXT_DOMAIN); ?>
                {{#dropdwon-List value=currentControl.type width=100}}
                    <option value="thumbs"><?php _e('Thumblist', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="tabs"><?php _e('Tabs', MSWP_TEXT_DOMAIN); ?></option>
                {{/dropdwon-List}}
                <div class="msp-form-space-med"></div>
                <label><?php _e('Hide thumblist/tabs for window width less than :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.hideUnder}} px
            </div>

            {{!--<div class="msp-metabox-indented">
                <label><?php _e('Thumblist/Tabs direction :', MSWP_TEXT_DOMAIN); ?> </label>
                {{#dropdwon-List value=currentControl.dir width=100}}
                    <option value="h"><?php _e('Horizontal', MSWP_TEXT_DOMAIN); ?></option>
                    <option value="v"><?php _e('Vertical', MSWP_TEXT_DOMAIN); ?></option>
                {{/dropdwon-List}}
            </div>--}}

            {{#if isTab}}
                <div class="msp-metabox-indented">
                    {{switch-box value=currentControl.insertThumb}} <?php _e('Insert thumbnail inside tabs', MSWP_TEXT_DOMAIN); ?>
                </div>
            {{else}}
                <div class="msp-metabox-indented">
                    <?php _e('Thumb background fill mode :', MSWP_TEXT_DOMAIN); ?>
                    {{view MSPanel.Fillmode value=currentControl.fillMode}}
                 </div>
            {{/if}}

            <div class="msp-metabox-indented">
                <label><?php _e('Thumb/Tab width :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.width}} px
                <div class="msp-form-space-med"></div>
                <label><?php _e('Thumb/Tab height :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.height}} px
                <div class="msp-form-space-med"></div>
                <label><?php _e('Space between thumbs/tabs :', MSWP_TEXT_DOMAIN); ?> </label> {{number-input value=currentControl.space}} px
            </div>

        </div>
    {{/meta-box}}
</script>

<!-- Slider Apis -->
<script type="text/x-handlebars" id="callbacks">
    {{#meta-box title="Slider Callbacks"}}
        <div class="msp-metabox-row">

            <h4><?php _e('Here you can add or remove callbacks to slider', MSWP_TEXT_DOMAIN); ?></h4>

            <div class="msp-metabox-indented">
                <label><?php _e('Add new callback', MSWP_TEXT_DOMAIN); ?></label>
                {{#if noMore}}
                    <button class="msp-add-btn disabled"><span class="msp-ico msp-ico-whiteadd"></span></button>
                {{else}}
                    <button {{action addCallback}} class="msp-add-btn"><span class="msp-ico msp-ico-whiteadd"></span></button>
                {{/if}}

                {{#dropdwon-List value=selectedCallback width=250}}
                    {{#each callback in availableCallbacks}}
                        <option {{bind-attr value=callback.value}}>{{callback.label}}</option>
                    {{else}}
                        <option><?php _e('-- All callbacks are added --', MSWP_TEXT_DOMAIN); ?></option>
                    {{/each}}
                {{/dropdwon-List}}
            </div>
        </div>
        {{#each callback in controller}}
            <hr class="msp-metabox-hr">
            <div class="msp-metabox-row">
                <h4>{{callback.label}} : </h4>
                <div class="msp-metabox-indented">
                    {{#code-mirror width="100%" height="auto" mode="javascript" value=callback.content}}{{/code-mirror}}
                </div>
                <div class="msp-metabox-indented">
                    <button {{action "removeCallback" callback}} class="msp-blue-btn msp-remove-btn-med"><?php _e('Remove', MSWP_TEXT_DOMAIN); ?></button>
                </div>
            </div>
        {{/each}}
    {{/meta-box}}
</script>

<!-- empty template -->
<script type="text/x-handlebars" id="empty-template"></script>
