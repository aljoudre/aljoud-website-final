@php
    $structuredData = \App\Helpers\SeoHelper::structuredData($structuredData ?? []);
@endphp

<script type="application/ld+json">
{!! json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

