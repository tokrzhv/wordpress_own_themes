<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_About_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     * Retrieve  widget name.
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'aboutstellar';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'About Stellar', 'elementor-about-widget' );
    }

    /**
     * Get widget icon.
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-code';
    }

    /**
     * Get custom help URL.
     * Retrieve a URL where the user can get more information about the widget.
     * @since 1.0.0
     * @access public
     * @return string Widget help URL.
     */
    public function get_custom_help_url() {
        return 'https://developers.elementor.com/docs/widgets/';
    }

    /**
     * Get widget categories.
     * Retrieve the list of categories the oEmbed widget belongs to.
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'general' ];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'about', 'url', 'link' ];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'elementor-about-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'elementor-wp_elem_stellar' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'elementor-wp_elem_stellar' ),
                'placeholder' => esc_html__( 'Type your title here', 'elementor-wp_elem_stellar' ),
            ]
        );
        $this->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__( 'Default description', 'textdomain' ),
                'placeholder' => esc_html__( 'Type your description here', 'textdomain' ),
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'url',
            [
                'label' => esc_html__( 'Learn More', 'elementor-oembed-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'https://your-link.com', 'elementor-oembed-widget' ),
            ]
        );


        $this->end_controls_section();

    }

    /**
     * Render oEmbed widget output on the frontend.
     * Written in PHP and used to generate the final HTML.
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings_for_display();

        ?>

        <section id="intro" class="main">
            <div class="spotlight">
                <div class="content">
                   <?php if ($settings['title']){?>
                    <header class="major">
                        <h2><?php echo $settings['title']?></h2>
                    </header>
                       <?php }
                    if ($settings['description']){?>
                        <p><?php echo $settings['description']?></p>
                    <?php } ?>
                    <ul class="actions">
                        <li><a href="<?php echo $settings['url']?>" class="button">Learn More</a></li>
                    </ul>
                </div>
                <span class="image"><img src="<?php echo $settings['image']['url'] ?>" alt="" /></span>
            </div>
        </section>
<?php
    }
}