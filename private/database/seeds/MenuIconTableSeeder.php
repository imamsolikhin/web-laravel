<?php

use Illuminate\Database\Seeder;

class MenuIconTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Design/Layers.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Layout/Layout-4-blocks.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Shopping/Barcode-read.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Design/Bucket.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Code/Compiling.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/General/Settings-1.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Home/Library.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Design/PenAndRuller.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Layout/Layout-left-panel-2.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Layout/Layout-horizontal.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Files/Upload.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Shopping/Box2.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Files/Pictures1.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Layout/Layout-arrange.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Devices/Diagnostics.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/General/Attachment2.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Design/Select.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Media/Equalizer.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Home/Book-open.svg']);
        \App\Models\MenuIcon::create(['icon_url'=>'media/svg/icons/Home/Mirror.svg']);

    }
}
