<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>User Manual</title>
    <link rel="icon" href="{{ asset('drcare_logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/alpine.js'])

    @endif
</head>


<style>
    html,
    body,
    main {
        scroll-behavior: smooth;
    }
</style>

<body class="font-figtree" x-data="{ openMenu: false }">

    <div class="flex h-screen">

        <!-- Mobile Top Bar -->
        <div class="md:hidden flex items-center justify-between bg-gray-50 shadow px-4 py-3 fixed top-0 w-full z-50">
            <h2 class="font-900 text-[#FF000D] ">Dr. Care</h2>
            <button @click="openMenu = true">
                <!-- Hamburger Icon -->
                <svg class="w-7 h-7 text-gray-800" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Sidebar -->
        <aside
            class="w-64 bg-red-600 shadow fixed inset-y-0 left-0 z-50 transform transition-transform duration-200 md:translate-x-0 px-4"
            :class="openMenu ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

            <div class="p-4 border-b flex justify-between items-center md:block">
                <h2 class="text-xl font-bold text-gray-50">User Manual</h2>

                <!-- Close Button (Mobile Only) -->
                <button @click="openMenu = false" class="md:hidden">
                    <svg class="w-6 h-6 text-gray-50" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <nav class="p-4 space-y-2" x-data="{ openAccounts: true }">
                <a href="#introduction" class="block text-left w-full text-gray-50 ">Menu</a>
                <!-- Dropdown for Accounts -->
                <div class="space-y-2">
                    <button @click="openAccounts = !openAccounts" class="flex items-center justify-between w-full text-left text-gray-50">
                        User Accounts
                        <i data-lucide="chevron-down" class="w-4 h-4" :class="openAccounts ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="openAccounts" x-transition class="pl-4 space-y-1">
                        <a href="#account-manage"
                            class="block text-gray-200 text-md hover:underline">
                            Manage
                        </a>

                        <a href="#account-recover"
                            class="block text-gray-200 text-md hover:underline">
                            Recover
                        </a>

                        <a href="#account-create"
                            class="block text-gray-200 text-md hover:underline">
                            Create Account
                        </a>

                        <a href="#account-view-update"
                            class="block text-gray-200 text-md hover:underline">
                            View and Update
                        </a>

                        <a href="#account-logs"
                            class="block text-gray-200 text-md hover:underline">
                            Logs
                        </a>
                    </div>

                </div>
                <div class="space-y-2" x-data="{ openPatients: true }">
                    <button @click="openPatients = !openPatients" class="flex items-center justify-between w-full text-left text-gray-50">
                        Patient Management
                        <i data-lucide="chevron-down" class="w-4 h-4" :class="openPatients ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="openPatients" x-transition class="pl-4 space-y-1">
                        <a href="#patient-view"
                            class="block text-gray-200 text-md hover:underline">
                            View
                        </a>

                        <a href="#patient-register"
                            class="block text-gray-200 text-md hover:underline">
                            Register
                        </a>

                        <a href="#patient-transactions"
                            class="block text-gray-200 text-md hover:underline">
                            Transaction
                        </a>
                    </div>

                </div>
                <div class="space-y-2" x-data="{ openMessaging: true }">
                    <button @click="openMessaging = !openMessaging" class="flex items-center justify-between w-full text-left text-gray-50">
                        Messaging
                        <i data-lucide="chevron-down" class="w-4 h-4" :class="openMessaging ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="openMessaging" x-transition class="pl-4 space-y-1">
                        <a href="#send-single"
                            class="block text-gray-200 text-md hover:underline">
                            Single
                        </a>

                        <a href="#send-bulk"
                            class="block text-gray-200 text-md hover:underline">
                            Bulk
                        </a>

                        <a href="#send-custom"
                            class="block text-gray-200 text-md hover:underline">
                            Custom
                        </a>
                    </div>

                </div>

                <a href="#services" class="block text-left w-full text-gray-50 ">Services</a>
                <a href="#inventory" class="block text-left w-full text-gray-50 ">Inventory</a>
                <a href="#appointments" class="block text-left w-full text-gray-50 ">Appointments</a>
            </nav>
        </aside>

        <!-- Dark overlay when sidebar open on mobile -->
        <div
            class="fixed inset-0 bg-black bg-opacity-40 z-40 md:hidden"
            x-show="openMenu"
            @click="openMenu = false"
            x-transition.opacity>
        </div>

        <!-- Content -->
        <main class="md:ml-64 w-full overflow-y-auto pt-24 md:pt-6 px-4 md:px-6 z-0">

            <!-- Intro -->
            <section id="introduction">
                <div class="flex flex-col">
                    <div class="flex flex-row items-center gap-5 py-6 md:py-8 md:px-14 px-4">
                        <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="md:w-16 md:h-16 w-14 h-14">
                        <div>
                            <h1 class="text-lg md:text-3xl font-900">User Manual</h1>
                        </div>
                    </div>

                    <!-- Header content -->
                    <div class="flex flex-col gap-4 md:px-20 px-4 pb-6">
                        <h2 class="text-sm md:text-lg font-semibold">
                            Welcome to the <span class="font-900 text-[#FF000D]">IBiteCare+</span> System User Manual
                        </h2>

                        <p class="text-xs md:text-base leading-relaxed">
                            This manual provides step-by-step instructions to help users navigate and use the IBiteCare+ system effectively.
                            It serves as a guide for clinic staff and administrators to ensure accurate record keeping, smooth workflow,
                            and proper use of system features.
                        </p>

                        <p class="text-xs md:text-base leading-relaxed">
                            Inside this guide, you will learn how to:
                        </p>

                        <ul class="text-xs md:text-base list-disc ml-6 leading-relaxed">
                            <li>Register a new patient</li>
                            <li>Create and manage user accounts</li>
                            <li>Record clinic transactions and patient services</li>
                            <li>Manage immunization records and vaccine inventory</li>
                            <li>Use reporting and data review features</li>
                            <li>And much more…</li>
                        </ul>

                        <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-md">
                            <p class="text-xs md:text-base font-bold ">
                                Important Reminder
                            </p>
                            <p class="text-[10px] md:text-sm mt-2  leading-relaxed">
                                For your protection, please change your default password after your first login.
                                Ensure the email you provide is valid and active — this will help you recover your account if needed.
                            </p>
                            <p class="text-[10px] md:text-sm mt-2  leading-relaxed">
                                The system can handle services that require immunizations, vaccinations, or injections.
                                Please ensure to select the appropriate service during patient registration. <span class="font-semibold italic">Non-immunization services are not supported in this version of the system.</span>

                            </p>
                            <p class="text-[10px] md:text-sm mt-2 leading-relaxed">
                                When adding new services, please ensure that the corresponding vaccines are also added in the <b>Inventory</b> section.
                                This helps prevent issues during patient registration and transaction processing.
                            </p>

                        </div>

                    </div>
                </div>
            </section>


            <!-- accounts -->
            <section id="user-accounts">
                <div class="flex flex-col">

                    <!-- Header -->
                    <div class="flex flex-row items-center gap-5 py-6 md:py-8 md:px-14 px-4">
                        <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-12 h-12">
                        <div>
                            <h1 class="text-lg md:text-2xl font-900">User Accounts</h1>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col gap-4 md:px-20 px-4 pb-6">
                        <h2 class="text-lg font-900">
                            Creating and Managing User Accounts
                        </h2>

                        <p class="text-xs md:text-base leading-relaxed">
                            User accounts are essential for accessing the IBiteCare+ system.
                            Each user should have a unique account with appropriate permissions based on their role.
                        </p>

                        <!-- managing account  -->
                        <div class="flex flex-col mt-10" id="account-manage">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">Managing Personal Accounts</h2>
                            <p>
                                To manage your personal account, navigate and click the <b class="text-blue-600">'Account Settings'</b> section located at the bottom of the sidebar.
                            </p>
                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/accounts/A1.png') }}" alt="Step 1" class="w-64 h-20 object-contain">
                            </div>
                            <p>
                                After clicking, you can see the Account Information, including your email, password, and other personal details.
                                You can edit your information as needed by clicking the <b class="text-blue-600">'More Details'</b> button.
                            </p>
                            <div class="flex flex-col md:flex-row items-center justify-center my-3">
                                <img src="{{ asset('manual-img/accounts/A2.png') }}" alt="Step 2" class="w-96 h-64 object-contain">
                                <img src="{{ asset('manual-img/accounts/A3.png') }}" alt="Step 3" class="w-full max-w-lg">
                            </div>
                            <p>
                                At the bottom of the Account Information page, you can find the <b class="text-blue-600">'User Manual'</b> link that will redirect you to this user manual page.
                            </p>
                            <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-md mt-3">
                                <p class="text-xs md:text-base font-bold ">
                                    Important Reminder
                                </p>
                                <p class="text-[10px] md:text-sm mt-2  leading-relaxed">
                                    For your protection, please change your default password after your first login.
                                    Ensure the email you provide is valid and active — this will help you recover your account if needed.
                                </p>
                            </div>
                        </div>

                        <!-- recover account  -->
                        <div class="flex flex-col mt-10" id="account-recover">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">Recovering Accounts</h2>
                            <p>
                                To recover a user account, in the login page, click the <b class="text-blue-600">'Forgot Password?'</b> link located below the login form.
                            </p>
                            <p class="mt-5">
                                After clicking, you can see the account verification page.
                                Enter your <b class="text-blue-600">'Account ID'</b> to proceed with the account recovery process. <br>
                                An email verification code will be sent to the email address associated with your account.
                            </p>
                            <div class="flex flex-col md:flex-row items-center justify-center p-4">
                                <img src="{{ asset('manual-img/accounts/A9.png') }}" alt="Step 9" class="w-full max-w-xs">
                            </div>
                            <p class="mt-2 ">
                                Check your email for the verification code, enter it in the provided field, and click the <b class="text-blue-600">'Verify Code'</b> button.
                                Once verified, you will be prompted to create a new password for your account. <br> <br>
                            </p>
                            <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-md mt-2">
                                <p class="text-xs md:text-base font-bold ">
                                    Important Reminder
                                </p>
                                <p class="text-[10px] md:text-sm mt-2  leading-relaxed">
                                    Please ensure your new password to have at least 8 characters, including uppercase and lowercase letters, numbers, and special characters for better security.
                                </p>
                            </div>
                            <p class="mt-2">
                                After updating your password, you can now log in to your account using your Account ID and the new password you just created.
                            </p>
                        </div>

                        <!-- create account  -->
                        <div class="flex flex-col mt-10" id="account-create">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">Creating Accounts (For Admin Only)</h2>
                            <p>
                                To create a new user account, navigate to the <b class="text-blue-600">'Accounts'</b> section in the sidebar.
                            </p>
                            <p>
                                After clicking, you can see the list of existing user accounts.
                                You can create a new account by clicking the <b class="text-blue-600">'Create New Account'</b> button.
                            </p>
                            <p class="mt-2">
                                Fill in the required information, such as name, email, role, and do not forget to generate the account's ID and default password.
                                Once completed, click the <b class="text-blue-600">'Create Account'</b> button to save the new user account.
                            </p>
                            <div class="flex flex-col md:flex-row items-center justify-center p-4">
                                <img src="{{ asset('manual-img/accounts/A6.png') }}" alt="Step 6" class="w-full max-w-lg">
                                <img src="{{ asset('manual-img/accounts/A7.png') }}" alt="Step 7" class="w-full max-w-lg">
                            </div>
                            <p>After successful account creation the account ID and default password are emailed in the email account provided during registration.</p>


                        </div>
                        <!-- view and update user account  -->
                        <div class="flex flex-col mt-10" id="account-view-update">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">View and Update Accounts (For Admin Only)</h2>
                            <p>
                                To view and update user accounts, navigate to the <b class="text-blue-600">'Accounts'</b> section in the sidebar.
                            </p>
                            <p>
                                After clicking, you can see the list of existing user accounts.
                                You can view or update a specific account by clicking whether the <b class="text-blue-600">'View'</b> or <b class="text-blue-600">'Update'</b> icon in the table.
                            </p>
                            <div class="flex flex-col md:flex-row items-center justify-center p-4">
                                <img src="{{ asset('manual-img/accounts/A8.png') }}" alt="Step 8" class="w-64 h-32 object-contain">
                            </div>
                            <p class="mt-2">
                                In the View Account modal, you can see the account's details, including name, email, role, and status.
                                In the Update Account modal, you can modify the account's information as needed.
                                Once completed, click the <b class="text-blue-600">'Save Changes'</b> button to save the changes.

                            <div class="bg-red-100 border-l-4 border-red-500 p-4 rounded-md mt-2">
                                <p class="text-xs md:text-base font-bold ">
                                    Important Reminder
                                </p>
                                <p class="text-[10px] md:text-sm mt-2  leading-relaxed">
                                    You can also disable or enable user accounts by clicking the <b class="text-blue-600">'Disable'</b> or <b class="text-blue-600">'Enable'</b> button in the Update Account modal.
                                    Disabled accounts will not be able to log in to the system. <b class="text-red-500">Please use this feature with caution.</b>
                                </p>
                            </div>
                        </div>

                        <!-- view logs -->
                        <div class="flex flex-col mt-10" id="account-logs">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">View Users Activity Logs (For Admin Only)</h2>
                            <p>
                                To view user activities, navigate to the <b class="text-blue-600">'Logs'</b> section in the sidebar.
                            </p>
                            <p>
                                After clicking, you can view a list of activities performed by users.
                            </p>
                            <div class="flex flex-col md:flex-row items-center justify-center p-4">
                                <img src="{{ asset('manual-img/accounts/A10.png') }}" alt="Step 10" class="w-full max-w-2xl ">
                            </div>
                            <p>
                                You can filter and search specific activities using the search bar and filter options provided. By clicking the table headers, you can sort the logs based on different criteria such as date, user, and activity type.
                            </p>

                        </div>
                    </div>

                </div>
            </section>

            <!-- patients -->
            <section id="patients" class="mt-20">
                <div class="flex flex-col">
                    <!-- Header -->
                    <div class="flex flex-row items-center gap-5 py-6 md:py-8 md:px-14 px-4">
                        <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-12 h-12">
                        <div>
                            <h1 class="text-lg md:text-2xl font-900">Patient Management</h1>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col gap-4 md:px-20 px-4 pb-6">
                        <p class="text-xs md:text-base leading-relaxed">
                            The Patient Management section allows clinic staff to efficiently handle patient records,
                            including registration, viewing, and managing patient information and transactions.
                        </p>

                        <!-- view patient records -->
                        <div class="flex flex-col mt-10" id="patient-view">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">View Patient Records</h2>
                            <p>
                                To view the patient records, navigate and click the <b class="text-blue-600">'Patient'</b> on the sidebar.
                            </p>
                            <p class="mt-3">
                                After clicking, you can see the patient records list with filter and search functionalities.<br>
                                You can view a specific patient record by clicking the <b class="text-blue-600">'View'</b> icon in the table
                                and you can manage patient transactions by clicking the <b class="text-blue-600">'Manage'</b> icon in the table.
                            </p>
                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/P1.png') }}" alt="Step 1" class="w-64 h-20 object-contain">
                            </div>
                            <p class="mt-3">
                                If you click the <b class="text-blue-600">'View'</b> icon, a section will appear showing the patient's information,
                                including personal details, immunization records, transaction history, schedules, vaccination cards, and payment history.
                                <br>
                                <br>
                                You can also edit the patient's information by clicking the <b class="text-blue-600">'Edit'</b> button.
                            </p>
                            <div class="flex flex-col items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/P2.png') }}" alt="Step 2" class="w-full max-w-2xl object-contain">
                            </div>
                            <p class="mt-3">
                                You can navigate through Immunization (Previous) and (Current) tabs to access specific information about the patient such as immunization records.
                                You can also see the patient's immunization details by clicking the <b class="text-blue-600">'View'</b> button in the Immunization (Current) tab.
                            </p>
                            <div class="flex flex-col  items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/P3.png') }}" alt="Step 3" class="w-full max-w-5xl object-contain">
                                <img src="{{ asset('manual-img/patients/P4.png') }}" alt="Step 3" class="w-full max-w-5xl object-contain">
                                <img src="{{ asset('manual-img/patients/P5.png') }}" alt="Step 3" class="w-full max-w-xs object-contain">

                            </div>
                            <p class="mt-3">
                                In Vaccination Card tab, it will show you the list of vaccination card if the patient has one or many. You can view and print the patient's vaccination card by clicking the <b class="text-blue-600">'Download'</b> button.
                            </p>
                            <div class="flex flex-col md:flex-row  items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/P6.png') }}" alt="Step 3" class="w-full max-w-xl object-contain">
                                <img src="{{ asset('manual-img/patients/P7.png') }}" alt="Step 3" class="w-full max-w-lg object-contain">
                            </div>
                            <div class="flex flex-col  items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/P8.png') }}" alt="Step 3" class="w-full max-w-lg object-contain">
                            </div>
                            <p class="mt-3">
                                In Schedule tab, it will show you the list of scheduled vaccinations for the patient.
                            </p>
                            <div class="flex flex-col  items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/P9.png') }}" alt="Step 3" class="w-full max-w-2xl object-contain">
                            </div>
                            <p class="mt-3">
                                In Transaction and Payments tab, it will show you the transaction and payment history.
                            </p>
                            <div class="flex flex-col  items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/P10.png') }}" alt="Step 3" class="w-full max-w-2xl object-contain">
                                <img src="{{ asset('manual-img/patients/P11.png') }}" alt="Step 3" class="w-full max-w-2xl object-contain">
                            </div>
                        </div>

                        <!-- register a patient -->
                        <div class="flex flex-col mt-10" id="patient-register">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">Register a Patient</h2>
                            <p class="mt-3">
                                To register a new patient, in the patient page click the <b class="text-blue-600">'Register Patient '</b> button.
                                When registering a new patient it is important to select the correct service that the patient will avail of.
                            </p>
                            <p class="mt-3">
                                After clicking the <b class="text-blue-600">'Register Patient'</b> button, a modal will appear when you can choose the service to be registered to the patient. (E.g., Post Exposure Prophylaxis, Tetanus Toxoid, Booster) <br>
                            </p>
                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/P13.png') }}" alt="Step 1" class="w-full max-w-2xl object-contain">
                            </div>
                            <p class="mt-3">
                                After selecting the service, it will redirect you to the patient registration form where you can fill in the patient's personal information and medical history.
                            </p>
                            <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-md mt-3">
                                <p class="text-xs md:text-base font-bold ">
                                    Important Reminder
                                </p>
                                <p class="text-[12px] md:text-sm mt-2  leading-relaxed">
                                    New added services will be reflected in the service selection during patient registration.
                                </p>
                                <p class="text-[12px] md:text-sm mt-2  leading-relaxed">
                                    The system can handle services that require immunizations, vaccinations, or injections.
                                    Please ensure to select the appropriate service during patient registration. <span class="font-semibold italic">Non-immunization services are not supported in this version of the system.</span>
                                </p>
                            </div>
                            <p class="mt-3">
                                Please note that the fields displayed on the form may vary depending on the selected service during registration.
                                Some services do not require sections such as <b>History of Exposure</b>, and <b>Animal Bite Information</b>.
                                Instead, each service includes specific fields based on its requirements. <br><br>
                                However, all services follow the same overall registration flow — including filling out the <b>Personal Information</b> section, confirming the assigned <b>Nurse/Staff</b>, and completing the <b>payment process</b>.
                            </p>
                            <p class="mt-3">
                                Below is an example of the patient registration form for the <b>Post-Exposure Prophylaxis (PEP)</b> service.
                                Please ensure that all required information is filled out accurately before submitting the form.
                                <br><br>
                                The <b>Date of Registration</b> field are automatically set to the current system date and time.
                                <br><br>
                                Providing an <b class="text-blue-600">email address</b> is optional but highly recommended — especially if the patient wishes to receive notifications and updates regarding their appointments and immunization schedules, or if they plan to access the system through the patient portal.
                            </p>

                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/PSTEP1.png') }}" alt="Step 1" class="w-full max-w-4xl object-contain">
                            </div>
                            <p class="mt-3">
                                After filling out the personal details, click the <b class="text-blue-600">'Next'</b> button to proceed to the next section.
                                <br>
                                <br>
                                In the <b>History of Exposure</b> section, provide details about the exposure incident, including the type of exposure, date and time, and any relevant notes.
                                The system provides <b>Body Part illustrations</b> to help identify the exposure site. It can be accessed by clicking the <b class="text-blue-600">'View Body Parts'</b>.
                                it can be single or multiple sites.
                                <br>
                                <br>
                                Please take note that the <b>History of Exposure</b> and <b>Animal Profile</b> sections are specific to services like Post-Exposure Prophylaxis (PEP) and may not be applicable to all services.
                            </p>
                            <p class="mt-3">
                                Below is an example of the <b>Body Part illustrations</b> and <b>Animal Profile</b> fields that can be accessed during patient registration and transaction
                            </p>
                            <div class="flex flex-col items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/PSTEP2.png') }}" alt="Step 2" class="w-full max-w-2xl object-contain">
                                <img src="{{ asset('manual-img/patients/PSTEP3.png') }}" alt="Step 3" class="w-full max-w-2xl object-contain">
                            </div>
                            <p class="mt-3">
                                After filling out all the required information, click the <b class="text-blue-600">'Next'</b> button to proceed to the Immunization Schedule section. <br> <br>
                                Below is an example of Immunization Section, it includes the list of vaccines to be administered based on the selected service.
                                For Post-Exposure Prophylaxis (PEP), in required vaccines such as Rabies Vaccine, Tetanus Toxoid, Rabies Immune Globulin (RIG) will be listed.
                            </p>
                            <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-md mt-3">
                                <p class="text-xs md:text-base font-bold ">
                                    Important Reminder
                                </p>
                                <p class="text-[10px] md:text-sm mt-2  leading-relaxed">
                                    Body Part illustrations are provided to help identify the exposure site. It is applicable for services that require exposure details, such as Post-Exposure Prophylaxis (PEP). Other
                                    services may not include this feature.
                                </p>
                                <p class="text-[10px] md:text-sm mt-2  leading-relaxed">
                                    Please take note that the vaccines listed are based on the selected service during registration.
                                    Some services may have different vaccine requirements.
                                </p>
                                <p class="text-[10px] md:text-sm mt-2  leading-relaxed">
                                    Some fields can be optional based on the service requirements. Please ensure to fill out all mandatory fields before proceeding.
                                    Like the Previous Anti Rabies Immunization field in the Immunization section.
                                </p>
                                <p class="text-[10px] md:text-sm mt-2  leading-relaxed">
                                    You can also choose the vaccine and it's remaining volume from the dropdown list in the Immunization section.
                                    The dropdown list will show the available vaccines in the inventory along with their remaining volume.
                                </p>
                            </div>
                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/PSTEP4.png') }}" alt="Step 1" class="w-full max-w-4xl object-contain">
                            </div>
                            <p class="mt-3">
                                <b>Nurse Verification:</b> Nurse assigned to the patient during registration should verify the immunization and administration of the vaccines to move to the payment section.
                                It requires the nurse's password for verification.
                            </p>
                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/PSTEP5.png') }}" alt="Step 1" class="w-full max-w-md object-contain">
                            </div>
                            <p class="mt-3">
                                After verifying the immunization, click the <b class="text-blue-600">'Next'</b> button to proceed to the Payment section.
                                <br> <br>
                                In the Payment section, the total amount due will be calculated based on the selected service and any additional fees. Date of Transaction is automatically set to the current system date and time.
                                <br>
                                <br>
                                Staff Verification is required to confirm the payment details and complete the registration process.
                                It requires the staff's password for verification.
                            </p>
                            <div class="flex flex-col md:flex-row items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/PSTEP6.png') }}" alt="Step 1" class="w-full max-w-xs object-contain">
                                <img src="{{ asset('manual-img/patients/PSTEP8.png') }}" alt="Step 1" class="w-full max-w-2xl object-contain">
                            </div>
                            <p class="mt-3">
                                After completing the payment verification, click the <b class="text-blue-600">'Submit'</b> button to finalize the patient registration.
                                A confirmation message will appear, and the new patient record will be added to the patient list. You can choose to view the new patient's profile or return to home page.
                                <br>
                            </p>
                            <div class="flex flex-col md:flex-row items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/PSTEP7.png') }}" alt="Step 1" class="w-full max-w-xs object-contain">
                            </div>
                            <p class="mt-3">
                                An email notification will be sent to the patient's email address (if provided) with relevant information regarding their immunization schedule. It includes vaccination card where they can download and print it for their reference.
                                <br>
                            </p>
                            <div class="flex flex-col md:flex-row items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/PSTEP9.png') }}" alt="Step 1" class="w-full max-w-xl object-contain">
                            </div>
                            <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-md mt-3">
                                <p class="text-xs md:text-base font-bold ">
                                    Important Reminder
                                </p>
                                <p class="text-[12px] md:text-sm mt-2  leading-relaxed">
                                    The system will automatically generate an immunization schedule based on the selected service during registration.
                                    This schedule will be sent to the patient's email address (if provided) along with their vaccination card.
                                </p>
                                <p class="text-[12px] md:text-sm mt-2  leading-relaxed">
                                    Please ensure that the Nurse and Staff assigned during registration are available to verify the immunization and payment details.
                                    Their verification is crucial to complete the registration process successfully.
                                </p>
                            </div>





                        </div>

                        <!-- view patient transactions -->
                        <div class="flex flex-col mt-10" id="patient-transactions">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">Manage Patient Transactions</h2>

                            <p class="mt-3">
                                After clicking, you can see the patient records list with filter and search functionalities.
                                You can view and manage patient transactions by clicking the <b class="text-blue-600">'Manage'</b> icon in the table.
                            </p>
                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/P1.png') }}" alt="Step 1" class="w-64 h-20 object-contain">
                            </div>
                            <p class="mt-3">
                                If you click the <b class="text-blue-600">'Manage'</b> icon, a section will appear showing the patient's transaction history.
                                You can add a new transaction or complete an existing one by clicking the <b class="text-blue-600">'Add Transaction'</b> button.
                            </p>
                            <p class="mt-3">
                                After clicking the <b class="text-blue-600">'Add transaction'</b> button, a modal will appear when you can choose the service to be added to the patient's transaction. <br>
                            </p>
                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/P12.png') }}" alt="Step 1" class="w-full max-w-2xl object-contain">
                            </div>

                            <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-md mt-3">
                                <p class="text-xs md:text-base font-bold ">
                                    Important Reminder
                                </p>
                                <p class="text-[12px] md:text-sm mt-2 leading-relaxed">
                                    If this is a new transaction, select a service under the <b>New Transaction</b> section.
                                    You will be redirected to a new page where you can manage the patient's new transaction.
                                </p>

                                <p class="text-[12px] md:text-sm mt-2 leading-relaxed">
                                    If you wish to <b>continue</b> a patient's immunization, select the appropriate vaccination day (e.g., D3, D4, etc.).
                                    You will be redirected to a page where you can continue and complete the patient's immunization process.
                                </p>

                            </div>

                            <p class="mt-3">
                                Below is an example of managing a patient’s transaction when completing an existing immunization schedule.
                                <br><br>
                                As shown, the patient is already in the <b>Immunization</b> section, since they are registered and have existing immunization records.
                                <br><br>
                                You may proceed to <b>Nurse Verification</b>, the <b>Payment</b> section, and <b>Staff Verification</b> to finalize the transaction.
                                <br><br>
                                Similar to the patient registration process, both Nurse and Staff verification are required to confirm the immunization and payment details before completing the transaction.
                            </p>

                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/P14.png') }}" alt="Step 1" class="w-full max-w-4xl object-contain">
                            </div>

                            <p class="mt-3">
                                For a new transaction, the process is similar to patient registration. However, since the patient's personal information is already on record, the system will skip directly to the <b>Immunization</b> section.
                                <br><br>
                                Please note that for the <b>Post-Exposure Prophylaxis (PEP)</b> service, the system will proceed to the <b>History of Exposure</b> and <b>Animal Profile</b> sections first before moving to the <b>Immunization</b> section.
                                If the selected service does not require these sections, it will go directly to the Immunization section.
                                <br><br>
                                Just like the initial registration process, both <b>Nurse</b> and <b>Staff verification</b> are required to confirm the immunization and payment details before completing the transaction.
                            </p>
                            <p class="mt-3">
                                An email message will be sent to the patient's email address (if provided) with relevant information regarding their updated immunization schedule. It includes vaccination card where they can download and print it for their reference.
                                <br>
                            </p>
                            <div class="flex flex-col md:flex-row items-center justify-center my-3">
                                <img src="{{ asset('manual-img/patients/P15.png') }}" alt="Step 1" class="w-full max-w-xl object-contain">
                            </div>





                        </div>

            </section>

            <!-- messages -->
            <section id="messages" class="mt-20">
                <div class="flex flex-col">
                    <!-- Header -->
                    <div class="flex flex-row items-center gap-5 py-6 md:py-8 md:px-14 px-4">
                        <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-12 h-12">
                        <div>
                            <h1 class="text-lg md:text-2xl font-900">SMS Messages</h1>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col gap-4 md:px-20 px-4 pb-6">
                        <p class="text-xs md:text-base leading-relaxed">
                            The SMS Messages section allows clinic staff to efficiently send notifications and updates to patients regarding their immunizations,
                            schedules, and other important information.
                        </p>

                        <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-md">
                            <p class="text-xs md:text-base font-bold ">
                                Important Reminder
                            </p>
                            <p class="text-[10px] md:text-sm mt-2  leading-relaxed">
                                The system will only send SMS messages to patients who have provided a valid mobile number during registration.
                                Please ensure that the mobile number is accurate to avoid delivery issues.
                            </p>
                            <p class="text-[10px] md:text-sm mt-2  leading-relaxed">
                                Please be aware that SMS delivery issues may arise due to factors beyond the system's control, such as network problems or incorrect mobile numbers or SMS API limitations.
                                The recipient can't reply to the SMS messages sent from the system.
                            </p>
                        </div>


                        <p class="text-xs md:text-base leading-relaxed">
                            Keep in mind that SMS messages are automatically generated based on the patient's immunization schedule and other important updates.
                            For example, reminders for upcoming immunizations such as "D3", "D7", etc. The system sends these messages to patients according to their scheduled dates.
                            <br><br>
                            You can send SMS messages in three ways:
                            <br>
                            • Click the <b class="text-blue-600">"Send"</b> button to send an individual message to a specific patient.
                            <br>
                            • Click the <b class="text-blue-600">"Send All SMS"</b> button to send messages to all patients in the list.
                            <br>
                            • Click the <b class="text-blue-600">"Send New Message"</b> button to compose and send a custom message to a specific patient.
                        </p>

                        <!-- send single -->
                        <div class="flex flex-col mt-10" id="send-single">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">Send Single SMS</h2>
                            <p>
                                To send an SMS to a single patient who are scheduled to be messaged, click the <b class="text-blue-600">'Send'</b> button in the row corresponding to that patient.
                            </p>

                            <p class="mt-3">
                                After clicking the <b class="text-blue-600">'Send'</b> button, a confirmation modal will appear.
                                Review the message content and recipient's mobile number before confirming the send action.
                                You can also changes the message content if needed.
                            </p>
                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/messages/M3.png') }}" alt="Step 1" class="w-full max-w-xl object-contain">
                            </div>
                            <p class="mt-3">
                                Click the <b class="text-blue-600">'Send'</b> button to send the SMS message to the selected patient.
                                A success message will appear once the SMS is sent successfully.

                            </p>
                        </div>
                        <!-- send all -->
                        <div class="flex flex-col mt-10" id="send-bulk">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">Send All SMS</h2>
                            <p>
                                To send SMS messages to all patients who are scheduled to receive them, click the <b class="text-blue-600">"Send All SMS"</b> button.
                            </p>

                            <p class="mt-3">
                                After clicking the <b class="text-blue-600">"Send All SMS"</b> button, a confirmation modal will appear.
                                It will display the list of patients along with their message content and mobile numbers for review before you confirm the action.
                            </p>

                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/messages/M1.png') }}" alt="Step 1" class="w-full max-w-xl object-contain">
                            </div>
                            <p class="mt-3">
                                Click the <b class="text-blue-600">'Send'</b> button to send the SMS message to the selected patient.
                                A success message will appear once the SMS is sent successfully.

                            </p>
                        </div>
                        <!-- send custom -->
                        <div class="flex flex-col mt-10" id="send-custom">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">Send Custom SMS</h2>

                            <p>
                                To send a custom SMS to a patient, click the <b class="text-blue-600">"Send New Message"</b> button.
                            </p>

                            <p class="mt-3">
                                After clicking the <b class="text-blue-600">"Send New Message"</b> button, a confirmation modal will appear.
                                Select the recipient's mobile number from the provided list of patients and their phone numbers, then compose your custom message in the designated fields.
                            </p>
                            <p class="mt-3">
                                You can easily locate a patient and their mobile number by searching or browsing the list.
                                When you click or focus on the <b>To:</b> field, a dropdown menu will appear displaying all patients along with their corresponding mobile numbers for quick selection.
                            </p>

                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/messages/M2.png') }}" alt="Step 1" class="w-full max-w-xl object-contain">
                            </div>

                            <p class="mt-3">
                                Click the <b class="text-blue-600">"Send"</b> button to send the SMS message to the selected patient.
                                A success message will appear once the SMS has been sent successfully.
                            </p>
                        </div>

                    </div>
                </div>
            </section>

            <!-- services -->
            <section id="services" class="mt-10">
                <div class="flex flex-col">
                    <!-- Header -->
                    <div class="flex flex-row items-center gap-5 py-6 md:py-8 md:px-14 px-4">
                        <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-12 h-12">
                        <div>
                            <h1 class="text-lg md:text-2xl font-900">Services</h1>
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="flex flex-col gap-4 md:px-20 px-4 pb-6">
                        <p class="text-xs md:text-base leading-relaxed">
                            The Services section allows clinic staff to manage the various services offered by the clinic.
                            This includes adding new services, and editing existing ones.
                        </p>
                        <p class="mt-3 ">
                            To navigate to the Services section, click on the <b class="text-blue-600">'Services'</b> link in the sidebar menu.
                        </p>
                        <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-md mt-3">
                            <p class="text-xs md:text-base font-bold ">
                                Important Reminder
                            </p>
                            <p class="text-[10px] md:text-sm mt-2  leading-relaxed">
                                The system can handle services that require immunizations, vaccinations, or injections.
                                Please ensure to select the appropriate service during patient registration. <span class="font-semibold italic">Non-immunization services are not supported in this version of the system.</span>
                            </p>
                            <p class="text-[10px] md:text-sm mt-2  leading-relaxed">
                                Not all services need schedules like D3, D7, etc. Some services may only require a single immunization or vaccination without follow-up doses.
                                Please ensure to select the appropriate service during patient registration.
                            </p>
                        </div>

                        <!-- add services-->
                        <div class="flex flex-col mt-10" id="add-services">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">Add New Services</h2>
                            <p>
                                To add a new service, click the <b class="text-blue-600">'Add Service'</b> button located at the top right corner of the Services page.
                            </p>

                            <p class="mt-3">
                                After clicking the <b class="text-blue-600">'Add Service'</b> button, a modal will appear.
                                Fill in the required fields such as Service Name, Description, Service Fee, and Immunization Schedule (if applicable).
                            </p>
                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/services/S1.png') }}" alt="Step 1" class="w-full max-w-xl object-contain">
                            </div>
                            <p class="mt-3">
                                Click the <b class="text-blue-600">'Create Services'</b> button to add the new service.
                                A success message will appear once the service is added successfully.
                            </p>
                        </div>

                        <!-- update -->
                        <div class="flex flex-col mt-10" id="update-services">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">Update Services</h2>
                            <p>
                                To update an existing service, click the <b class="text-blue-600">'Edit'</b> icon located in the Actions column of the Services table.
                            </p>

                            <p class="mt-3">
                                After clicking the <b class="text-blue-600">'Edit'</b> icon, it will redirect you to the edit service page.
                                Update the necessary fields such as Service Name, Description, Service Fee, and Immunization Schedule (if applicable).
                                <br>
                                You can also add or remove schedule days as needed. By clicking the <b class="text-blue-600">'Add New Schedule '</b> button, you can add new schedule days.
                                To remove a schedule day, simply click the <b class="text-blue-600">'Trash'</b> icon next to the respective schedule day.
                            </p>
                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/services/S2.png') }}" alt="Step 1" class="w-full max-w-2xl object-contain">
                            </div>
                            <p class="mt-3">
                                Click the <b class="text-blue-600">'Update Services'</b> button to update the service.
                                A success message will appear once the service is updated successfully.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- inventory -->
            <section id="inventory" class="mt-10">
                <div class="flex flex-col">
                    <!-- Header -->
                    <div class="flex flex-row items-center gap-5 py-6 md:py-8 md:px-14 px-4">
                        <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-12 h-12">
                        <div>
                            <h1 class="text-lg md:text-2xl font-900">Inventory Supplies</h1>
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="flex flex-col gap-4 md:px-20 px-4 pb-6">
                        <p class="text-xs md:text-base leading-relaxed">
                            The Inventory Supplies section allows clinic staff to manage the various supplies used in the clinic.
                            Such as Adding New Supplies, Updating Existing Supplies, and Monitoring Stock Levels.
                        </p>
                        <p class="mt-3 ">
                            To navigate to the Inventory Supplies section, click on the <b class="text-blue-600">'Inventory'</b> link in the sidebar menu.
                        </p>
                        <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-md mt-3">
                            <p class="text-xs md:text-base font-bold ">
                                Important Reminder
                            </p>
                            <p class="text-[10px] md:text-sm mt-2 leading-relaxed">
                                When adding a new service, please ensure that the corresponding supplies are also added to the inventory to prevent issues during patient registration.
                            </p>
                            <p class="text-[10px] md:text-sm mt-2 leading-relaxed">
                                Please note that if a product can be used for both PEP and PREP, the service usage field should be left blank. The service usage field is only applicable for supplies intended for a single service.
                                Additionally, the product quantity, units, and price are automatically calculated.
                            </p>
                            <p class="text-[10px] md:text-sm mt-2 leading-relaxed">
                                Keep in mind that a <b class="text-blue-600">"Vial"</b> or <b class="text-blue-600">"Piece"</b> represents a single bottle. The <b>Package Quantity</b> refers to the number of vials, and the <b>Items Per Package</b> will always be 1 for vials.
                                For example, if you have 5 vials, the Package Quantity is 5 and the Items Per Package is 1. Therefore, you have a total of 5 items.
                            </p>

                            <p class="text-[10px] md:text-sm mt-2 leading-relaxed">
                                On the other hand, a <b class="text-blue-600">"Box"</b> or <b class="text-blue-600">"Pack"</b> contains multiple items. The <b>Package Quantity</b> refers to the number of boxes or packs, and the <b>Items Per Package</b> represents how many vials each box or pack contains.
                                For example, if you have 5 boxes and each box contains 10 vials, the Package Quantity is 5 and the Items Per Package is 10. Therefore, you have a total of 50 items.
                            </p>

                        </div>

                        <!-- add supplies-->
                        <div class="flex flex-col mt-10" id="add-supplies">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">Add New Supplies</h2>
                            <p>
                                To add a new supplies, click the <b class="text-blue-600">'Add New Supplies'</b> button located at the top right corner of the Inventory page.
                            </p>

                            <p class="mt-3">
                                After clicking the <b class="text-blue-600">'Add New Supplies'</b> button, a modal will appear.
                                <br>
                                Fill out the required fields such as Product Name, type, category, usage and stocks information.
                            </p>

                            <p class="mt-3">
                                Please note that if a product can be used for both PEP and PREP, the service usage field should be left blank. The service usage field is only applicable for supplies intended for a single service.
                            </p>

                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/inventory/I1.png') }}" alt="Step 1" class="w-full max-w-2xl object-contain">
                            </div>
                            <p class="mt-3">
                                Keep in mind that a <b class="text-blue-600">"Vial"</b> or <b class="text-blue-600">"Piece"</b> represents a single bottle. The <b>Package Quantity</b> refers to the number of vials, and the <b>Items Per Package</b> will always be 1 for vials.
                                For example, if you have 5 vials, the Package Quantity is 5 and the Items Per Package is 1. Therefore, you have a total of 5 items.
                            </p>

                            <p class="mt-3">
                                On the other hand, a <b class="text-blue-600">"Box"</b> or <b class="text-blue-600">"Pack"</b> contains multiple items. The <b>Package Quantity</b> refers to the number of boxes or packs, and the <b>Items Per Package</b> represents how many vials each box or pack contains.
                                For example, if you have 5 boxes and each box contains 10 vials, the Package Quantity is 5 and the Items Per Package is 10. Therefore, you have a total of 50 items.
                            </p>

                            <p class="mt-3">
                                The system automatically calculates the total quantity and price based on the provided package quantity, items per package, and price per item.
                            </p>

                            <p class="mt-3">
                                Click the <b class="text-blue-600">'Add New Supplies'</b> button to add the new supplies.
                                A success message will appear once the supply is added successfully.
                            </p>
                        </div>

                        <!-- view  -->
                        <div class="flex flex-col mt-10" id="view-supplies">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">View and Manage Supplies</h2>
                            <p>
                                To view and manage an existing supplies , click the <b class="text-blue-600">'View'</b> icon located in the Actions column of the Inventory table.
                            </p>

                            <p class="mt-3">
                                After clicking the <b class="text-blue-600">'View'</b> icon, it will redirect you to the edit supplies page.
                                Update the necessary fields such as Product Name, type, category, usage and stocks information. by Clicking the <b class="text-blue-600">'Edit'</b> button.
                            </p>
                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/inventory/I3.png') }}" alt="Step 1" class="w-full max-w-2xl object-contain">
                            </div>
                            <p class="mt-3">
                                After clicking the <b class="text-blue-600">'Edit'</b> button, a modal will appear where you can update the supplies information.
                                It will show success message once the supply is updated successfully.
                            </p>

                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/inventory/I2.png') }}" alt="Step 1" class="w-full max-w-2xl object-contain">
                            </div>
                            <p class="mt-3">
                                <br>
                                Add new stocks by clicking the <b class="text-blue-600">'Add New Stocks '</b> button.
                                <br>
                                After clicking the button, a modal will appear where you can input the new stock information.
                            </p>
                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/inventory/I4.png') }}" alt="Step 1" class="w-full max-w-2xl object-contain">
                            </div>
                            <p class="mt-3">
                                Click the <b class="text-blue-600">'Add Supplies'</b> button to update the service.
                                A success message will appear once the supply is updated successfully.
                                <br><br>
                                <br>
                                You can also view the supply usage history by clicking the <b class="text-blue-600">'View Usage History'</b> button.
                            </p>
                            <p class="mt-3">
                                You can also view the item details table to see complete information about each supply, including its status, remaining quantity, and disposal options.
                                When an item is expired or fully used, you can dispose of it by clicking the <b class="text-blue-600">"Dispose"</b> button.
                            </p>
                            <div class="flex flex-col md:flex-row items-center justify-center my-3">
                                <img src="{{ asset('manual-img/inventory/I6.png') }}" alt="Step 1" class="w-full max-w-2xl object-contain">
                                <img src="{{ asset('manual-img/inventory/I5.png') }}" alt="Step 1" class="w-full max-w-xs object-contain">
                            </div>

                            <div class="bg-red-100 border-l-4 border-red-500 p-4 rounded-md mt-3">
                                <p class="text-xs md:text-base font-bold ">
                                    Important Reminder
                                </p>
                                <p class="text-[10px] md:text-sm mt-2 leading-relaxed">
                                    Disposing of an item is a permanent action and cannot be undone.
                                    Please ensure that you have selected the correct item before proceeding with the disposal.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <!-- appointments -->
            <section id="appointments" class="mt-10 mb-20">
                <div class="flex flex-col">
                    <!-- Header -->
                    <div class="flex flex-row items-center gap-5 py-6 md:py-8 md:px-14 px-4">
                        <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-12 h-12">
                        <div>
                            <h1 class="text-lg md:text-2xl font-900">Appointments</h1>
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="flex flex-col gap-4 md:px-20 px-4 pb-6">
                        <p class="text-xs md:text-base leading-relaxed">
                            The Appointments section allows clinic staff to manage patient appointments efficiently.
                            This includes scheduling new appointments, viewing existing ones, and updating appointment details as needed.
                        </p>
                        <p class="mt-3 ">
                            To navigate to the Appointments section, click on the <b class="text-blue-600">'Appointments'</b> link in the sidebar menu.
                        </p>
                        <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-md mt-3">
                            <p class="text-xs md:text-base font-bold ">
                                Important Reminder
                            </p>
                            <p class="text-[10px] md:text-sm mt-2 leading-relaxed">
                                This appointment system is designed to handle various booking channels, including Phone Calls, Text Messages, and Online Bookings through the website.
                                It will provide a list of all appointments scheduled through these channels for easy management.
                            </p>
                       

                        </div>
                        <!-- add appointments-->
                        <div class="flex flex-col mt-10" id="add-appointments">
                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold">Add New Appointments</h2>
                            <p>
                                To add a new appointment, click the <b class="text-blue-600">'Add Appointment'</b> button located at the top right corner of the Appointments page.
                            </p>

                            <p class="mt-3">
                                After clicking the <b class="text-blue-600">'Add Appointment'</b> button, a modal will appear.
                                <br>
                                Fill out the required fields such as Patient Name, Appointment Date, Time, booking channel any additional notes.
                            </p>

                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/appointments/A1.png') }}" alt="Step 1" class="w-full max-w-sm object-contain">
                            </div>

                            <p class="mt-3">
                                Please take note that new appointments can be done thru various booking channels such as Phone Call, Test Messages, and Online Booking using the website.
                                <br><br>
                            </p>
                            <p class="mt-3">
                                You can reschedule appointments by clicking the <b class="text-blue-600">'Reschedule'</b> icon located in the Actions column of the Appointments table.
                                <br>
                                After clicking the <b class="text-blue-600">'Reschedule'</b> icon, a modal will appear where you can select a new date and time for the appointment.
                            </p>

                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/appointments/A2.png') }}" alt="Step 1" class="w-full max-w-sm object-contain">
                            </div>
                            <p class="mt-3">
                                Click the <b class="text-blue-600">'Submit'</b> button to add the new appointment.
                                A success message will appear once the appointment is added successfully.
                                <br>
                                An email notification will be sent to the patient's email address (if provided) with the appointment details.
                            </p>

                            <h2 class="text-lg md:text-xl text-[#FF000D] font-bold mt-12">Update Appointment Status</h2>
                            <p class="mt-3">
                                You can also update the appointment status by clicking the <b class="text-blue-600">'Update Status'</b> icon located in the Actions column of the Appointments table.
                                <br>
                                If <b class="text-blue-600">'Arrived'</b> is selected, it means the patient has arrived for their appointment.
                                If <b class="text-blue-600">'Cancelled'</b> is selected, it means the appointment has been cancelled.
                            </p>
                            <div class="flex items-center justify-center my-3">
                                <img src="{{ asset('manual-img/appointments/A3.png') }}" alt="Step 1" class="w-full max-w-sm object-contain">
                            </div>
                            <p class="mt-3">
                                After clicking the <b class="text-blue-600">'Submit'</b> icon, a modal will appear where you can select the new status for the appointment.
                                Click the <b class="text-blue-600">'Update'</b> button to save the changes.
                                A success message will appear once the appointment status is updated successfully.
                            </p>

                        </div>
                    </div>
                </div>


            </section>



        </main>
    </div>
</body>




</html>