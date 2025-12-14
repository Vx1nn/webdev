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
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom">
                        <h4 class="card-title mb-0 text-primary">
                            <i class="{{ $roleMenu['icon'] }} me-2"></i>
                            {{ $roleMenu['title'] }}
                        </h4>
                    </div>
                    <div class="card-body p-3">
                        @foreach ($roleMenu['sections'] as $section)
                        <h5 class="mb-3 text-muted fw-semibold">
                            <i class="{{ $section['icon'] }} me-2"></i>
                            {{ $section['title'] }}
                        </h5>
                        <div class="row mb-4">
                            @foreach ($section['items'] as $itemIndex => $item)
                            @php
                                $colors = ['primary', 'success', 'info', 'warning', 'danger', 'secondary'];
                                $color = $colors[$itemIndex % 6];
                            @endphp
                            
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
                                <div class="small-box bg-gradient-{{ $color }} text-white shadow-sm h-100">
                                    <div class="inner p-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="icon-wrapper bg-white bg-opacity-25 p-2 rounded-circle">
                                                <i class="{{ $item['icon'] ?? 'bi bi-box' }} fs-3"></i>
                                            </div>
                                            @if(isset($item['count']))
                                            <span class="badge bg-white text-dark fs-6 px-3">{{ $item['count'] }}</span>
                                            @endif
                                        </div>
                                        <h5 class="mt-3 mb-1 fw-bold">{{ $item['title'] }}</h5>
                                        <p class="mb-0 opacity-75">Access {{ $item['title'] }} module</p>
                                    </div>
                                    <a href="{{ route($item['route']) }}" class="small-box-footer text-white py-2">
                                        <span>Go to Module</span>
                                        <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if(!$loop->last)<hr>@endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.small-box {
    border-radius: 8px;
    overflow: hidden;
    border: none;
}
.small-box:hover {
    transform: translateY(-3px);
    transition: transform 0.2s ease;
}
.icon-wrapper {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.bg-gradient-primary { background: linear-gradient(135deg, #0d6efd, #0b5ed7); }
.bg-gradient-success { background: linear-gradient(135deg, #198754, #157347); }
.bg-gradient-info { background: linear-gradient(135deg, #0dcaf0, #0baccc); }
.bg-gradient-warning { background: linear-gradient(135deg, #ffc107, #e0a800); }
.bg-gradient-danger { background: linear-gradient(135deg, #dc3545, #bb2d3b); }
.bg-gradient-secondary { background: linear-gradient(135deg, #6c757d, #5c636a); }
.small-box-footer {
    background: rgba(255,255,255,0.1);
    display: block;
    padding: 10px 15px;
    text-decoration: none;
}
.small-box-footer:hover {
    background: rgba(255,255,255,0.2);
}
</style>
@endsection