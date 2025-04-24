<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <meta name="csrf-token" content="{{ csrf_token() }}">  <!--  cross site request forgery token -->
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: var(--bg-color, #f0f2f5);
      color: var(--text-color, #333);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .profile-container {
      background: rgba(255, 255, 255, 0.2);
      padding: 2rem;
      border-radius: 12px;
      backdrop-filter: blur(10px);
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      text-align: center;
      margin-bottom: 1rem;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-top: 1rem;
    }

    input {
      padding: 0.5rem;
      margin-top: 0.25rem;
      border: 1px solid var(--input-border, #ccc);
      border-radius: 6px;
      background-color: var(--input-bg, white);
      color: inherit;
    }

    button.btn {
      margin-top: 1.5rem;
      padding: 0.75rem;
      background-color: var(--accent-color, #3498db);
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    button.btn:hover {
      background-color: #1c6dad;
    }

    .error {
      color: red;
      font-size: 0.85rem;
    }

    .status-msg {
      margin-top: 1rem;
      color: green;
      text-align: center;
    }
  </style>
</head>
<body>
    
 {{-- Dropdown Menu Button --}}
 <div class="absolute top-4 right-4 z-50">
        <button id="menu-toggle"
            class="w-10 h-10 p-2 rounded-full bg-white dark:bg-gray-800 shadow-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            <svg class="w-6 h-6 text-gray-800 dark:text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div id="menu-dropdown"
            class="hidden absolute right-0 mt-2 w-44 bg-white dark:bg-gray-800 rounded-xl shadow-lg z-50 opacity-0 pointer-events-none transition-all duration-300">
            <a href="{{route('profile.edit')}}"
                class="block px-4 py-2 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Profile</a>
            <a href="{{ route('home') }}"
                class="block px-4 py-2 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Home</a>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-2 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </div>

  <div class="profile-container">
    <h2>Aggiorna il profilo</h2>

    <form id="profile-form">
      <label for="name">Nome:</label>
      <input type="text" id="name" name="name" required />

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required />
      <small id="email-error" class="error"></small>

      <button type="submit" class="btn">Salva</button>
    </form>

    <div id="status" class="status-msg"></div>
  </div>

  <script>
    // Pre-fill form (simulate pulling from localStorage or backend)
    document.getElementById('name').value = localStorage.getItem('userName') || "";
    document.getElementById('email').value = localStorage.getItem('userEmail') || "";

    document.getElementById("profile-form").addEventListener("submit", function (e) {
      e.preventDefault();
      const name = document.getElementById("name").value.trim();
      const email = document.getElementById("email").value.trim();
      const emailError = document.getElementById("email-error");
      const status = document.getElementById("status");

      emailError.textContent = "";
      status.textContent = "";

      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Check email uniqueness
      fetch("{{ route('profile.checkEmail') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ email: email })
      })
      .then(response => response.json())
      .then(data => {
        console.log('Email Check Response:', data);
        if (data.exists) {
          emailError.textContent = "This email is already in use.";
          return;
        }

        // Save profile
        fetch("{{ route('profile.saveProfile') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({ name: name, email: email })
        })
        .then(response => response.json())
        .then(data => {
          console.log('Save Profile Response:', data);
          if (data.success) {
            localStorage.setItem('userName', name);
            localStorage.setItem('userEmail', email);
            status.textContent = "Profile updated successfully!";
          } else {
            status.textContent = "Failed to update profile.";
          }
        })
        .catch(error => {
          console.error('Error saving profile:', error);
          status.textContent = "An error occurred while updating the profile.";
        });
      })
      .catch(error => {
        console.error('Error checking email:', error);
        emailError.textContent = "An error occurred while checking the email.";
      });
    });



     // Burger menu functionality
     document.getElementById('menu-toggle').addEventListener('click', function () {
            const menu = document.getElementById('menu-dropdown');
            const isVisible = !menu.classList.contains('hidden');

            menu.classList.toggle('hidden');

            // Toggle the transition for visibility
            menu.style.opacity = isVisible ? '0' : '1';
            menu.style.pointerEvents = isVisible ? 'none' : 'auto';
        });

        // Close menu when clicking outside
        document.addEventListener('click', function (event) {
            const menu = document.getElementById('menu-dropdown');
            const button = document.getElementById('menu-toggle');

            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
                menu.style.opacity = '0';
                menu.style.pointerEvents = 'none';
            }
        });
  </script>
</body>
</html>
