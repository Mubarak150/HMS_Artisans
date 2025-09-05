<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="h-full lg:grid lg:grid-cols-[20%_80%]" >
    <sidebar class="hidden lg:flex lg:w-full lg:flex-col lg:border-r lg:border-gray-200 lg:bg-gray-50 lg:pt-">
        <!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
        <div class="relative flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
        <div class="relative flex h-16 shrink-0 items-center">
            <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" class="h-8 w-auto" />
        </div>
        <nav class="relative flex flex-1 flex-col">
            <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                <li>
                    <!-- Current: "bg-gray-50", Default: "hover:bg-gray-50" -->
                    <a href="{{ route('dashboard') }}" class="group flex gap-x-3 rounded-md  p-2 text-sm/6 font-semibold  
                    @if(request()->routeIs('dashboard')) bg-blue-100   @else hover:bg-gray-5 @endif
                    ">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 shrink-0 text-gray-400">
                        <path d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Dashboard
                    </a>
                </li>
                
                
                
               {{-- <li>
                    <a href="reports" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-700 
                    @if(request()->routeIs('reports')) bg-blue-100   @else hover:bg-gray-5 @endif
                    ">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 shrink-0 text-gray-400">
                        <path d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Reports
                    </a>
                </li> --}} 
                </ul>
            </li> 
            @hasanyrole('doctor|admin')
            <li>
                    <button type="button" id="toggle" command="--toggle" commandfor="sub-menu-1" class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm/6 font-semibold text-gray-700 
                    @if(request()->routeIs('doctors.*') || request()->routeIs('patients.*')) bg-blue-100   @else hover:bg-gray-5 @endif
                    "
                    aria-expanded="{{ request()->routeIs('doctors.*') || request()->routeIs('patients.*') ? 'true' : 'false' }}"
                    >
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 shrink-0 text-gray-400">
                        <path d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    People
                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="ml-auto size-5 shrink-0 not-in-aria-expanded:text-gray-400 in-aria-expanded:rotate-90 in-aria-expanded:text-gray-500">
                        <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                    </button>
                    <el-disclosure id="sub-menu-1" 
                    {{-- showing it route based --}}
                    {{ request()->routeIs('doctors.*') || request()->routeIs('patients.*') ? '' : 'hidden' }} 
                    class="contents">
                    <ul class="mt-1 px-2">
                        <li>
                        <!-- admin only -->
                        @role('admin')
                            <a href="{{ route('doctors.index') }}" class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50
                            @if(request()->routeIs('doctors.*')) bg-blue-100   @else hover:bg-gray-5 @endif
                            ">Doctor</a>
                        @endrole
                        </li>
                        <li>
                        <!-- show to both doctor and admin -->
                        
                            <a href="{{ route('patients.index') }}" class="block rounded-md py-2 pr-2 pl-9 text-sm/6 text-gray-700 hover:bg-gray-50
                            @if(request()->routeIs('patients.*')) bg-blue-100   @else hover:bg-gray-5 @endif
                            ">Patient</a>
                        
                        </li>
                        <li>
                    </ul>
                    </el-disclosure>
                </li>
                @endhasanyrole

                <script>
                    document.getElementById('toggle').addEventListener('click', function() {
                        const disclosure = document.getElementById('sub-menu-1');
                        const isHidden = disclosure.hasAttribute('hidden');
                        if (isHidden) {
                            disclosure.removeAttribute('hidden');
                            this.setAttribute('aria-expanded', 'true');
                        } else {
                            disclosure.setAttribute('hidden', '');
                            this.setAttribute('aria-expanded', 'false');
                        }
                    });
                </script>
                
            <li class="-mx-6 mt-auto">
                
                <a href="" class="flex items-center gap-x-4 px-6 py-3 text-sm/6 font-semibold text-gray-900 hover:bg-gray-50">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="size-8 rounded-full bg-gray-50 outline -outline-offset-1 outline-black/5" />
                <span class="sr-only">Your profile</span>
                <span aria-hidden="true">{{Auth::user()->name}}</span>
                <form action="{{ route('logout') }}" class="ml-auto" method="get">
                    <button type="submit" class="bg-gray-200 p-2 py-1 rounded-md">logout</button>
                </form>
                </a>
            </li>
            </ul>
        </nav>
        </div>

    </sidebar>
    <main class="h-full w-full overflow-y-auto">
        {{ $slot }}

        {{-- ✅ Toast Notifications --}}
        <!-- {{-- ✅ Global Toast Component --}} -->
        <x-toast />
    </main>
</body>
</html>



