<x-layouts.dashboard>
  <div class="max-w-3xl mx-auto py-10">
    <!-- Patient Info -->
    <div class="mb-6 border-b pb-4">
      <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Patient Prescription</h1>
      <p class="text-gray-700 dark:text-gray-300">Name: {{ $patient->name }}</p>
      <p class="text-gray-700 dark:text-gray-300">Gender: {{ $patient->gender }}</p>
      <p class="text-gray-700 dark:text-gray-300">Age: {{ $patient->age }}</p>
      <p class="text-gray-700 dark:text-gray-300">Email: {{ $patient->email }}</p>
      <p class="text-gray-700 dark:text-gray-300 mt-2">
        <span class="font-semibold">Visit Date:</span> {{ $history->visit_date }}
      </p>
    </div>

    <!-- Prescription Layout -->
    <div class="grid grid-cols-2 gap-6">
      <!-- Diagnosis -->
      <div class="pr-6 border-r border-gray-300 dark:border-gray-600">
        <h2 class="text-lg font-semibold text-indigo-600 dark:text-indigo-400 mb-2">Diagnosis</h2>
        <p class="text-gray-800 dark:text-gray-200 whitespace-pre-line">
          {{ $history->diagnosis }}
        </p>
      </div>

      <!-- Treatment -->
      <div class="pl-6">
        <h2 class="text-lg font-semibold text-green-600 dark:text-green-400 mb-2">Treatment</h2>
        <p class="text-gray-800 dark:text-gray-200 whitespace-pre-line">
          {{ $history->treatment }}
        </p>
      </div>
    </div>
  </div>
</x-layouts.dashboard>
