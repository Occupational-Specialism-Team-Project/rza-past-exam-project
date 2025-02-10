<?php

$settings = parse_ini_file("settings.ini");
foreach (array_keys($settings) as $setting) {
    $setting_name = strtoupper($setting);
    define($setting_name, $settings[$setting]);
}