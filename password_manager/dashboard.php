<?php
require_once "config.php";
require_once "check_session.php";

// Check login status
checkLogin();

// Fetch user's stored passwords
$sql = "SELECT entry_id, website, username, password FROM passwordtbl WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $_SESSION["user_id"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Password Manager</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .password-field {
            filter: blur(4px);
            transition: filter 0.2s ease;
        }
        .password-field:hover {
            filter: blur(0);
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal.show {
            display: block;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation Bar -->
<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <h1 class="text-xl font-bold">Password Manager</h1>
            </div>
            <div class="flex items-center space-x-4">
                <a href="help.php" class="text-blue-600 hover:text-blue-800">
                    Help
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
            <!-- Add New Password Button -->
            <div class="mb-6">
                <button onclick="showModal('passwordModal')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Add New Password
                </button>
            </div>

            <!-- Passwords Table -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Website</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Password</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="px-6 py-4"><?php echo htmlspecialchars($row['website']); ?></td>
                                <td class="px-6 py-4"><?php echo htmlspecialchars($row['username']); ?></td>
                                <td class="px-6 py-4">
                                    <span class="password-field"><?php echo htmlspecialchars($row['password']); ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <button onclick="editPassword(<?php echo $row['entry_id']; ?>)" 
                                            class="text-blue-600 hover:text-blue-900 mr-2">Edit</button>
                                    <button onclick="deletePassword(<?php echo $row['entry_id']; ?>)" 
                                            class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Password Modal -->
    <div id="passwordModal" class="modal">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h2 id="modalTitle" class="text-xl font-bold mb-4">Add New Password</h2>
            <form id="passwordForm" class="space-y-4">
                <input type="hidden" id="entry_id" name="entry_id">
                
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                    <input type="text" id="website" name="website" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

               <div>
    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
    <div class="relative">
        <input type="password" id="password" name="password" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        <button type="button" id="togglePasswordVisibility" 
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </button>
    </div>
</div>

                <div id="masterPasswordSection" class="hidden">
                    <label for="master_password" class="block text-sm font-medium text-gray-700">Master Password</label>
                    <input type="password" id="master_password" name="master_password"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <p class="mt-1 text-sm text-gray-500">Required to update existing password</p>
                </div>

                <div id="errorMessage" class="text-red-600 hidden"></div>

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="hideModal('passwordModal')"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h2 class="text-xl font-bold mb-4">Delete Password</h2>
            <form id="deleteForm" class="space-y-4">
                <input type="hidden" id="deleteEntryId" name="entry_id">
                
                <p class="text-gray-600 mb-4">Are you sure you want to delete this password?</p>
                
                <div>
                    <label for="masterPassword" class="block text-sm font-medium text-gray-700">Master Password</label>
                    <input type="password" id="masterPassword" name="master_password" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <div id="deleteError" class="text-red-600 hidden"></div>

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="hideModal('deleteModal')"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentEntryId = null;

        // Initialize event listeners once DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            initializeFormHandlers();
        });

        function initializeFormHandlers() {
            // Password form submission
            const passwordForm = document.getElementById('passwordForm');
            if (passwordForm) {
                passwordForm.addEventListener('submit', handlePasswordSubmission);
            }

            // Delete form submission
            const deleteForm = document.getElementById('deleteForm');
            if (deleteForm) {
                deleteForm.addEventListener('submit', handleDeleteSubmission);
            }
        }

        // Modal Functions
        function showModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('show');
                if (modalId === 'passwordModal') {
                    const isEdit = document.getElementById('entry_id').value !== '';
                    if (!isEdit) {
                        document.getElementById('passwordForm').reset();
                        document.getElementById('masterPasswordSection').classList.add('hidden');
                        document.getElementById('modalTitle').textContent = 'Add New Password';
                        document.getElementById('errorMessage').classList.add('hidden');
                    }
                }
            }
        }

        function hideModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('show');
                if (modalId === 'passwordModal') {
                    document.getElementById('passwordForm').reset();
                    document.getElementById('entry_id').value = '';
                    document.getElementById('errorMessage').classList.add('hidden');
                }
            }
        }
	// Add this near the top of your script section
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the toggle password visibility button
    const togglePasswordBtn = document.getElementById('togglePasswordVisibility');
    const passwordInput = document.getElementById('password');
    
    if (togglePasswordBtn && passwordInput) {
        togglePasswordBtn.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Update the icon based on password visibility
            const svg = this.querySelector('svg');
            if (type === 'password') {
                svg.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            } else {
                svg.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            }
        });
    }
});

        // Handle Password Form Submission
        async function handlePasswordSubmission(e) {
            e.preventDefault();
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton.disabled) return;

            const originalButtonText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Saving...';

            try {
                const formData = new FormData(this);
                const response = await fetch('save_password.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();
                if (data.success) {
                    hideModal('passwordModal');
                    location.reload();
                } else {
                    const errorMessage = document.getElementById('errorMessage');
                    errorMessage.textContent = data.message || 'An error occurred';
                    errorMessage.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Error:', error);
                const errorMessage = document.getElementById('errorMessage');
                errorMessage.textContent = 'An error occurred while saving';
                errorMessage.classList.remove('hidden');
            } finally {
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
            }
        }

        // Handle Delete Form Submission
        async function handleDeleteSubmission(e) {
            e.preventDefault();
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton.disabled) return;

            submitButton.disabled = true;
            const originalButtonText = submitButton.textContent;
            submitButton.textContent = 'Deleting...';

            try {
                const formData = new FormData(this);
                const response = await fetch('delete_password.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();
                if (data.success) {
                    hideModal('deleteModal');
                    location.reload();
                } else {
                    const errorDiv = document.getElementById('deleteError');
                    errorDiv.textContent = data.message || 'An error occurred while deleting';
                    errorDiv.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Error:', error);
                const errorDiv = document.getElementById('deleteError');
                errorDiv.textContent = 'An error occurred while deleting';
                errorDiv.classList.remove('hidden');
            } finally {
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
            }
        }

        // Edit Password
        async function editPassword(entryId) {
            try {
                const response = await fetch(`get_password.php?id=${entryId}`);
                const data = await response.json();
                
                if (data.success) {
                    document.getElementById('modalTitle').textContent = 'Edit Password';
                    document.getElementById('entry_id').value = entryId;
                    document.getElementById('website').value = data.website;
                    document.getElementById('username').value = data.username;
                    document.getElementById('password').value = data.password;
                    
                    document.getElementById('masterPasswordSection').classList.remove('hidden');
                    showModal('passwordModal');
                } else {
                    alert(data.message || 'Error loading password details');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error loading password details');
            }
        }

        // Delete Password
        function deletePassword(entryId) {
            currentEntryId = entryId;
            document.getElementById('deleteEntryId').value = entryId;
            document.getElementById('masterPassword').value = '';
            document.getElementById('deleteError').classList.add('hidden');
            showModal('deleteModal');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('show');
            }
        }
    </script>
</body>
</html>