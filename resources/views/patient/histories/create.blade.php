<x-layouts.dashboard>
  <div class="flex min-h-full w-full">
    <div class="flex flex-1 flex-col px-6 py-12 lg:px-12">
      <div class="w-full max-w-3xl mx-auto">
        <div>
          <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
               alt="Your Company" class="h-10 w-auto" />
          <h2 class="mt-8 text-2xl font-bold tracking-tight text-gray-900">
            Create History for {{ $patient->name }}
          </h2>
        </div>

        <div class="mt-10">
          <form action="{{ route('patients.histories.store', $patient->id) }}" method="POST" class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-8">
            @csrf

            <!-- Hidden patient id (optional; we will use route param server-side) -->
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">

            <!-- Diagnosis (textarea full width) -->
            <div class="lg:col-span-2">
              <label for="diagnosis" class="block text-sm font-medium text-gray-900">Diagnosis</label>
              <div class="mt-2">
                <textarea id="diagnosis" name="diagnosis" required rows="4"
                          class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm">{{ old('diagnosis') }}</textarea>
              </div>
              @error('diagnosis')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Treatment (textarea full width) -->
            <div class="lg:col-span-2">
              <label for="treatment" class="block text-sm font-medium text-gray-900">Treatment</label>
              <div class="mt-2">
                <textarea id="treatment" name="treatment" rows="4"
                          class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm">{{ old('treatment') }}</textarea>
              </div>
              @error('treatment')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Visit date -->
            <div>
              <label for="visit_date" class="block text-sm font-medium text-gray-900">Visit date</label>
              <div class="mt-2">
                <input id="visit_date" type="date" name="visit_date" required
                       value="{{ old('visit_date') }}"
                       class="block w-full rounded-md border border-gray-300 bg-white px-3 py-1.5 text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm" />
              </div>
              @error('visit_date')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- submit full-width -->
            <div class="mt-6 lg:mt-7">
              <button type="submit" class="w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-600">
                Save History
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-layouts.dashboard>
