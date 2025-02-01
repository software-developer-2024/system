<?php require 'partials/head.php'; ?>

</head>

<body class="coe">
    <div class="w-dynamic h-mobile bg-neutral flex">
        <!-- sidebar start -->
        <?php require "partials/sidebar-myaccount.php" ?>
        <!-- sidebar end -->

        <main class="sm:px-4 sm:py-10 flex-1 overflow-y-auto">
            <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <div
                    class="px-5 py-4 border-b border-gray-100 grid gap-4 lg:gap-0 lg:flex lg:justify-between overflow-x-auto">
                    <div class="flex w-full gap-4">

                        <a href="<?= $location ?? '/' ?>" data-tooltip-target="go-back" data-tooltip-placement="right"
                            class="my-auto px-2 me-2 text-2xl font-medium text-purple-600 focus:outline-none bg-transparent rounded shadow hover:bg-purple-300 hover:text-white focus:z-10 focus:ring-4 focus:ring-purple-300">
                            < </a>

                                <div id="go-back" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Go Back
                                </div>

                                <h1 class="text-xl font-semibold text-contrast whitespace-nowrap leading-loose">
                                    <?= $heading ?>
                                </h1>

                    </div>
                </div>
                <div class="p-3">
                    <form class="max-w-sm pl-5 pb-5" method="POST" action="/action/edit">
                        <?php if (parse_url($_SERVER['REQUEST_URI'])['path'] == '/myaccount/adviser/profile') { ?>

                                <div class="mb-5">
                                    <label for="fname" class="block mb-2 text-sm font-medium text-gray-900">
                                        Your First name:
                                    </label>
                                    <input type="text" id="fname" name="fname"
                                        class="shadow-sm bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 <?= (isset($_SESSION["__flash"]['fname'])) ? "border-red-600" : "border-gray-300" ?>"
                                        placeholder="Enter First name" value="<?= $user['firstname'] ?? '' ?>" required />
                                </div>
                                <div class="mb-5">
                                    <label for="mname" class="block mb-2 text-sm font-medium text-gray-900">
                                        Your Middle name:
                                    </label>
                                    <input type="text" id="mname" name="mname"
                                        class="shadow-sm bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 <?= (isset($_SESSION["__flash"]['mname'])) ? "border-red-600" : "border-gray-300" ?>"
                                        placeholder="Enter Middle name (Optional)" value="<?= $user['middlename'] ?? '' ?>" />
                                </div>
                                <div class="mb-5">
                                    <label for="lname" class="block mb-2 text-sm font-medium text-gray-900">
                                        Your Last name:
                                    </label>
                                    <input type="text" id="lname" name="lname"
                                        class="shadow-sm bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 <?= (isset($_SESSION["__flash"]['lname'])) ? "border-red-600" : "border-gray-300" ?>"
                                        placeholder="Enter Last name" value="<?= $user['lastname'] ?? '' ?>" required />
                                </div>
                                <div class="mb-5">
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">
                                        Your password:</label>
                                    <input type="password" id="password" name="password"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Confirm by password" required />
                                    <div class="text-xs p-0 m-0 text-red-600"><?= $_SESSION['__flash']['msg'] ?? "" ?></div>
                                </div>


                                <input type="submit" name="submit" value="Apply Changes"
                                    class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">

                        <?php } else if (parse_url($_SERVER['REQUEST_URI'])['path'] == '/myaccount/adviser/password') { ?>


                                <div class="mb-5">
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">
                                        Your Password:
                                    </label>
                                    <input type="password" id="password"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter current password" required />
                                </div>
                                <div class="mb-5">
                                    <label for="newPassword" class="block mb-2 text-sm font-medium text-gray-900">
                                        Your new password:</label>
                                    <input type="password" id="newPassword"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter new password" required />
                                </div>
                                <div class="mb-5">
                                    <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900">
                                        Confrim password:</label>
                                    <input type="password" id="repeat-password"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Re-enter new password" required />
                                </div>

                                <input type="submit" name="submit" value="Change Password"
                                    class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">

                        <?php } ?>
                    </form>

                </div>

            </div>

        </main>
    </div>

    <!-- script starts here -->

    <script src="<?= js('myaccount.js') ?>"></script>

    <!-- script ends here -->

</body>

</html>