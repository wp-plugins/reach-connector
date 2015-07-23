<?php

/**
 * @package Reach_Connector
*/
/*
Plugin Name: REACH Connector
Plugin URI: http://wordpress.org/plugins/reach-connector/
Description: This plugin enables you to easily integrate your REACH&#8480; campaign and sponsorships with your WordPress site. For more information on REACH&#8480; visit http://www.reachapp.co.
Author: Sugar Maple Interactive, LLC
Version: 1.5
Author URI: http://sugarmapleinteractive.com/code/wordpress/plugins/reach-connector
Text Domain: reach
License: GPLv2
*/
/*
Copyright 2015  Sugar Maple Interactive, LLC  (email : support@reachapp.co)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


if(!class_exists('Reach_Connector_Plugin')) {
  class Reach_Connector_Plugin
  {
    public function __construct() {
      // Register WordPress actions for custom plugin
      add_action('admin_init', array($this, 'admin_init'));
      add_action('admin_menu', array($this, 'admin_menu'));
    }

    // Activates WordPress plugin
    public static function activate() {
      // does nothing custom
    }

    // Deactivate the plugin
    public static function deactivate() {
      // does nothing custom
    }

    // Initialize Custom Plugin Settings
    public function init_settings() {
      // backend options (invisible to the user) [only creates if non-existent]
      add_option( 'reach_root_page_id' );
      add_option( 'reach_campaign_page_id' );
      // Setting "Keys"
      register_setting( 'reach-connector', 'reach_api_host' );
      register_setting( 'reach-connector', 'reach_account_guid' );
      register_setting( 'reach-connector', 'reach_sponsorship_class' );
      register_setting( 'reach-connector', 'reach_campaign_class' );
      // Setting Sections : Section ID, Section Title, Callback, Page ID (Menu Slug)
      add_settings_section('section-one', 'REACH&#8480; Account Information', array($this, 'text_for_section_one'), 'reach-connector-options' );
    	// Setting Fields : Filed ID, Field Title, Callback, Page ID (Menu Slug), Section ID
      add_settings_field( 'reach_api_host', 'REACH&#8480; Account URL', array($this, 'field_for_api_host'), 'reach-connector-options', 'section-one' );
      add_settings_field( 'reach_account_guid', 'Account GUID', array($this, 'field_for_account_guid'), 'reach-connector-options', 'section-one' );
      add_settings_section('style-section', 'Style Options', array($this, 'text_for_style_section'), 'reach-connector-options' );
      add_settings_field( 'reach_sponsorship_class', 'Sponsorship CSS Class', array($this, 'field_for_sponsorship_classes'), 'reach-connector-options', 'style-section' );
      add_settings_field( 'reach_campaign_class', 'Campaign CSS Class', array($this, 'field_for_campaign_classes'), 'reach-connector-options', 'style-section' );
      add_settings_section('section-two', 'Sponsorship Shortcode Setup', array($this, 'text_for_section_two'), 'reach-connector-options' );
      add_settings_section('section-three', 'Campaigns Shortcode Setup', array($this, 'text_for_section_three'), 'reach-connector-options' );
      add_settings_section('section-four', 'Campaign Page Shortcode Setup', array($this, 'text_for_section_four'), 'reach-connector-options' );
      add_settings_section('section-five', 'Donation Shortcode Setup', array($this, 'text_for_section_five'), 'reach-connector-options' );
      add_settings_section('section-six', 'Projects Shortcode Setup', array($this, 'text_for_section_six'), 'reach-connector-options' );
      add_settings_section('section-seven', 'Project Page Shortcode Setup', array($this, 'text_for_section_seven'), 'reach-connector-options' );
      add_settings_section('section-eight', 'Places Shortcode Setup', array($this, 'text_for_section_eight'), 'reach-connector-options' );
      add_settings_section('section-nine', 'Place Page Shortcode Setup', array($this, 'text_for_section_nine'), 'reach-connector-options' );
    }

    // Hook for WordPress admin_init action
    public function admin_init() {
      // Set up the settings for this plugin
      $this->init_settings();
    }

    // Hook for WordPress admin_menu action
    public function admin_menu() {
      # Page Title, Menu Item, User Capability, Menu Slug (Page ID), Callback
      add_options_page('REACH&#8480; Connector Options', 'REACH&#8480; Connector',
        'manage_options', 'reach-connector-options',
        array($this, 'plugin_settings'));
    }

    public function plugin_settings() {
      if(!current_user_can('manage_options'))
      {
          wp_die(__('Your account does not have sufficient permissions to manage plugin settings.'));
      }

      // Render the settings template
      include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
    }

    public function setting_section_title() {
      echo "<p>REACH&#8480; Connector Settings Intro</p>";
    }

    public function field_for_account_guid() {
      $setting_value = esc_attr( get_option( 'reach_account_guid' ) );
      echo "<input class='regular-text' type='text' name='reach_account_guid' value='$setting_value' placeholder='GUID' />";
    }

    public function field_for_api_host() {
      $setting_value = esc_attr( get_option( 'reach_api_host' ) );
      echo "<input class='regular-text' type='text' name='reach_api_host' value='$setting_value' placeholder='domain.reachapp.co' />";
    }
    
    public function field_for_sponsorship_classes() {
      $setting_value = esc_attr( get_option( 'reach_sponsorship_class' ) );
      echo "<input class='regular-text' type='text' name='reach_sponsorship_class' value='$setting_value' />";
    }
    
    public function field_for_campaign_classes() {
      $setting_value = esc_attr( get_option( 'reach_campaign_class' ) );
      echo "<input class='regular-text' type='text' name='reach_campaign_class' value='$setting_value' />";
    }

    public function text_for_section_one() {
    	echo "Enter your REACH&#8480; Account URL and Account GUID to setup the REACH&#8480; Connector plugin.";
    }
    
    public function text_for_style_section() {
    	echo "Enter additional CSS classes to use for the sponsorship and campaign widgets. Separate class names with a space.";
    }
    
    public function text_for_section_two() {
    	echo "To pull a list of sponsorships from REACH&#8480; to display on your site use the shortcode [sponsorships]. You can also pass optional parameters to filter your sponsorship results similar to the dropdown filters on the Sponsorships page using the parameters:";
      echo "<p><blockquote>sponsorship_type<br/>location<br/>project<br/>sponsorship_categories<br/>status</blockquote></p>";
      echo '<p>Example: [sponsorships sponsorship_type="children"]';
    }
    
    public function text_for_section_three() {
    	echo "To pull a list of campaigns from REACH&#8480; to display on your site use the shortcode [campaigns].";
    }
    
    public function text_for_section_four() {
    	echo "To pull a specific campaign from REACH&#8480; to display on your site use the shortcode with the permalink shown in REACH&#8480; [campaign permalink='my-campaign-permalink'].";
    }
    
    public function text_for_section_five() {
    	echo "To display a donation page from REACH&#8480; on your site use the shortcode [donations] on any page. You can also pass optional paramters defined in the Giving Options page in REACH to customize the donation form by setting amount, recurring period, purpose etc.";
      echo "<p><blockquote>amount<br/>fixed_amount (true/false)<br/>recurring<br/>fixed_recurring (true/false)<br/>referral</blockquote></p>";
      echo '<p>Example: [donations amount="50"]';
    }
    
    public function text_for_section_six() {
    	echo "To pull a list of projects from REACH&#8480; to display on your site use the shortcode [projects].";
    }
    
    public function text_for_section_seven() {
    	echo "To pull a specific project from REACH&#8480; to display on your site use the shortcode with the permalink shown in REACH&#8480; [project permalink='my-project-permalink'].";
    }
    
    public function text_for_section_eight() {
    	echo "To pull a list of places from REACH&#8480; to display on your site use the shortcode [places].";
    }
    
    public function text_for_section_nine() {
    	echo "To pull a specific place from REACH&#8480; to display on your site use the shortcode with the permalink shown in REACH&#8480; [place permalink='my-place-permalink'].";
    }
  }
}

function reach_get_sponsorship_json($i) {
  $search  = array('https://', 'http://');
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $url = "http://".str_replace($search, '', $reach_api_host)."/sponsorships.json?".http_build_query($i);
  $json = json_decode(file_get_contents($url));
	return $json;
}

function reach_get_campaign_json($i) {
  $search  = array('https://', 'http://');
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $url = "http://".str_replace($search, '', $reach_api_host)."/campaigns.json?".http_build_query($i);
  $json = json_decode(file_get_contents($url));
	return $json;
}

function get_sponsorships($atts) {
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $reach_sponsorship_class = esc_attr( get_option( 'reach_sponsorship_class' ) );
  $search  = array('https://', 'http://');
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $atts = shortcode_atts( array(
      'sponsorship_type' => '',
      'location' => '',
      'project' => '',
      'sponsorship_categories' => '',
      'status' => '',
      'hide_filters' => '',
      'disablenav' => 'true',
  ), $atts, 'sponsorships' );
  echo "<iframe id='sponsorships-iframe' src='https://".str_replace($search, '', $reach_api_host)."/sponsorships?".http_build_query($atts)."' width='100%' height='2000px' scrolling='no' frameborder='0'></iframe>";
  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.min.js'></script>";
  echo '<script>$("#sponsorships-iframe").iFrameResize();</script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.contentWindow.min.js'></script>";
}

function get_campaigns() {
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $reach_campaign_class = esc_attr( get_option( 'reach_campaign_class' ) );
  $search  = array('https://', 'http://');
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  echo "<iframe id='campaigns-iframe' src='https://".str_replace($search, '', $reach_api_host)."/campaigns?disablenav=true' width='100%' scrolling='no' frameborder='0'></iframe>";
  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.min.js'></script>";
  echo '<script>$("#campaigns-iframe").iFrameResize();</script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.contentWindow.min.js'></script>";
}

function get_projects() {
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $search  = array('https://', 'http://');
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  echo "<iframe id='projects-iframe' src='https://".str_replace($search, '', $reach_api_host)."/projects?disablenav=true' width='100%' scrolling='no' frameborder='0'></iframe>";
  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.min.js'></script>";
  echo '<script>$("#projects-iframe").iFrameResize();</script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.contentWindow.min.js'></script>";
}

function get_places() {
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $search  = array('https://', 'http://');
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  echo "<iframe id='places-iframe' src='https://".str_replace($search, '', $reach_api_host)."/places?disablenav=true' width='100%' scrolling='no' frameborder='0'></iframe>";
  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.min.js'></script>";
  echo '<script>$("#places-iframe").iFrameResize();</script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.contentWindow.min.js'></script>";
}

function get_project_page($atts) {
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $search  = array('https://', 'http://');
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $atts = shortcode_atts( array(
      'permalink' => '',
      'disablenav' => 'true',
  ), $atts, 'sponsorships' );
  echo "<iframe id='projects-iframe' src='https://".str_replace($search, '', $reach_api_host)."/projects/".$atts['permalink']."?disablenav=true' width='100%' scrolling='no' frameborder='0'></iframe>";
  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.min.js'></script>";
  echo '<script>$("#projects-iframe").iFrameResize();</script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.contentWindow.min.js'></script>";
}

function get_place_page($atts) {
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $search  = array('https://', 'http://');
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $atts = shortcode_atts( array(
      'permalink' => '',
      'disablenav' => 'true',
  ), $atts, 'sponsorships' );
  echo "<iframe id='places-iframe' src='https://".str_replace($search, '', $reach_api_host)."/places/".$atts['permalink']."?disablenav=true' width='100%' scrolling='no' frameborder='0'></iframe>";
  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.min.js'></script>";
  echo '<script>$("#places-iframe").iFrameResize();</script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.contentWindow.min.js'></script>";
}

function get_campaign_page($atts) {
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $search  = array('https://', 'http://');
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $atts = shortcode_atts( array(
      'permalink' => '',
      'disablenav' => 'true',
  ), $atts, 'sponsorships' );
  echo "<iframe id='campaigns-iframe' src='https://".str_replace($search, '', $reach_api_host)."/campaigns/".$atts['permalink']."?disablenav=true' width='100%' scrolling='no' frameborder='0'></iframe>";
  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.min.js'></script>";
  echo '<script>$("#campaigns-iframe").iFrameResize();</script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.contentWindow.min.js'></script>";
}

function get_donation_page($atts) {
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $reach_campaign_class = esc_attr( get_option( 'reach_campaign_class' ) );
  $search  = array('https://', 'http://');
  $reach_api_host = esc_attr( get_option( 'reach_api_host' ) );
  $atts = shortcode_atts( array(
      'amount' => '',
      'fixed_amount' => '',
      'recurring' => '',
      'fixed_recurring' => '',
      'referral' => '',
      'disablenav' => 'true',
  ), $atts, 'sponsorships' );
  echo "<iframe id='donations-iframe' src='https://".str_replace($search, '', $reach_api_host)."/donations/new?".http_build_query($atts)."' width='100%' scrolling='no' frameborder='0'></iframe>";
  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.min.js'></script>";
  echo '<script>$("#donations-iframe").iFrameResize();</script>';
  echo "<script type='text/javascript' src='https://".str_replace($search, '', $reach_api_host)."/assets/iframeResizer.contentWindow.min.js'></script>";
}

add_shortcode('sponsorships', 'get_sponsorships');
add_shortcode('campaigns', 'get_campaigns');
add_shortcode('campaign', 'get_campaign_page');
add_shortcode('projects', 'get_projects');
add_shortcode('project', 'get_project_page');
add_shortcode('places', 'get_places');
add_shortcode('place', 'get_place_page');
add_shortcode('donations', 'get_donation_page');

if(class_exists('Reach_Connector_Plugin')) {
  // WordPress hooks to activate and deactivate the plugin
  register_activation_hook(__FILE__, array('Reach_Connector_Plugin', 'activate'));
  register_deactivation_hook(__FILE__, array('Reach_Connector_Plugin', 'deactivate'));

  // instantiate the plugin class
  $reach_connector_plugin = new Reach_Connector_Plugin();
}

// Adds link to the plugin settings page on the plugin info page
if(isset($reach_connector_plugin)) {

  function custom_settings_link($links) {
    $settings_link = '<a href="options-general.php?page=reach-connector-options">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
  }

  $plugin = plugin_basename(__FILE__);
  add_filter("plugin_action_links_$plugin", 'custom_settings_link');
}


?>