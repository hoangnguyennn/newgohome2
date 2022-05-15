{{-- <meta name="robots" content="noindex" /> --}}
<link rel="icon" href="{{ mix('images/favicon.ico') }}" />

@isset($seo)
    <meta name="description" content="{{ $seo->ogTitle }}" />

    <meta property="og:url" content="{{ $seo->ogUrl }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $seo->ogTitle }}" />
    <meta property="og:description" content="{{ $seo->ogTitle ?? '' }}" />
    <meta property="og:image" content="{{ $seo->ogImage }}" />

    @if ($seo->title)
        <title>{{ $seo->title }} | Go Home</title>
    @else
        <title>Go Home</title>
    @endif
@endisset

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4Y0XNVXX5J"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-4Y0XNVXX5J');
</script>
