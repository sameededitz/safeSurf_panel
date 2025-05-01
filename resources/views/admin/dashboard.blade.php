@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <livewire:widgets.stats />
    <livewire:widgets.user-count />
    <livewire:widgets.sales-analytic />
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endsection
