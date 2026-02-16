<!DOCTYPE html>
<html>
<head>
    <title>Create Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded shadow w-96">

    <h2 class="text-2xl font-bold mb-6 text-center">Create New Admin</h2>

    @if(session('success'))
        <p class="text-green-500 mb-4">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('admin.store') }}">
        @csrf

        <input type="text" name="name" placeholder="Name"
            class="w-full mb-4 p-2 border rounded">

        <input type="email" name="email" placeholder="Email"
            class="w-full mb-4 p-2 border rounded">

        <input type="password" name="password" placeholder="Password"
            class="w-full mb-4 p-2 border rounded">

        <input type="password" name="password_confirmation"
            placeholder="Confirm Password"
            class="w-full mb-4 p-2 border rounded">

        <button class="w-full bg-green-600 text-white p-2 rounded">
            Create Admin
        </button>
    </form>

</div>

</body>
</html>
