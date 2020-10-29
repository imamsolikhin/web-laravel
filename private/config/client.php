<?php

return [
    'group_id' => false,
    'property_id' => false,
    'id' => false,
    'show_plugin_on' => env('SHOW_PLUGIN_ON') ? explode(',', env('SHOW_PLUGIN_ON')) : []
];