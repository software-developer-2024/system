<?php require 'partials/head.php'; ?>

</head>

<body class="bg-gray-300">

    <div class="flex justify-center">
        <div class="w-form p-5 pr-7 bg-white shadow rounded-b mx-auto">
            <div class="px-4 pb-4">
                <a href="<?= $_SESSION['location'] ?? '/' ?>" data-tooltip-target="go-back"
                    data-tooltip-placement="right"
                    class="my-auto px-2 me-2 text-2xl font-medium text-purple-600 focus:outline-none bg-transparent rounded shadow hover:bg-purple-300 hover:text-white focus:z-10 focus:ring-4 focus:ring-purple-300">
                    < </a>
                        <div id="go-back" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                            Go Back
                        </div>
            </div>

            <form method="post" action="/action/add" class="w-full">

                <div class="border border-gray-100 shadow rounded my-3 mb-9 mx-1 p-5 relative w-full">
                    <span
                        class="absolute border border-gray-100 shadow rounded text-sm top-0 -translate-y-3 left-2 bg-white px-1">Personal
                        Information:
                    </span>

                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="fname" class="block mb-2 text-sm font-medium text-gray-900">
                                First name
                            </label>
                            <input type="text" id="fname" name="fname" value="<?= $_SESSION['__flash']['fname'] ?? '' ?>"
                                class="capitalize bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter First name" required />
                        </div>
                        <div>
                            <label for="mname" class="block mb-2 text-sm font-medium text-gray-900">
                                Middle name
                            </label>
                            <input type="text" id="mname" name="mname" value="<?= $_SESSION['__flash']['mname'] ?? '' ?>"
                                class="capitalize bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter Middle name (Optional)" />
                        </div>
                        <div>
                            <label for="lname" class="block mb-2 text-sm font-medium text-gray-900">
                                Last name
                            </label>
                            <input type="text" id="lname" name="lname" value="<?= $_SESSION['__flash']['lname'] ?? '' ?>"
                                class="capitalize bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter Last name" required />
                        </div>
                    </div>
                    <div class="grid gap-6 mb-6 md:grid-cols-4">
                        <div>
                            <label for="student" class="block mb-2 text-sm font-medium text-gray-900">Student
                                ID</label>
                            <input type="tel" id="student" name="studentId"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="20XX-XXXXX" pattern="20[0-9]{2}-[0-9]{5}" required />
                            <div class="text-right text-sm text-red-600"><?= $_SESSION['__flash']['msg'] ?? '' ?></div>
                        </div>
                        <div>
                            <label for="contact" class="block mb-2 text-sm font-medium text-gray-900">Contact
                                No.</label>
                            <input type="tel" id="contact" name="contact" value="<?= $_SESSION['__flash']['contact'] ?? '' ?>"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="09XXXXXXXXX" pattern="09[0-9]{9}" required />
                        </div>
                        <div class="col-span-2">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" id="email" name="email" value="<?= $_SESSION['__flash']['email'] ?? '' ?>"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter Email Address" required />
                        </div>
                    </div>

                </div>

                <input type="submit" name="submit" value="Add Student"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">

            </form>

        </div>
    </div>

    <!-- script ends here -->
     <script src="<?= js("add-student.js") ?>"></script>

</body>

</html>