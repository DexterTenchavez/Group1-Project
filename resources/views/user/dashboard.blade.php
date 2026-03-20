<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome to G1 Group
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold text-center">Welcome to G1 Group</h3>
                    
                    <!-- Members Link -->
                    <div class="text-center mt-6">
                        <a href="#members" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                            <i class="bi bi-people me-2"></i>
                            View Members
                            <i class="bi bi-arrow-down ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Members Section (Scroll to here) -->
            <div id="members" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Group Members</h3>
                    
                    <div class="space-y-3">
                        <!-- Nila Latha -->
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                                NL
                            </div>
                            <div class="ml-3">
                                <p class="font-semibold text-gray-800">Nila Latha</p>
                                <p class="text-sm text-gray-500">Member</p>
                            </div>
                        </div>

                        <!-- Deepa Sathyanarayana -->
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                                DS
                            </div>
                            <div class="ml-3">
                                <p class="font-semibold text-gray-800">Deepa Sathyanarayana</p>
                                <p class="text-sm text-gray-500">Member</p>
                            </div>
                        </div>

                        <!-- Anil Kumar -->
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                                AK
                            </div>
                            <div class="ml-3">
                                <p class="font-semibold text-gray-800">Anil Kumar</p>
                                <p class="text-sm text-gray-500">Member</p>
                            </div>
                        </div>

                        <!-- Karthik Ramakrishnan -->
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                                KR
                            </div>
                            <div class="ml-3">
                                <p class="font-semibold text-gray-800">Karthik Ramakrishnan</p>
                                <p class="text-sm text-gray-500">Member</p>
                            </div>
                        </div>

                        <!-- Venkatesh Balasubramanian -->
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                                VB
                            </div>
                            <div class="ml-3">
                                <p class="font-semibold text-gray-800">Venkatesh Balasubramanian</p>
                                <p class="text-sm text-gray-500">Member</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-primary {
            background-color: #4e73df;
        }
        .bg-primary-dark {
            background-color: #224abe;
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
</x-app-layout>