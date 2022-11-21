<?php
/**
 * @package   Meal_Planner
 * @author    Gary Jones
 * @link      http://example.com/meal-planner
 * @copyright 2013 Gary Jones
 * @license   GPL-2.0+
 */
/**   Only need to specify class properties here       */

class Tkbooking_Template_Loader extends Gamajo_Template_Loader {
    /**
     * Prefix for filter names.
     */
    protected $filter_prefix = 'tkbooking';

    /**
     * Directory name where custom templates for this plugin should be found in the theme.
     */
    protected $theme_template_directory = 'tkbooking';

    /**
     * Reference to the root directory path of this plugin.
     * Can either be a defined constant, or a relative reference from where the subclass lives.
     * In this case, `MEAL_PLANNER_PLUGIN_DIR` would be defined in the root plugin file as:
     *
     * define( 'MEAL_PLANNER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
     */
    protected $plugin_directory = TKBOOKING_PLUGIN_DIR;

    /**
     * Directory name where templates are found in this plugin.
     * Can either be a defined constant, or a relative reference from where the subclass lives.
     * e.g. 'templates' or 'includes/templates', etc.
     */
    protected $plugin_template_directory = 'templates';
}