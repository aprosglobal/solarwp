<?php

namespace Aprosglobal\Solarwp\core;

/**
 * @package SolarWP
 * @author  Aprosglobal <info@apros.global>
 * @license GNU General Public License v2.0+
 * @link    https://github.com/aprosglobal/solarwp
 * @version 0.0.1
 * @since   0.0.1
 */


class SymbolinkPublicDir
{
  /**
   * Initialize the symbolic link creation for the public directory.
   */
  public static function init()
  {
    // Define the paths for the stylesheet directory and the symbolic link
    $public_dir = get_stylesheet_directory() . '/public';
    $symbolink_link = ABSPATH . 'public';

    // Check if the symbolic link already exists
    if (file_exists($symbolink_link)) {
      // If it exists, check if it is a symbolic link
      if (is_link($symbolink_link)) {
        // If it's a symbolic link, check if it points to the correct directory
        if (readlink($symbolink_link) == $public_dir) {
          //echo 'Same'; // The link points to the correct directory
        } else {
          // echo 'Different'; // The link points to a different directory
          unlink($symbolink_link); // Remove the incorrect symbolic link
        }
      } else {
        // echo 'Not link'; // It's not a symbolic link (it's a regular file or directory)
        unlink($symbolink_link); // Remove it
      }
    }

    // If the symbolic link does not exist, create it
    if (!file_exists($symbolink_link)) {
      // Create the public directory if it doesn't exist
      if (is_dir($public_dir)) {
        if (symlink($public_dir, $symbolink_link)) {
          // echo 'Created'; // Successfully created the symbolic link
        } else {
          echo 'Error'; // Failed to create the symbolic link
          throw new \Exception('Failed to create symbolic link');
        }
      } else {
        throw new \Exception('Public directory does not exist, create a public directory');
      }
    }
  }
}
