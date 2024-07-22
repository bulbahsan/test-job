<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('rows', function () {
    return true;
});
Broadcast::channel('uploads', function () {
    return true;
});
Broadcast::channel('import', function () {
    return true;
});
