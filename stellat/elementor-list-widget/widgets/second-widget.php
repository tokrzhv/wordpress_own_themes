<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Second_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'secondstellar';
    }

    public function get_title() {
        return esc_html__( 'Second Stellar', 'elementor-about-widget' );
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
            'second_title',
            [
                'label' => esc_html__( 'Title', 'elementor-wp_elem_stellar' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'elementor-wp_elem_stellar' ),
                'placeholder' => esc_html__( 'Type your title here', 'elementor-wp_elem_stellar' ),
            ]
        );
        $this->add_control(
            'title_desc',
            [
                'label' => esc_html__( 'title desc', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '',
                'show_label' => false,
            ]
        );
       $this->add_control(
            'content2',
            [
                'label' => esc_html__( 'Content2', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '',
                'show_label' => false,
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
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'show_label' => true,
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
        $repeater->add_control(
            'service_style',
            [
                'label' => __( 'Icon Class', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'show_label' => true,
            ]
        );
        $repeater->add_control(
            'service_color',
            [
                'label' => esc_html__( 'Color Item', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .your-color' => 'background-color: {{VALUE}}'
                ],
            ]
        );
        $this->add_control(
            'service',
            [
                'label' => __( 'Magna veroeros2', 'elementor-wp_elem_stellar' ),
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
        <section id="second" class="main special">
            <header class="major">
                <h2><?php echo $settings['second_title']?></h2>
                <p><?php echo $settings['title_desc']?></p>
            </header>
            <ul class="statistics">
                <?php $services = $settings['service'];
                foreach ($services as $service){?>
                        <li class="<?php echo $service['service_style']?>">
                            <span class="<?php echo $service['service_icon']?>"></span>
                            <strong><?php echo $service['service_title'] ?></strong><?php echo $service['service_content']?>
                        </li>
                            <?php } ?>
            </ul>
            <p class="content"><?php echo $settings['content2']?></p>
            <footer class="major">
                <ul class="actions special">
                    <li><a href="<?php echo $settings['uri']?>" class="button">Learn More</a></li>
                </ul>
            </footer>
        </section>
        <?php
    }
}