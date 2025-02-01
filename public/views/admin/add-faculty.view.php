<?php require 'partials/head.php'; ?>

</head>

<body class="bg-gray-300">

    <div class="flex justify-center">
        <div class="w-form p-5 pr-7 bg-white shadow rounded-b mx-auto">
            <div class="px-4 pb-4">
                <a href="<?= $_SESSION['location'] ?? '/' ?>" data-tooltip-target="go-back" data-tooltip-placement="right"
                    class="my-auto px-2 me-2 text-2xl font-medium text-purple-600 focus:outline-none bg-transparent rounded shadow hover:bg-purple-300 hover:text-white focus:z-10 focus:ring-4 focus:ring-purple-300">
                    < </a>
                        <div id="go-back" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                            Go Back
                        </div>
            </div>

            <form method="post" action="/action/add" class="w-full">

                <div class="border border-gray-100 shadow rounded my-3 mx-1 p-5 relative w-full">
                    <span
                        class="absolute border border-gray-100 shadow rounded text-sm top-0 -translate-y-3 left-2 bg-white px-1">Personal
                        Information:
                    </span>

                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="fname" class="block mb-2 text-sm font-medium text-gray-900">
                                First name
                            </label>
                            <input type="text" id="fname" name="fname"
                                class="capitalize bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter First name" required />
                        </div>
                        <div>
                            <label for="mname" class="block mb-2 text-sm font-medium text-gray-900">
                                Middle name
                            </label>
                            <input type="text" id="mname" name="mname"
                                class="capitalize bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter Middle name (Optional)" />
                        </div>
                        <div>
                            <label for="lname" class="block mb-2 text-sm font-medium text-gray-900">
                                Last name
                            </label>
                            <input type="text" id="lname" name="lname"
                                class="capitalize bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter Last name" required />
                        </div>
                    </div>
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="contact" class="block mb-2 text-sm font-medium text-gray-900">Contact
                                No.</label>
                            <input type="tel" id="contact" name="contact"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="09XXXXXXXXX" pattern="09[0-9]{9}" required />
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" id="email" name="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter Email Address (Optional)"/>
                        </div>
                    </div>

                </div>

                <p class="text-xs px-2"><span class="font-medium">NOTE: </span> The username is in the format - Lastname, Firtname 2 initials (i.e. ju.delacruz).</p>
                <p class="text-xs px-2 mb-3"><span class="font-medium">NOTE: </span> The default password is the the User's contact number.</p>
                <input type="submit" name="submit" value="Add Faculty"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">

            </form>

        </div>
    </div>

<!-- script ends here -->
 
</body>

</html>