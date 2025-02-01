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
                    <div class="flex gap-4">
                        <h1 class="text-xl font-semibold text-contrast whitespace-nowrap leading-loose">
                            <?= $heading ?>
                        </h1>
                        <a class="font-semibold bg-transparent hover:bg-red-600/60 hover:text-white shadow text-red-600/60 my-auto px-2 rounded text-3xl"
                            data-tooltip-target="add-faculty" data-tooltip-placement="right" href="/add/curriculum">
                            +
                        </a>
                        <div id="add-faculty" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Add Curriculum
                        </div>
                    </div>
                </div>
                <?php if (isset($msg)) { ?>
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50"
                        role="alert">
                        <div>
                            <?= $msg ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="p-3">
                    <div class="tableData">
                        <table id="curriculumTable" class="table table-auto w-full row-border stripe nowrap">
                            <thead class="font-semibold uppercase bg-contrast text-primary">
                                <tr>
                                    <th data-priority="1"></th>
                                    <th data-priority="1" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Name</div>
                                    </th>
                                    <th data-priority="3" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Department</div>
                                    </th>
                                    <th data-priority="2" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Year Effective</div>
                                    </th>
                                    <th data-priority="1" class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Action</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach ($curriculums as $curriculum) {
                                    $nameLink = $curriculum['name'];
                                    $count++;
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td class="font-semibold text-left">
                                            <?= $curriculum['name'] ?>
                                        </td>
                                        <td class="text-left">
                                            <?= $curriculum['department'] ?>
                                        </td>
                                        <td class="text-left">
                                            <?= $curriculum['year'] ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="/curriculums/<?= $nameLink ?>"
                                                class="rounded-lg bg-primary px-5 py-1.5 text-center text-sm font-medium text-white hover:bg-primary/60 focus:outline-none focus:ring-4 focus:ring-primary/30">
                                                View
                                            </a>
                                        </td>

                                    </tr>

                                <?php }
                                if ($count == 0) { ?>
                                    <tr>
                                        <td class="hidden"></td>
                                        <td colspan="13">No data recorded yet</td>
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
    <script src="<?= js('curriculum.js') ?>"></script>

    <!-- script ends here -->
 
</body>

</html>