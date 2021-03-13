@extends('layout.default')

@section('content')
    <div class="subheader py-2 {{ Metronic::printClasses('subheader', false) }}" id="kt_subheader">
        <div class="{{ Metronic::printClasses('subheader-container', false) }} d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">
                    Dashboard
                </h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                    	<a href="" class="text-muted">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xxl-4">
            @include('pages.widgets._widget-1', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-lg-6 col-xxl-4">
            @include('pages.widgets._widget-2', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-lg-6 col-xxl-4">
            @include('pages.widgets._widget-3', ['class' => 'card-stretch card-stretch-half gutter-b'])
            @include('pages.widgets._widget-4', ['class' => 'card-stretch card-stretch-half gutter-b'])
        </div>

        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-1">
            @include('pages.widgets._widget-5', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-xxl-8 order-2 order-xxl-1">
            @include('pages.widgets._widget-6', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">
            @include('pages.widgets._widget-7', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">
            @include('pages.widgets._widget-8', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-lg-12 col-xxl-4 order-1 order-xxl-2">
            @include('pages.widgets._widget-9', ['class' => 'card-stretch gutter-b'])
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
