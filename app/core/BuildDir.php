<?php

namespace Aprosglobal\Solarwp\core;

use const SITE_URL;

/**
 * This class is used to build the directory structure of the child theme.
 * in this section implements vitejs output directory structure.
 *
 * @package Aprosglobal\Solarwp\core
 * @author  Aprosglobal <info@apros.global>
 * @license GNU General Public License v2.0+
 * @link    https://github.com/aprosglobal/solarwp
 * @version 0.0.1
 * @since   0.0.1
 */

#[\Attribute]
class BuildDir
{

  public static function init()
  {
    $json_data = json_encode(self::credentials());

    if (boolval(getenv('IS_DEV'))) {
      $vite_port = 5173;
      if (getenv('VITE_PORT')) {
        $vite_port = getenv('VITE_PORT');
      }

      //Init Beatiful error view
      \Spatie\Ignition\Ignition::make()
        ->applicationPath(get_theme_file_path())
        ->register();


      // We need to add HMR ;)
      add_action("wp_footer", function () use ($json_data, $vite_port) {
        echo "
            <script type='module'>
              var wpCredentials = $json_data
              import 'http://localhost:$vite_port/src/main.ts'
              window.process = {env:{NODE_ENV:'development'}}
            </script>
          ";
      }, 30);
    } else {
      add_action("wp_footer", function () {
        $script = <<<HTML
            <script>
             console.log(222,3303);
            </script>
          HTML;
        echo $script;
      }, 30);
    }
  }

  /**
   * Get credentials for the child theme
   * This credentials will be used in the vitejs configuration file.
   */
  private static function credentials()
  {
    return array(
      'domain' => site_url("/"),
      'public_url' => get_stylesheet_directory_uri() . '/public',
      'ajax_url' => admin_url('admin-ajax.php'),
      'security' => wp_create_nonce('consult_ajax'),
    );
  }
}
