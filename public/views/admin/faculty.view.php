<?php require 'partials/head.php'; ?>

<!-- dataTables -->
<link rel="stylesheet" href="css/datatables.min.css">
</head>

<body class="coe">
    <div class="w-dynamic h-mobile bg-neutral flex">
        <!-- sidebar start -->
        <?php require "partials/sidebar.php" ?>
        <!-- sidebar end -->

        <main class="sm:px-4 sm:py-10 flex-1 overflow-y-auto">
            <!-- Table -->
            <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <div
                    class="px-5 py-4 border-b border-gray-100 grid gap-4 lg:gap-0 lg:flex lg:justify-between overflow-x-auto">
                    <div class="flex justify-between sm:justify-start gap-4 w-full">
                        <h1 class="text-xl font-semibold text-contrast whitespace-nowrap leading-loose">
                            <?= $heading ?>
                        </h1>
                        <a class="font-semibold bg-transparent hover:bg-red-600/60 hover:text-white shadow text-red-600/60 my-auto px-2 rounded text-3xl"
                            data-tooltip-target="add-faculty" data-tooltip-placement="right" href="/add/faculty">
                            +
                        </a>
                        <div id="add-faculty" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Add Faculty
                        </div>
                    </div>

                    <!-- <div class="flex gap-2 input-group justify-end">
                        <label class="py-1" for="search">Search: </label>
                        <input class="w-full outline-none border-b-2 border-b-contrast hover:border-b-brand focus:border-b-brand valid:border-b-brand transition-all ease-in py-1 px-3"
                            type="text" name="search" id="search" placeholder='Press "Enter" to Search' required>
                    </div> -->
                </div>
                <div class="p-3">
                    <div class="tableData">
                        <table id="facultyTable" class="table table-auto w-full row-border stripe nowrap">
                            <thead class="font-semibold uppercase bg-contrast text-primary">
                                <tr>
                                    <th data-priority="1"></th>
                                    <th data-priority="9" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">First name</div>
                                    </th>
                                    <th data-priority="9" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Middle name</div>
                                    </th>
                                    <th data-priority="9" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Last name</div>
                                    </th>
                                    <th data-priority="1" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Name</div>
                                    </th>
                                    <th data-priority="4" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Department</div>
                                    </th>
                                    <th data-priority="3" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Role</div>
                                    </th>
                                    <th data-priority="4" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Advisee</div>
                                    </th>
                                    <th data-priority="4" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Curriculum</div>
                                    </th>
                                    <th data-priority="9" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">ID</div>
                                    </th>
                                    <th data-priority="5" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Email Address</div>
                                    </th>
                                    <th data-priority="3" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Contact No.</div>
                                    </th>
                                    <th data-priority="2" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Action</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                if (sizeof($total) > 0) {
                                    if (sizeof($adviser) > 0) {
                                        foreach ($adviser as $member) {
                                            $middlename = ($member['middlename'] == "") ? "" : $member['middlename'][0] . ".";
                                            $fullname = "{$member['lastname']}, {$member['firstname']} {$middlename}";
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td class="font-semibold text-left">
                                                    <?= $member['firstname'] ?>
                                                </td>
                                                <td class="font-semibold text-left">
                                                    <?= $member['middlename'] ?>
                                                </td>
                                                <td class="font-semibold text-left">
                                                    <?= $member['lastname'] ?>
                                                </td>
                                                <td class="font-semibold text-left capitalize">
                                                    <?= $fullname ?>
                                                </td>
                                                <td>
                                                    <?= $member['department'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $member['role'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $member['advisee'] ?? "None" ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $member['curriculum'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $member['uniqueId'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= ($member['email'] == "") ? "None" : $member['email'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= substr($member['contact'], 0, 4) . " " . substr($member['contact'], 4, 3) . " " . substr($member['contact'], 7, 11) ?>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <button id="tooltipButton<?= $count ?>" type="button"
                                                            class="rounded-lg bg-primary px-5 py-2.5 text-center text-sm font-medium text-contrast hover:bg-primary/60 focus:outline-none focus:ring-4 focus:ring-primary/30">
                                                            Edit
                                                        </button>
                                                        <div id="tooltipContent<?= $count ?>" role="tooltip"
                                                            class="tooltip invisible absolute rounded-lg text-sm font-medium text-gray-900 opacity-0transition-opacity duration-300 flex flex-col">
                                                            <button type="button" data-modal-target="default-modal"
                                                                data-modal-toggle="default-modal"
                                                                class="bg-white hover:bg-green-300 rounded-t-lg"
                                                                id="assign">Assign</button>
                                                            <button type="button" data-modal-target="default-modal"
                                                                data-modal-toggle="default-modal"
                                                                class="bg-white hover:bg-yellow-300" id="edit">Edit Profile</button>
                                                            <button type="button" data-modal-target="default-modal"
                                                                data-modal-toggle="default-modal" class="bg-white hover:bg-gray-300"
                                                                id="reset">Reset Password</button>
                                                            <button type="button" data-modal-target="default-modal"
                                                                data-modal-toggle="default-modal"
                                                                class="bg-white hover:bg-red-300 rounded-b-lg"
                                                                id="delete">Delete</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php $count++;
                                        }
                                    } ?>

                                    <?php
                                    if (sizeof($sub_adviser) > 0) {
                                        foreach ($sub_adviser as $member) {
                                            $middlename = ($member['middlename'] == "") ? "" : $member['middlename'][0] . ".";
                                            $fullname = "{$member['lastname']}, {$member['firstname']} {$middlename}";
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td class="font-semibold text-left">
                                                    <?= $member['firstname'] ?>
                                                </td>
                                                <td class="font-semibold text-left">
                                                    <?= $member['middlename'] ?>
                                                </td>
                                                <td class="font-semibold text-left">
                                                    <?= $member['lastname'] ?>
                                                </td>
                                                <td class="font-semibold text-left">
                                                    <?= $fullname ?>
                                                </td>
                                                <td>
                                                    <?= $member['department'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $member['role'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $member['advisee'] ?? "None" ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $member['curriculum'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $member['uniqueId'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= ($member['email'] == "") ? "None" : $member['email'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= substr($member['contact'], 0, 4) . " " . substr($member['contact'], 4, 3) . " " . substr($member['contact'], 7, 11) ?>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <button id="tooltipButton<?= $count ?>" type="button"
                                                            class="rounded-lg bg-primary px-5 py-2.5 text-center text-sm font-medium text-contrast hover:bg-primary/60 focus:outline-none focus:ring-4 focus:ring-primary/30">
                                                            Edit
                                                        </button>
                                                        <div id="tooltipContent<?= $count ?>" role="tooltip"
                                                            class="tooltip invisible absolute rounded-lg text-sm font-medium text-gray-900 opacity-0transition-opacity duration-300 flex flex-col">
                                                            <button type="button" data-modal-target="default-modal"
                                                                data-modal-toggle="default-modal"
                                                                class="bg-white hover:bg-green-300 rounded-t-lg"
                                                                id="assign">Assign</button>
                                                            <button type="button" data-modal-target="default-modal"
                                                                data-modal-toggle="default-modal"
                                                                class="bg-white hover:bg-yellow-300" id="edit">Edit Profile</button>
                                                            <button type="button" data-modal-target="default-modal"
                                                                data-modal-toggle="default-modal" class="bg-white hover:bg-gray-300"
                                                                id="reset">Reset Password</button>
                                                            <button type="button" data-modal-target="default-modal"
                                                                data-modal-toggle="default-modal"
                                                                class="bg-white hover:bg-red-300 rounded-b-lg"
                                                                id="delete">Delete</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $count++;
                                        }
                                    } ?>

                                    <?php
                                    if (sizeof($none) > 0) {
                                        foreach ($none as $member) {
                                            $middlename = ($member['middlename'] == "") ? "" : $member['middlename'][0] . ".";
                                            $fullname = "{$member['lastname']}, {$member['firstname']} {$middlename}";
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td class="font-semibold text-left">
                                                    <?= $member['firstname'] ?>
                                                </td>
                                                <td class="font-semibold text-left">
                                                    <?= $member['middlename'] ?>
                                                </td>
                                                <td class="font-semibold text-left">
                                                    <?= $member['lastname'] ?>
                                                </td>
                                                <td class="font-semibold text-left">
                                                    <?= $fullname ?>
                                                </td>
                                                <td>
                                                    <?= $member['department'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $member['role'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $member['advisee'] ?? "None" ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $member['curriculum'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $member['uniqueId'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= ($member['email'] == "") ? "None" : $member['email'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= substr($member['contact'], 0, 4) . " " . substr($member['contact'], 4, 3) . " " . substr($member['contact'], 7, 11) ?>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <button id="tooltipButton<?= $count ?>" type="button"
                                                            class="rounded-lg bg-primary px-5 py-2.5 text-center text-sm font-medium text-contrast hover:bg-primary/60 focus:outline-none focus:ring-4 focus:ring-primary/30">
                                                            Edit
                                                        </button>
                                                        <div id="tooltipContent<?= $count ?>" role="tooltip"
                                                            class="tooltip invisible absolute rounded-lg text-sm font-medium text-gray-900 opacity-0transition-opacity duration-300 flex flex-col">
                                                            <button type="button" data-modal-target="default-modal"
                                                                data-modal-toggle="default-modal"
                                                                class="bg-white hover:bg-green-300 rounded-t-lg"
                                                                id="assign">Assign</button>
                                                            <button type="button" data-modal-target="default-modal"
                                                                data-modal-toggle="default-modal"
                                                                class="bg-white hover:bg-yellow-300" id="edit">Edit Profile</button>
                                                            <button type="button" data-modal-target="default-modal"
                                                                data-modal-toggle="default-modal" class="bg-white hover:bg-gray-300"
                                                                id="reset">Reset Password</button>
                                                            <button type="button" data-modal-target="default-modal"
                                                                data-modal-toggle="default-modal"
                                                                class="bg-white hover:bg-red-300 rounded-b-lg"
                                                                id="delete">Delete</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $count++;
                                        }
                                    } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                        <td colspan="13">No data recorded yet</td>
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


            <!-- Main modal -->
            <div id="default-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900" id="modal-header">
                                Oops!!
                            </h3>
                            <button type="button" id="modal-close"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm px-2 py-1 inline-flex justify-center items-center"
                                data-modal-hide="default-modal">
                                Close
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4" id="modal-body">
                            <p class="text-base leading-relaxed text-gray-500">
                                Looks like we caught someone using inspect element. Anyway, have fun learning and
                                understanding our html structure.
                            </p>
                        </div>
                    </div>
                </div>
            </div>


        </main>
    </div>

    <!-- script starts here -->

    <script src="<?= js('datatables.min.js') ?>"></script>
    <script src="<?= js('flowbite.min.js') ?>"></script>
    <script src="<?= js('faculty.js') ?>"></script>

    <!-- script ends here -->

</body>

</html>