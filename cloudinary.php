<?php
require 'vendor/autoload.php';
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

// configure an instance via a JSON object

Configuration::instance([
  'cloud' => [
    'cloud_name' => 'epylog',
    'api_key'  => '189329453142558',
    'api_secret' => 'ylf8uF7tO3KX5T3TtJ3oPncdkb8',
  'url' => [
    'secure' => true]]]);

?>