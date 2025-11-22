<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
  @auth
    @php
      $user = Auth::user();
      $activeRoles = $user->getActiveRoles();
      $primaryRole = !empty($activeRoles) ? ucfirst($activeRoles[0]) : 'User';
      $userName = $user->nama ?? 'User';
    @endphp
    
    <title>{{ $primaryRole }} | Dashboard RSHP - {{ $userName }}</title>
    <meta name="title" content="{{ $primaryRole }} Panel | RSHP AdminLTE" />
    <meta name="description" content="{{ $primaryRole }} dashboard panel for Rumah Sakit Hewan Peliharaan management system. Manage patients, medical records, and appointments." />
    
  @else
    <title>Guest | RSHP System</title>
    <meta name="title" content="RSHP Management System" />
    <meta name="description" content="Rumah Sakit Hewan Peliharaan management system. Please login to access the dashboard." />
  @endauth

  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <meta name="color-scheme" content="light dark" />
  <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
  <meta name="theme-color" content="#090909" media="(prefers-color-scheme: dark)" />
  <meta name="author" content="RSHP Team" />
  <meta name="keywords"
    content="rumah sakit hewan, veterinary hospital, pet care, medical records, animal healthcare, {{ $primaryRole ?? 'admin' }} dashboard" />
  <meta name="supported-color-schemes" content="light dark" />
  
  <link rel="preload" href="./css/adminlte.css" as="style" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
    onload="this.media='all'" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="{{ asset('assets/css/adminlte.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
    integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
</head>