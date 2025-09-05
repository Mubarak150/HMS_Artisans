
<x-layouts.default>
<div class="flex min-h-full">
  <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
    <div class="mx-auto w-full max-w-sm lg:w-96">
      <div>
        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" class="h-10 w-auto" />
        <h2 class="mt-8 text-2xl/9 font-bold tracking-tight text-gray-900">Reset Your Password</h2>
        </p>
      </div>

      
      <div class="mt-10">

        <!-- FORM  STARTS -->
        <div>
          <form action="{{ route('sendmail') }}" method="POST" class="space-y-6">

            @csrf
            <!-- EMAIL -->
            <div>
              <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
              <div class="mt-2">
                <input id="email" type="email" name="email" required autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
              </div>
            </div>

            <div>
              <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send me email</button>
            </div>
          </form>
        </div>
        <!-- FORM ENDS -->

      </div>
    </div>
  </div>
  <div class="relative hidden w-0 flex-1 lg:block">
    <img src="https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80" alt="" class="absolute inset-0 size-full object-cover" />
  </div>
</div>
</x-layouts.default>