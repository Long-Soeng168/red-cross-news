<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Expired</title>
    <script src="{{ asset('assets/js/tailwind34.js') }}"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="flex flex-col items-center p-8 bg-white rounded-lg shadow-lg">
        <img src="{{ asset('assets/icons/expired.png') }}" class="h-20 aspect-square" alt="">
        <h1 class="my-4 text-2xl font-bold text-red-600">
            Your account has expired.
        </h1>
        <p class="text-gray-700">
            Please contact admin for more information.
        </p>
    </div>
</body>
</html>
