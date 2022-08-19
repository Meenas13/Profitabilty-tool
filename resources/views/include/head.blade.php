<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="_token" content="{{ csrf_token() }}" />
<link rel="icon" href="{{ asset('favicon.png')}}" />

<!-- font awesome library -->
<link rel="stylesheet" href="{{ asset('js/req/font.css') }}">
<!-- JQuery UI -->
<link rel="stylesheet" href="{{ asset('js/req/jquery-ui.css') }}">

<!-- Multi options (dropdown) select Bootstrap -->

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"> -->

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" /> -->
<!--Dynamic StyleSheets added from a view would be pasted here-->

@yield('styles')

<script src="{{ asset('js/app.js') }}"></script>

<!-- themekit admin template asstes -->

<link rel="stylesheet" href="{{ asset('all.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/theme.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/icon-kit/dist/css/iconkit.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/ionicons/dist/css/ionicons.min.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}"> -->
<link rel="stylesheet" href="{{ asset('js/req/jquery.dataTables.min.css') }}">

<link rel="stylesheet" href="{{ asset('js/req/select2.min.css') }}">

<!-- Stack array for including inline css or head elements -->
@stack('head')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">