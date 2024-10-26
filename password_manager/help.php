<?php
require_once "config.php";
require_once "check_session.php";
checkLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Documentation - Password Manager</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold">Password Manager</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="dashboard.php" class="text-blue-600 hover:text-blue-800">
                        Back to Dashboard
                    </a>
                    <span class="text-gray-600">
                        <?php echo htmlspecialchars($_SESSION["email"]); ?>
                    </span>
                    <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Help Documentation</h2>

            <!-- Getting Started Section -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">Getting Started</h3>
                <div class="pl-4">
                    <p class="mb-2">Welcome to the Password Manager! This application helps you securely store and manage your passwords.</p>
                </div>
            </div>

            <!-- Features Section -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">Features</h3>
                <div class="pl-4 space-y-2">
                    <p><span class="font-medium">Add New Password:</span> Click the "Add New Password" button to store a new password entry.</p>
                    <p><span class="font-medium">Edit Password:</span> Click the "Edit" button next to any entry to modify its details.</p>
                    <p><span class="font-medium">Delete Password:</span> Click the "Delete" button to remove a password entry.</p>
                    <p><span class="font-medium">Password Security:</span> Passwords are blurred by default and visible on hover for security.</p>
                </div>
            </div>

            <!-- Security Tips Section -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">Security Tips</h3>
                <div class="pl-4 space-y-2">
                    <p>• Create a strong master password that you haven't used elsewhere</p>
                    <p>• Use unique passwords for each website</p>
                    <p>• Include a mix of uppercase, lowercase, numbers, and special characters</p>
                    <p>• Regularly update your passwords</p>
                    <p>• Never share your master password with anyone</p>
                </div>
            </div>

            <!-- Usage Instructions Section -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">Usage Instructions</h3>
                <div class="pl-4">
                    <h4 class="font-medium mb-2">Adding a New Password</h4>
                    <ol class="list-decimal pl-5 mb-4 space-y-1">
                        <li>Click the "Add New Password" button</li>
                        <li>Enter the website name</li>
                        <li>Enter your username for that website</li>
                        <li>Enter your password</li>
                        <li>Click Save to store the entry</li>
                    </ol>

                    <h4 class="font-medium mb-2">Editing a Password</h4>
                    <ol class="list-decimal pl-5 mb-4 space-y-1">
                        <li>Click the "Edit" button next to the password entry</li>
                        <li>Modify the desired fields</li>
                        <li>Enter your master password to confirm changes</li>
                        <li>Click Save to update the entry</li>
                    </ol>

                    <h4 class="font-medium mb-2">Deleting a Password</h4>
                    <ol class="list-decimal pl-5 mb-4 space-y-1">
                        <li>Click the "Delete" button next to the password entry</li>
                        <li>Enter your master password to confirm deletion</li>
                        <li>Click Delete to remove the entry</li>
                    </ol>
                </div>
            </div>

            <!-- Troubleshooting Section -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">Troubleshooting</h3>
                <div class="pl-4 space-y-2">
                    <p><span class="font-medium">Account Locked:</span> After 3 failed login attempts, your account will be locked for 30 minutes.</p>
                    <p><span class="font-medium">Master Password Required:</span> You'll need your master password for any changes to existing entries.</p>
                    <p><span class="font-medium">Session Timeout:</span> For security, you'll be logged out after 30 minutes of inactivity.</p>
                </div>
            </div>

            <!-- Contact Support Section -->
            <div>
                <h3 class="text-xl font-semibold mb-3">Contact Support</h3>
                <div class="pl-4">
                    <p>If you need additional assistance, please contact support at:</p>
                    <p class="mt-2">Email: <a href="mailto:support@example.com" class="text-blue-600 hover:text-blue-800">support@example.com</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>