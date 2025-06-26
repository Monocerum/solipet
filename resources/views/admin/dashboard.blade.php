@extends('admin.layout')

@section('title', 'Admin Dashboard')
<style>
    .main-container {
        width: 100%;
        min-height: 80vh;
        background-color: #E8C7AA;
        color: black;
        border-radius: 1em;

        .grid {
            padding: 5%;
        }

        h2 {
            text-align: center;
            padding-top: 5%;
            font-size: 2em;
            font-family: "Irish Grover", sans-serif;
        }
    }
</style>
@section('content')
<div class="main-container">
    <h2 class="section-name" id="sectionName">ADMIN DASHBOARD</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg p-6 shadow">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-full">
                    <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Total Orders</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $totalOrders ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg p-6 shadow">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-full">
                    <i class="fas fa-box text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Total Products</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $totalProducts ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg p-6 shadow">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-full">
                    <i class="fas fa-users text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Total Customers</h3>
                    <p class="text-2xl font-bold text-purple-600">{{ $totalCustomers ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg p-6 shadow">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-full">
                    <i class="fas fa-dollar-sign text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Revenue</h3>
                    <p class="text-2xl font-bold text-yellow-600">PHP{{ number_format($totalRevenue ?? 0, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection