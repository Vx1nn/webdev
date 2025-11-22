@extends('layouts.lte.main')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            @foreach ($menus as $roleKey => $roleMenu)
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h4 class="card-title mb-0">
                                    <i class="{{ $roleMenu['icon'] }} me-2"></i>
                                    {{ $roleMenu['title'] }}
                                </h4>
                            </div>
                            <div class="card-body">
                                @foreach ($roleMenu['sections'] as $section)
                                    <h5 class="mb-3 border-bottom pb-2">
                                        <i class="{{ $section['icon'] }} me-2"></i>
                                        {{ $section['title'] }}
                                    </h5>
                                    <div class="row mb-4">
                                        @foreach ($section['items'] as $item)
                                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                                <div class="small-box {{ $item['color'] ?? 'bg-info' }}">
                                                    <div class="inner text-white">
                                                        <h5><strong>{{ $item['title'] }}</strong></h5>
                                                        <p class="mb-1 small">Manage {{ ($item['title']) }}</p>
                                                        @if(isset($item['count']))
                                                            <div class="count-badge">{{ $item['count'] }}</div>
                                                        @endif
                                                    </div>
                                                    <a href="{{ route($item['route']) }}" 
                                                       class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                                        Akses Modul <i class="bi bi-arrow-right ms-1"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if (empty($menus))
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Anda tidak memiliki role aktif. Silakan hubungi administrator.
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection