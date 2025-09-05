<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="h-full">
    <main class="h-full">
        {{ $slot }}

        {{-- ✅ Toast Notifications --}}
        <!-- {{-- ✅ Global Toast Component --}} -->
        <x-toast />
        <!-- <x-toast :show="session('success')" title="Success" message="{{ session('success') }}" />
        <x-toast :show="session('error')" title="Error" message="{{ session('error') }}" /> -->
    </main>
</body>
</html>