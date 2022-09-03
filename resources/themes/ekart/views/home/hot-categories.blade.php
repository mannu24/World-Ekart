@php
$category = ['home','mobile']
@endphp
<hot-categories heading="{{ __('velocity::app.home.hot-categories') }}" :categories="{{ json_encode($category) }}">
</hot-categories>
