<x-layouts.dashboard>
  <div class="flex min-h-full w-full">
    <div class="flex flex-1 flex-col px-6 py-12 lg:px-12">
      <div class="w-full max-w-3xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
          <h2 class="text-3xl font-bold tracking-tight text-gray-900">
            Doctor Profile
          </h2>
          <p class="mt-2 text-sm text-gray-600">Details of doctor #{{ $doctor->id }}</p>
        </div>

        <!-- Info Card -->
        <div class="bg-white rounded-xl shadow p-6 space-y-4">
          <div>
            <span class="text-gray-500 text-sm">Name</span>
            <p class="text-lg font-semibold text-gray-900">{{ $doctor->name }}</p>
          </div>

          <div>
            <span class="text-gray-500 text-sm">Email</span>
            <p class="text-lg text-gray-900">{{ $doctor->email }}</p>
          </div>

          <div>
            <span class="text-gray-500 text-sm">Gender</span>
            <p class="text-lg text-gray-900 capitalize">{{ $doctor->gender }}</p>
          </div>

          <div>
            <span class="text-gray-500 text-sm">Age</span>
            <p class="text-lg text-gray-900">{{ $doctor->age }}</p>
          </div>
        </div>

        <!-- Actions -->
        <div class="mt-6 flex gap-3">
          <a href="{{ route('doctors.edit', $doctor->id) }}" 
             class="px-4 py-2 rounded-md bg-indigo-600 text-white font-semibold hover:bg-indigo-500">
            Edit
          </a>
          <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" 
                onsubmit="return confirm('Are you sure you want to delete this doctor?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-4 py-2 rounded-md bg-red-600 text-white font-semibold hover:bg-red-500">
              Delete
            </button>
          </form>
          <a href="{{ route('doctors.index') }}" 
             class="px-4 py-2 rounded-md bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200">
            Back to List
          </a>
        </div>
      </div>
    </div>
  </div>
</x-layouts.dashboard>
