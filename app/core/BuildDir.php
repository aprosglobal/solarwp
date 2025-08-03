<?php

namespace Aprosglobal\Solarwp\core;

use Spatie\Ignition\Ignition;
use EvoMark\WpVite\WpVite;

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

    if (env('APP_ENV', 'production') === 'development') {


      //Init Beatiful error view
      set_exception_handler(function (\Throwable $e) {
        // Clear output buffer to prevent partial rendering
        while (ob_get_level() > 0) {
          ob_end_clean();
        }

        // Display Ignition's error page
        if (class_exists(Ignition::class)) {
          echo "<div class='error-page'>";
          Ignition::make()
            ->registerMiddleware([
              function ($report, $next) {
                $report->group('WordPress Info', [
                  'Version' => get_bloginfo('version'),
                  'Theme' => wp_get_theme()->get('Name'),
                ]);
                return $next($report);
              }
            ])
            ->setTheme('dark')
            ->applicationPath(get_stylesheet_directory()) // Set to project root
            ->shouldDisplayException(true)
            ->register()
            ->handleException($e);
          echo "</div>";
          echo "
          // <style>
          //   :after, :before, :not(iframe) {
          //       position: unset;
          //   }
          //   .error-page {
          //     position: absolute;
          //     top: 0;
          //     left: 0;
          //     width: 100%;
          //     height: 100%;
          //     background: black;
          //   }
          // </style>
        ";
        } else {
          echo '<pre>';
          print_r($e);
          echo '</pre>';
        }

        exit; // Prevent further execution
      });


      // We need to add HMR ;)
      $vite = new WpVite;
      $vite->enqueue([
        'namespace' => 'solarwp',
        'input' => ["src/main.ts"],
      ]);
    } else {
      $vite = new WpVite;
      $vite->enqueue([
        'namespace' => 'solarwp',
        'input' => ["src/main.ts"],
        'absolutePath' => get_theme_file_path(),
        'absoluteUrl' => home_url(),
        'buildDirectory' =>  'public/dist',
      ]);
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
      'public_url' => site_url('/public'),
      'ajax_url' => admin_url('admin-ajax.php'),
      'security' => wp_create_nonce('consult_ajax'),
    );
  }
}
