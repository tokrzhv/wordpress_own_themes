<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
class Elementor_End_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'endstellar';
    }
    public function get_title() {
        return esc_html__( 'End Stellar', 'elementor-about-widget' );
    }
    public function get_categories() {
        return [ 'general' ];
    }
    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'elementor-about-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'end_title',
            [
                'label' => esc_html__( 'Title', 'elementor-wp_elem_stellar' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'elementor-wp_elem_stellar' ),
                'placeholder' => esc_html__( 'Type your title here', 'elementor-wp_elem_stellar' ),
            ]
        );
        $this->add_control(
            'end_desc',
            [
                'label' => esc_html__( 'title desc', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '',
                'show_label' => false,
            ]
        );

        $this->add_control(
            'url-1',
            [
                'label' => esc_html__( 'Learn More', 'elementor-oembed-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'https://your-link.com', 'elementor-oembed-widget' ),
            ]
        );
        $this->add_control(
            'url-2',
            [
                'label' => esc_html__( 'Learn More', 'elementor-oembed-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'https://your-link.com', 'elementor-oembed-widget' ),
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section id="cta" class="main special">
        <header class="major">
            <h2><?php echo $settings['end_title']?></h2>
            <p><?php echo $settings['end_desc']?></p>
        </header>
        <footer class="major">
            <ul class="actions special">
                <li><a href="<?php echo $settings['url-1']?>" class="button primary">Get Started</a></li>
                <li><a href="<?php echo $settings['url-2']?>" class="button">Learn More</a></li>
            </ul>
        </footer>
        </section>

        <?php
    }
}