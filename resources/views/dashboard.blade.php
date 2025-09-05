<x-layouts.dashboard>
    <div class="px-6 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Welcome {{ Auth::user()->name }}!</h1>

        <!-- Cards -->
        <div class="grid grid-cols-1 
        {{Auth::user()->hasRole('admin') ? 'md:grid-cols-2' : 'md:grid-cols-1'}} 
        gap-6 mb-12">
            @hasrole('admin')
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Total Doctors</h2>
                        <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalDoctors }}</p>
                    </div>
                    <div class="text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8c-1.657 0-3 1.343-3 3v4a3 3 0 006 0v-4c0-1.657-1.343-3-3-3z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5 12h14"/>
                        </svg>
                    </div>
                </div>
            </div>
            @endhasrole

            <!-- Total Patients Card -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Total Patients</h2>
                        <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalPatients }}</p>
                    </div>
                    <div class="text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5.121 17.804A8 8 0 1116.88 6.196 8 8 0 015.121 17.804z"/>
                        </svg>
                    </div>
                </div>
            </div>

            
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 {{Auth::user()->hasRole('admin') ? 'md:grid-cols-2' : 'md:grid-cols-1'}}  gap-6">
            @hasrole('admin')
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Doctors Chart</h2>
                <canvas id="doctorsChart" class="w-full h-64"></canvas>
            </div>
            @endhasrole
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Patients Chart</h2>
                <canvas id="patientsChart" class="w-full h-64"></canvas>
            </div>

        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const months = @json($months);
        const patientsPerMonth = @json(array_values($patientsPerMonth->toArray()));
        const doctorsPerMonth = @json(array_values($doctorsPerMonth->toArray()));

        const patientsData = {
            labels: months,
            datasets: [{
                label: 'Patients',
                data: patientsPerMonth,
                backgroundColor: 'rgba(99, 102, 241, 0.5)',
                borderColor: 'rgba(99, 102, 241, 1)',
                borderWidth: 1
            }]
        };

        const doctorsData = {
            labels: months,
            datasets: [{
                label: 'Doctors',
                data: doctorsPerMonth,
                backgroundColor: 'rgba(16, 185, 129, 0.5)',
                borderColor: 'rgba(16, 185, 129, 1)',
                borderWidth: 1
            }]
        };

        // Render Patients Chart
        new Chart(document.getElementById('patientsChart'), {
            type: 'bar',
            data: patientsData,
            options: {
                responsive: true,
                plugins: { legend: { display: true } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Render Doctors Chart
        new Chart(document.getElementById('doctorsChart'), {
            type: 'bar',
            data: doctorsData,
            options: {
                responsive: true,
                plugins: { legend: { display: true } },
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
</x-layouts.dashboard>
