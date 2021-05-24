<?php
namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public $site_name; // <-- You need to have this line

    public static function group(): string
    {
        return 'general';
    }
}
