<?php
declare(strict_types=1);

return [
    'link_ref_length' => env('LINK_REF_LENGTH', 100), #7d
    'link_lifetime' => env('LINK_LIFE_TIME', 7 * 24 * 60 * 60), #7d
];
