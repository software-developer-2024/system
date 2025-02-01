<?php require 'partials/head.php'; ?>

<!-- dataTables -->
<link rel="stylesheet" href="css/datatables.min.css">
</head>

<body class="coe">
    <div class="w-dynamic h-mobile bg-neutral flex">
        <!-- sidebar start -->
        <?php require "partials/sidebar.php" ?>
        <!-- sidebar end -->

        <main class="sm:px-4 sm:py-10 flex-1 overflow-y-auto overflow-x-hidden">
            <!-- Table -->
            <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <div
                    class="px-5 py-4 border-b border-gray-100 grid gap-4 lg:gap-0 lg:flex lg:justify-between overflow-x-auto">
                    <div class="flex justify-between w-full">
                        <h1 class="text-xl font-semibold text-contrast whitespace-nowrap leading-loose">
                            <?= $heading ?>
                        </h1>
                    </div>
                </div>
                <div class="p-3 flex gap-3 overflow-x-hidden">
                    <div class="tableData min-w-full w-full">
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
                                        <div class="font-semibold text-left">Department</div>
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
                                    <th data-priority="2" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Action</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (sizeOf($advisers) > 0) {
                                    foreach ($advisers as $adviser) {
                                        $middlename = ($adviser['middlename'] == "") ? "" : $adviser['middlename'][0] . ".";
                                        $fullname = "{$adviser['lastname']}, {$adviser['firstname']} {$middlename}";
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td class="font-semibold text-left">
                                                <?= $adviser['firstname'] ?>
                                            </td>
                                            <td class="font-semibold text-left">
                                                <?= $adviser['middlename'] ?>
                                            </td>
                                            <td class="font-semibold text-left">
                                                <?= $adviser['lastname'] ?>
                                            </td>
                                            <td class="font-semibold text-left capitalize">
                                                <?= $fullname ?>
                                            </td>
                                            <td>
                                                <?= $adviser['department'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?= ($adviser['advisee'] == '') ? 'None' : $adviser['advisee'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $adviser['curriculum'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $adviser['uniqueId'] ?>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <a id="tooltipButton<?= $count ?>" href="/advisers/<?= $adviser['uniqueId'] ?>"
                                                        data-tooltip-target="show-students" data-tooltip-placement="left"
                                                        class="rounded-lg bg-primary px-2 py-1 text-center text-sm font-medium text-contrast hover:bg-primary/60 focus:outline-none focus:ring-4 focus:ring-primary/30">
                                                        Show
                                                    </a>
                                                    <div id="show-students" role="tooltip"
                                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                        Show Students
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php } ?>

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
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="dataTable min-w-full w-full">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores consectetur aliquid earum enim quis quod distinctio tempore aliquam nesciunt molestias laborum, fuga qui expedita quo dolores aspernatur nulla at officiis.
                    </div>
                </div>
            </div>






        </main>
    </div>

    <!-- script starts here -->
    <script src="<?= js('datatables.min.js') ?>"></script>
    <script src="<?= js('flowbite.min.js') ?>"></script>
    <script src="<?= js('advisers.js') ?>"></script>

    <!-- script ends here -->

</body>

</html>