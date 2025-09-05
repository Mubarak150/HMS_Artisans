<x-layouts.dashboard>
  <div class="flex min-h-full w-full">
    <div class="flex flex-1 flex-col px-6 py-12 lg:px-12">
      <div class="w-full">
        <div>
          <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
               alt="Your Company"
               class="h-10 w-auto" />
          <h2 class="mt-8 text-2xl font-bold tracking-tight text-gray-900">
            Edit patient
          </h2>
        </div>

        <!-- FORM -->
        <div class="mt-10">
          <form action="{{ route('patients.histories.create', $patient->id ) }}" method="POST" class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-8">
            @csrf
            @method('PUT')

            <!-- NAME -->
            <div>
              <label for="name" class="block text-sm font-medium text-gray-900">Name</label>
              <input id="name" type="text" name="name" required
                     value="{{ old('name', $patient->name) }}"
                     class="mt-2 block w-full rounded-md border border-gray-300 bg-white px-3 py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm" />
            </div>

            <!-- EMAIL -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
              <input id="email" type="email" name="email" required
                     value="{{ old('email', $patient->email) }}"
                     class="mt-2 block w-full rounded-md border border-gray-300 bg-white px-3 py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm" />
            </div>

            <!-- GENDER -->
            <div>
              <label for="gender" class="block text-sm font-medium text-gray-900">Gender</label>
              <div class="mt-2 grid grid-cols-1">
                <select id="gender" name="gender"
                        class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm">
                  <option value="male" {{ old('gender', $patient->gender) === 'male' ? 'selected' : '' }}>Male</option>
                  <option value="female" {{ old('gender', $patient->gender) === 'female' ? 'selected' : '' }}>Female</option>
                  <option value="other" {{ old('gender', $patient->gender) === 'other' ? 'selected' : '' }}>Other</option>
                </select>
              </div>
            </div>

            <!-- AGE -->
            <div>
              <label for="age" class="block text-sm font-medium text-gray-900">Age</label>
              <div class="mt-2">
                <input id="age" type="number" name="age" required
                       value="{{ old('age', $patient->age) }}"
                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm" />
              </div>
            </div>

            <!-- SUBMIT -->
             <div></div>
            <div class="col-span-1">
              <button type="submit"
                      class="w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-600">
                Update patient
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-layouts.dashboard>
