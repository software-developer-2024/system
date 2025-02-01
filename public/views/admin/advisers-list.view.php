<?php require 'partials/head.php'; ?>

<!-- dataTables -->
<link rel="stylesheet" href="css/datatables.min.css">
</head>

<body class="coe">
    <div class="w-dynamic h-mobile bg-neutral flex">
        <!-- sidebar start -->
        <!-- sidebar end -->

        <div class="w-1/6 h-mobile"></div>

        <main class="sm:px-4 sm:py-10 flex-1 overflow-y-auto overflow-x-hidden">
            <div class="pb-4">
                <a href="/advisers" data-tooltip-target="go-back" data-tooltip-placement="right"
                    class="px-3 text-2xl font-medium text-purple-600 focus:outline-none bg-white rounded shadow hover:bg-purple-300 hover:text-white focus:z-10 focus:ring-4 focus:ring-purple-300">
                    < </a>
                        <div id="go-back" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                            Go Back
                        </div>
            </div>
            <!-- Table -->
            <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <div
                    class="px-5 py-4 border-b border-gray-100 grid gap-4 lg:gap-0 lg:flex lg:justify-between overflow-x-auto">
                    <div class="flex justify-between items-center sm:justify-start gap-4 w-full">
                        <h1
                            class="md:text-lg sm:text-md text-sm font-semibold text-contrast whitespace-nowrap leading-loose">
                            <?= $heading ?>
                        </h1>

                    </div>
                </div>
                <div class="p-3">
                    <div class="tableData">
                        <table id="adviserTable" class="table table-auto w-full row-border stripe nowrap">
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
                                        <div class="font-semibold text-center">Student ID</div>
                                    </th>
                                    <th data-priority="6" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">email</div>
                                    </th>
                                    <th data-priority="5" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Contact</div>
                                    </th>
                                    <th data-priority="3" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Years To Stay</div>
                                    </th>
                                    <th data-priority="3" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Status</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (sizeOf($students) > 0) {
                                    foreach ($students as $student) {
                                        $middlename = ($student['middlename'] == "") ? "" : $student['middlename'][0] . ".";
                                        $fullname = "{$student['lastname']}, {$student['firstname']} {$middlename}";
                                        $yearStay = $db->getYearsToCompleteCurriculum($student['studentId']);
                                        // dd($yearStay);
                                        ?>
                                        <tr>
                                            <td class="border-b border-b-black py-2"></td>
                                            <td class="border-b border-b-black py-2 text-nowrap font-semibold text-left">
                                                <?= $student['firstname'] ?>
                                            </td>
                                            <td class="border-b border-b-black py-2 text-nowrap font-semibold text-left">
                                                <?= $student['middlename'] ?>
                                            </td>
                                            <td class="border-b border-b-black py-2 text-nowrap font-semibold text-left">
                                                <?= $student['lastname'] ?>
                                            </td>
                                            <td class="border-b border-b-black py-2 text-nowrap font-semibold text-left">
                                                <?= $fullname ?>
                                            </td>
                                            <td class="border-b border-b-black py-2 text-nowrap text-center">
                                                <?= $student['studentId'] ?>
                                            </td>
                                            <td class="border-b border-b-black py-2 text-nowrap text-center">
                                                <?= $student['email'] ?>
                                            </td>
                                            <td class="border-b border-b-black py-2 text-nowrap text-center">
                                                <?= $student['contact'] ?>
                                            </td>
                                            <td
                                                class="border-b border-b-black py-2 text-nowrap text-center <?= ($yearStay == "6") ? "text-red-600 font-medium" : "text-contrast" ?>">
                                                <?= "{$yearStay} Years" ?>
                                            </td>
                                            <td
                                                class="border-b border-b-black py-2 text-nowrap text-center <?= ($yearStay == "4") ? "text-contrast" : "text-red-600 font-medium" ?>">
                                                <?= ($yearStay == "4") ? "Reqular" : "Irregular" ?>
                                            </td>

                                        </tr>

                                    <?php } ?>

                                <?php } else { ?>
                                    <tr class="font-semibold uppercase bg-gray-200 text-contrast">
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                        <td colspan="10" class="p-1 px-9">No data recorded yet</td>
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

        <div class="w-1/6 h-mobile"></div>
    </div>

    <!-- script starts here -->
    </script>
    <script src="<?= js('datatables.min.js') ?>"></script>
    <script src="<?= js('flowbite.min.js') ?>"></script>
    <script src="<?= js('adviser.js') ?>"></script>

    <!-- script ends here -->

</body>

</html>