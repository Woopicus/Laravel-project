<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('example', function ($user) {
    return true;
});
