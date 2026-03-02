<?php
/**
 * Plugin Name: Dilunga Shortcodes
 * Plugin URI: https://shortcodes.dilunga.com
 * Description: A modular and scalable shortcode framework developed and maintained by Dilunga Labs. Built to power dynamic content rendering, reusable components, and advanced WordPress development workflows.
 * Version: 1.0.0
 * Author: Dilunga Labs
 * Author URI: https://dilunga.com
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dilunga-shortcodes
 */

if (!defined('ABSPATH'))
    exit;

// WhatsApp link shortcode
function d_whatsapp_book_current($atts)
{
    $atts = shortcode_atts([
        'number' => '',
    ], $atts);

    if (empty($atts['number'])) {
        return '';
    }

    // Get dynamic data
    $site_name = get_bloginfo('name');
    $title     = get_the_title();
    $link      = get_permalink();

    // Build message with proper line breaks
    $message  = "Hello {$site_name},\r\n";
    $message .= "I’m interested in \"{$title}\".\r\n";
    $message .= "Please share availability, pricing, or any relevant details.\r\n";
    $message .= $link;

    // Encode properly
    $encoded = rawurlencode($message);

    // WhatsApp API link
    $url = "https://api.whatsapp.com/send/?phone={$atts['number']}&text={$encoded}&type=phone_number&app_absent=0";

    return esc_url($url);
}

add_shortcode('book_whatsapp', 'd_whatsapp_book_current');