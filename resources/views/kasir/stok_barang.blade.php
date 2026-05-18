@extends('kasir.layouts.layout')

@section('title', 'Stok Barang - Toserba Hasan')
@section('page-title', 'Stok Barang')

@section('content')

    <!-- Kontainer Utama -->
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        <livewire:stok-search />
    </div>
    <!-- Akhir Kontainer Utama -->
@endsection
