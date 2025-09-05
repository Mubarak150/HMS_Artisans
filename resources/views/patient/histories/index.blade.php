<x-layouts.dashboard>
<div class="px-4 sm:px-6 lg:px-8 lg:pt-24">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-base font-semibold text-gray-900 dark:text-white">
        Patient History
      </h1>
      <p>
        Patinet Name: {{ $histories->first()?->patient->name ?? 'N/A' }}
      </p>
      <p>
        Gender: {{ $histories->first()?->patient->gender ?? 'N/A' }}
      </p>
       <p>
        Age: {{ $histories->first()?->patient->age ?? 'N/A' }}
       </p>
       <p>
        Email: {{ $histories->first()?->patient->email ?? 'N/A' }}
       </p>
    </div>
    <a href="{{ route('patients.histories.create', $patient->id ) }}" class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
      <button type="button"
        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500">
        Add Patient History
      </button>
    </a>
  </div>

  <div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <table class="relative min-w-full divide-y divide-gray-300 dark:divide-white/15">
          <thead>
            <tr>
              <th scope="col"
                class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-0 dark:text-white">
                Diagnosis
              </th>
              <th scope="col"
                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                Treatment
              </th>
              <th scope="col"
                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                Visit Date
              </th>
              
              <th scope="col"
                class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900 dark:text-white sr-only">
                Actions
              </th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-200 dark:divide-white/10">
            @forelse ($histories as $history)
              <tr>
                <!-- patient Name -->
                <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-0 dark:text-white">
                  {{ $history->diagnosis ?? 'N/A' }}
                </td>

                <!-- Email -->
                <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                  {{ $history->treatment ?? 'N/A' }}
                </td>

                <!-- Age -->
                <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                  {{ $history->visit_date ?? 'N/A' }}
                </td>

                <!-- Actions -->
                <td class="py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-0">
                  <a href="{{ route('patients.histories.show', [$history?->patient->id, $history->id]) }}" 
                    class="text-green-600 hover:text-green-900 dark:text-indigo-400 dark:hover:text-indigo-300 pr-2">
                    View
                  </a>

                  <a href="{{ route('patients.histories.edit', [$history?->patient->id, $history->id]) }}" 
                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 pr-2">
                    Edit
                  </a>

                  <!-- Delete Button -->
                  <button
                      onclick="openModal('{{ $history?->patient->id }}', '{{ $history->diagnosis }}', '{{ $history->id }}')"  
                      class="text-red-400 hover:text-red-600">
                      Delete
                  </button>

                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5"
                  class="px-3 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                  No previos record available
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- confirm delete Modal -->
<div id="deleteModal" class="fixed inset-0 hidden bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in flex items-center justify-center">
  <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-sm w-full">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Confirm Deletion</h2>
    <p id="deleteMessage" class="mt-2 text-sm text-gray-600 dark:text-gray-300"></p>
    <div class="mt-4 flex justify-end gap-2">
      <button onclick="closeModal()" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
      <form id="confirmDeleteForm" method="POST" action="#">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
          Delete
        </button>
      </form>
    </div>
  </div>
</div>

<script>
  function openModal(patientId, name, historyId) {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteMessage').innerText =
      `Are you sure you want to delete "${name}"?`;

    // Generate the correct action URL using Blade and replace placeholders
    let actionUrl = "{{ route('patients.histories.destroy', [':patient', ':history']) }}"
        .replace(':patient', patientId)
        .replace(':history', historyId);

    document.getElementById('confirmDeleteForm').action = actionUrl;
}


  function closeModal() {
    document.getElementById('deleteModal').classList.add('hidden');
  }
</script>

</x-layouts.dashboard>
