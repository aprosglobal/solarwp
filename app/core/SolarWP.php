<?php

namespace Aprosglobal\Solarwp\core;

use Dotenv\Dotenv;

class SolarWP
{
  public function __construct()
  {
    self::load_env();

    // Build the directory structure
    BuildDir::init();

    // Create the symbolic link to the public directory
    SymbolinkPublicDir::init();
  }

  public static function init()
  {
    new self();
  }

  /**
   * Read .env file and set environment variables
   * if not set in .env file
   * @return void
   */
  public static function load_env(): void
  {
    // find the .env file and load it
    // if not found, do nothing
    // if found, load it
    if (!self::find_theme_files('.env') && !self::find_theme_files('.env.production')) return;

    $dotenv = Dotenv::createUnsafeMutable(get_stylesheet_directory());
    $dotenv->load();
  }

  /**
   * Find files in the wordpress theme directory
   * and load them
   * @param string $filename
   * @return bool
   */
  private static function find_theme_files(string $filename): bool
  {
    return file_exists(get_stylesheet_directory() . "/$filename");
  }
}
