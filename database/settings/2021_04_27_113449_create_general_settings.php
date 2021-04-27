<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Spatie');
        $this->migrator->add('general.address', '264 Sto Domingo St.');
        $this->migrator->add('general.city', 'Quezon City');
        $this->migrator->add('general.barangay', 'Holy Spirit');
        $this->migrator->add('general.contact_number', '09189182516');
        $this->migrator->add('general.logo', '');
    }
}
