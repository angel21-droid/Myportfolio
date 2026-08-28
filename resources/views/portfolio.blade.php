@php
    $portfolio = require resource_path('views/partials/config.php');
@endphp

<x-app-layout :portfolio="$portfolio" />
