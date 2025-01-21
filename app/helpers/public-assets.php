<?php

function get_public_file(string $filename)
{
  if (!$filename) throw new Exception('Filename is required');
  $path = get_stylesheet_directory() . '/public/' . $filename;
  return file_exists($path) ? $path : null;
}


function get_public_asset(string $filename)
{
  if (!$filename) throw new Exception('Filename is required');
  return site_url("/public/$filename");
}
