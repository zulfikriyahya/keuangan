<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class SitesSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('sites.site_name', '3x1');
        $this->migrator->add('sites.site_description', 'Madrasah digital untuk generasi hebat!');
        $this->migrator->add('sites.site_keywords', 'Edukasi, Administrasi, Keuangan, Otomatisasi, Zona Integritas');
        $this->migrator->add('sites.site_profile', '');
        $this->migrator->add('sites.site_logo', '');
        $this->migrator->add('sites.site_author', 'Yahya Zulfikri');
        $this->migrator->add('sites.site_address', 'Pandeglang, Banten, Indonesia');
        $this->migrator->add('sites.site_email', 'adm@mtsn1pandeglang.sch.id');
        $this->migrator->add('sites.site_phone', '+6289612050291');
        $this->migrator->add('sites.site_phone_code', '+62');
        $this->migrator->add('sites.site_location', 'Indonesia');
        $this->migrator->add('sites.site_currency', 'IDR');
        $this->migrator->add('sites.site_language', 'Indonesian');
        $this->migrator->add('sites.site_social', []);
    }
}
