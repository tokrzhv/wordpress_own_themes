<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Service_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'servicesstellar';
    }

    public function get_title() {
        return esc_html__( 'Services Stellar', 'elementor-about-widget' );
    }

    public function get_icon() {
        return 'eicon-code';
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
            'title',
            [
                'label' => esc_html__( 'Title', 'elementor-wp_elem_stellar' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'elementor-wp_elem_stellar' ),
                'placeholder' => esc_html__( 'Type your title here', 'elementor-wp_elem_stellar' ),
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

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'service_title',
            [
                'label' => esc_html__( 'Title', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'service_content',
            [
                'label' => esc_html__( 'Content', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '',
                'show_label' => false,
            ]
        );
        $repeater->add_control(
            'service_icon',
            [
                'label' => __( 'Icon Class', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'show_label' => true,
            ]
        );
        $this->add_control(
            'service',
            [
                'label' => __( 'Magna veroeros', 'elementor-wp_elem_stellar' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ service_title }}}',
            ]
        );

        $this->end_controls_section();
    }
    protected function render() {

        $settings = $this->get_settings_for_display();
        ?>
        <section id="first" class="main special">
            <header class="major">
                <h2><?php echo $settings['title']?></h2>
            </header>
            <ul class="features">
                <?php $services = $settings['service'];
                        foreach ($services as $service){?>
                            <li>
                                <span class="<?php echo $service['service_icon']; ?>"></span>
                                <h3><?php echo $service['service_title']; ?></h3>
                                <p><?php echo $service['service_content']; ?></p>
                            </li>
                       <?php } ?>
            </ul>
            <footer class="major">
                <ul class="actions special">
                    <li><a href="<?php echo $settings['url']?>" class="button">Learn More</a></li>
                </ul>
            </footer>
        </section>

        <?php
    }
}