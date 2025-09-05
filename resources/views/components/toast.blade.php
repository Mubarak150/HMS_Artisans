@if(session('success') || session('error'))
<div id="toast"
     class="pointer-events-auto fixed top-5 right-5 w-full max-w-sm rounded-lg bg-white shadow-lg ring-1 ring-black/5 p-4 transition transform"
>
  <div class="flex items-start">
    <div class="shrink-0">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
           class="w-6 h-6 {{ session('success') ? 'text-green-400' : 'text-red-400' }}">
        <path d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
              stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </div>
    <div class="ml-3 flex-1">
      <p class="text-sm font-medium text-gray-900">
        {{ session('success') ? 'Success' : 'Error' }}
      </p>
      <p class="mt-1 text-sm text-gray-500">
        {{ session('success') ?? session('error') }}
      </p>
    </div>
    <button onclick="hideToast()" class="ml-4 text-gray-400 hover:text-gray-600">
        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
        </svg>
    </button>
  </div>
</div>

<script>
  function hideToast() {
    let toast = document.getElementById('toast');
    if (toast) {
      toast.style.opacity = '0';
      toast.style.transition = 'opacity 0.5s ease';
      setTimeout(() => toast.remove(), 500); // remove after fade
    }
  }

  // auto-hide after 3s
  setTimeout(hideToast, 3000);
</script>
@endif
