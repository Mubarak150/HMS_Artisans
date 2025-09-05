<x-layouts.dashboard>
  <div class="flex min-h-full w-full">
    <div class="flex flex-1 flex-col px-6 py-12 lg:px-12">
      <div class="w-full max-w-3xl mx-auto">
        <div>
          <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
               alt="Your Company" class="h-10 w-auto" />
          <h2 class="mt-8 text-2xl font-bold tracking-tight text-gray-900">
            Edit History for {{ $patient->name }}
          </h2>
        </div>

        <div class="mt-10">
          <form action="{{ route('patients.histories.update', [$patient->id,  $history->id]) }}" 
                method="POST" 
                class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-8">
            @csrf
            @method('PUT')

            <!-- Hidden patient id -->
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">

            <!-- Diagnosis -->
            <div class="lg:col-span-2">
              <label for="diagnosis" class="block text-sm font-medium text-gray-900">Diagnosis</label>
              <textarea id="diagnosis" name="diagnosis" required rows="4"
                        class="mt-2 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm">{{ old('diagnosis', $history->diagnosis) }}</textarea>
            </div>

            <!-- Treatment -->
            <div class="lg:col-span-2">
              <label for="treatment" class="block text-sm font-medium text-gray-900">Treatment</label>
              <textarea id="treatment" name="treatment" rows="4"
                        class="mt-2 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm">{{ old('treatment', $history->treatment) }}</textarea>
            </div>

            <!-- Visit date -->
            <div>
              <label for="visit_date" class="block text-sm font-medium text-gray-900">Visit date</label>
              <input id="visit_date" type="date" name="visit_date" required
                     value="{{ old('visit_date', $history->visit_date) }}"
                     class="mt-2 block w-full rounded-md border border-gray-300 bg-white px-3 py-1.5 text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm" />
            </div>

            <!-- Submit -->
            <div class="mt-6 lg:mt-7">
              <button type="submit" 
                      class="w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-600">
                Update History
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-layouts.dashboard>
