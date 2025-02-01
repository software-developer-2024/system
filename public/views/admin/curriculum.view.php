<?php require 'partials/head.php'; ?>

</head>

<body class="bg-gray-300">

    <div class="flex justify-center">
        <div class="w-full md:w-form p-5 pr-7 bg-white shadow rounded-b mx-auto">
            <div class="px-4 pb-4 flex justify-between">
                <a href="<?= $_SESSION['location'] ?? '/' ?>" data-tooltip-target="go-back"
                    data-tooltip-placement="right"
                    class="my-auto px-2 me-2 text-2xl font-medium text-purple-600 focus:outline-none bg-transparent rounded shadow hover:bg-purple-300 hover:text-white focus:z-10 focus:ring-4 focus:ring-purple-300">
                    < </a>
                        <div id="go-back" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                            Go Back
                        </div>

                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                            class="block text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            Delete
                        </button>



            </div>

            <form method="post" action="/action/add" class="w-full" onkeydown="return event.key != 'Enter';">

                <div class="border border-gray-100 shadow rounded my-3 mb-9 mx-1 p-5 relative w-full">
                    <span
                        class="absolute border border-gray-100 shadow rounded text-sm top-0 -translate-y-3 left-2 bg-white px-1">Basic
                        Information:
                    </span>

                    <div class="mb-6 grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                                Name
                            </label>
                            <input type="text" id="name" name="name"
                                class="text-gray-900 text-sm focus:ring-blue-500 focus:outline-none block w-full p-2.5 bg-transparent border-b border-b-gray-300"
                                placeholder="Name of Curriculum" value="<?= $curriculum['name'] ?>" required />
                            <div id="errName" class="text-right text-xs text-gray-500" hidden>Required</div>
                        </div>
                        <div>
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900">
                                Year Effective
                            </label>
                            <!--rounded-lg bg-gray-50 border border-gray-300 -->
                            <input type="tel" id="year" name="year"
                                class="text-gray-900 text-sm focus:ring-blue-500 focus:outline-none block w-full p-2.5 bg-transparent border-b border-b-gray-300"
                                placeholder="20XX - 20XX+1" pattern="20[0-9]{2} - 20[0-9]{2}"
                                value="<?= $curriculum['year'] ?>" required />
                            <div id="errYear" class="text-right text-xs text-gray-500" hidden>Required</div>
                        </div>
                    </div>
                    <div class="mb-6 grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900">
                                Year Effective
                            </label>
                            <!--rounded-lg bg-gray-50 border border-gray-300 -->
                            <input type="tel" id="year" name="year"
                                class="text-gray-900 text-sm focus:ring-blue-500 focus:outline-none block w-full p-2.5 bg-transparent border-b border-b-gray-300"
                                placeholder="20XX - 20XX+1" pattern="20[0-9]{2} - 20[0-9]{2}"
                                value="<?= $curriculum['year'] ?>" required />
                            <div id="errYear" class="text-right text-xs text-gray-500" hidden>Required</div>
                        </div>
                        <div>
                            <label for="mname" class="block mb-2 text-sm font-medium text-gray-900">
                                Department
                            </label>
                            <input type="text" id="dept" name="dept"
                                class="text-gray-900 text-sm focus:ring-blue-500 focus:outline-none block w-full p-2.5 bg-transparent border-b border-b-gray-300"
                                placeholder="BS Computer Engineering" value="<?= $curriculum['department'] ?>" />
                        </div>
                    </div>

                </div>

                <div class="border border-gray-100 shadow rounded my-3 mb-9 mx-1 p-5 relative w-full">
                    <span
                        class="absolute border border-gray-100 shadow rounded text-sm top-0 -translate-y-3 left-2 bg-white px-1">
                        Curriculum Content:
                    </span>

                    <div id="yearDivisor" class="w-full grid md:grid-cols-2 gap-4">
                        <?php
                        foreach ($years as $year) {
                            foreach ($semesters as $semester) {

                                $yearDivisor = $year['subjectYear'];
                                

                                $termDivisor = $semester;
                                

                                $subjectReturn = [];
                                foreach ($subjects as $subject) {
                                    if ($subject['subjectYear'] == $year['subjectYear'] && $subject['subjectSemester'] == $semester) {
                                        $subjectReturn[] = $subject;
                                    }
                                }

                                if (sizeof($subjectReturn) > 0) {
                                    ?>

                                    <div class="p-2 shadow bg-gray-100/30">
                                        <div class="text-sm font-medium text-center"><?= "{$yearDivisor} - {$termDivisor}" ?></div>
                                        <table width="600" class="w-full">
                                            <tr class="bg-gray-200">
                                                <th width="75" class="text-xs font-semibold text-center py-1 border border-black">
                                                    Code</th>
                                                <th width="300" class="text-xs font-semibold text-center py-1 border border-black">
                                                    Description</th>
                                                <th width="30" class="text-xs font-semibold text-center py-1 border border-black">
                                                    Lec</th>
                                                <th width="30" class="text-xs font-semibold text-center py-1 border border-black">
                                                    Lab</th>
                                                <th width="30" class="text-xs font-semibold text-center py-1 border border-black">
                                                    Units</th>
                                                <th width="135" class="text-xs font-semibold text-center py-1 border border-black">
                                                    Pre-requisite</th>
                                            </tr>
                                            <?php
                                            foreach ($subjectReturn as $subject) {
                                                ?>

                                                <tr>
                                                    <td class="text-xs text-center p-1 border border-black bg-yellow-300/10"><?= $subject['subjectCode'] ?></td>
                                                    <td class="text-xs text-center p-1 border border-black bg-yellow-300/10">
                                                        <?= $subject['subjectDesc'] ?>
                                                    </td>
                                                    <td class="text-xs text-center p-1 border border-black bg-yellow-300/10"><?= $subject['subjectLec'] ?></td>
                                                    <td class="text-xs text-center p-1 border border-black bg-yellow-300/10"><?= $subject['subjectLab'] ?></td>
                                                    <td class="text-xs text-center p-1 border border-black bg-yellow-300/10"><?= $subject['subjectUnit'] ?> </td>
                                                    <td class="text-xs text-center p-1 border border-black bg-yellow-300/10"><?= $subject['subjectPreq'] ?></td>
                                                </tr>

                                                <?php
                                            }
                                            ?>

                                        </table>
                                    </div>

                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>

                </div>

                <div class="border border-gray-100 shadow rounded my-3 mb-9 mx-1 p-5 relative w-full">
                    <span
                        class="absolute border border-gray-100 shadow rounded text-sm top-0 -translate-y-3 left-2 bg-white px-1">
                        Curriculum Electives:
                    </span>

                    <div id="electiveDivisor" class="w-full grid md:grid-cols-2 gap-4">
                        <?php
                        if (sizeof($electives) > 0) {
                            foreach ($electives as $elective) {
                                $subjectReturn = [];
                                foreach ($eSubjects as $eSubject) {
                                    if ($eSubject['elective_name'] == $elective['elective_name']) {
                                        $subjectReturn[] = $eSubject;
                                    }
                                }
                                if (sizeof($subjectReturn) > 0) {
                                    ?>

                                    <div class="p-2 shadow bg-gray-100/30">
                                        <div class="text-sm font-medium text-center"><?= "{$elective['elective_name']}" ?></div>
                                        <table width="600" class="w-full">
                                            <tr class="bg-gray-200">
                                                <th width="75" class="text-xs font-semibold text-center py-1 border border-black">
                                                    Code</th>
                                                <th width="300" class="text-xs font-semibold text-center py-1 border border-black">
                                                    Description</th>
                                                <th width="30" class="text-xs font-semibold text-center py-1 border border-black">
                                                    Lec</th>
                                                <th width="30" class="text-xs font-semibold text-center py-1 border border-black">
                                                    Lab</th>
                                                <th width="30" class="text-xs font-semibold text-center py-1 border border-black">
                                                    Units</th>
                                                <th width="135" class="text-xs font-semibold text-center py-1 border border-black">
                                                    Pre-requisite</th>
                                            </tr>
                                            <?php
                                            foreach ($subjectReturn as $subject) {
                                                ?>

                                                <tr>
                                                    <td class="text-xs text-center p-1 border border-black bg-yellow-300/10"><?= $subject['code'] ?></td>
                                                    <td class="text-xs text-center p-1 border border-black bg-yellow-300/10">
                                                        <?= $subject['description'] ?>
                                                    </td>
                                                    <td class="text-xs text-center p-1 border border-black bg-yellow-300/10"><?= $subject['lec'] ?></td>
                                                    <td class="text-xs text-center p-1 border border-black bg-yellow-300/10"><?= $subject['lab'] ?></td>
                                                    <td class="text-xs text-center p-1 border border-black bg-yellow-300/10"><?= $subject['units'] ?>
                                                    </td>
                                                    <td class="text-xs text-center p-1 border border-black bg-yellow-300/10"><?= $subject['preq'] ?></td>
                                                </tr>

                                                <?php
                                            }
                                            ?>

                                        </table>
                                    </div>

                                    <?php
                                }
                            }
                        } else {
                            ?>
                            <div class="w-full text-center text-gray-400 col-span-2">No Electives for this Curriculum</div>
                            <?php
                        }
                        ?>
                    </div>

                </div>

                <div class="flex w-full justify-between">
                    <input type="submit" name="submit" value="Add Curriculum" id="submit" hidden disabled
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                    <input type="button" value="Review & Submit" id="reviewBtn" data-modal-target="reviewCurriculum"
                        data-modal-toggle="reviewCurriculum" hidden disabled
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                </div>

            </form>

        </div>
    </div>



    <!-- Modal toggle -->

    <!-- Main modal -->
    <div id="reviewCurriculum" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-hidden overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 justify-center items-center w-full h-full max-h-full">
        <div class="relative p-4 w-full max-w-5xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900" id="modalHeader">
                        Oops!!
                    </h3>
                </div>
                <!-- Modal body -->
                <div id="modalBody" class="p-4 md:p-5 space-y-4 overflow-y-auto max-h-96">
                    <div class="my-3 mx-2 pb-3 border-b border-b-black">
                        <div class="font-medium text-lg text-contrast mb-1">Basic Information:</div>
                        <div class="mx-2 text-contrast leading-relaxed">Name: </div>
                        <div class="mx-2 text-contrast leading-relaxed">Year Effective: </div>
                        <div class="mx-2 text-contrast leading-relaxed">Department:</div>
                    </div>

                    <div class="my-3 mx-2 pb-3 grid lg:grid-cols-2 gap-6">
                        <div class="shadow rounded">
                            <div class="py-1 text-center font-medium text-sm">
                                1st Year - 1st Semester
                            </div>
                            <div class="p-1">
                                <table width="650" class="w-full">
                                    <tr class="bg-gray-100 text-sm lg:text-xs text-center py-1 border-b">
                                        <th width="100" class="border-r border-l font-medium">Code</th>
                                        <th width="300" class="border-r border-l font-medium">Description</th>
                                        <th width="50" class="border-r border-l font-medium">Lec</th>
                                        <th width="50" class="border-r border-l font-medium">Lab</th>
                                        <th width="50" class="border-r border-l font-medium">Units</th>
                                        <th width="100" class="border-r border-l font-medium">Pre-requisite</th>
                                    </tr>
                                    <tr class="text-sm lg:text-xs text-center py-1 border-b">
                                        <td class="leading-relaxed">BEM111</td>
                                        <td class="leading-relaxed">Logic Circuits and Design</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">BEM111, BEM111, BEM111</td>
                                    </tr>
                                    <tr class="text-sm lg:text-xs text-center py-1 border-b">
                                        <td class="leading-relaxed">BEM111</td>
                                        <td class="leading-relaxed">Logic Circuits and Design</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">BEM111, BEM111, BEM111</td>
                                    </tr>
                                    <tr class="text-sm lg:text-xs text-center py-1 border-b">
                                        <td class="leading-relaxed">BEM111</td>
                                        <td class="leading-relaxed">Logic Circuits and Design</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">BEM111, BEM111, BEM111</td>
                                    </tr>
                                    <tr class="text-sm lg:text-xs text-center py-1 border-b">
                                        <td class="leading-relaxed">BEM111</td>
                                        <td class="leading-relaxed">Logic Circuits and Design</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">BEM111, BEM111, BEM111</td>
                                    </tr>
                                    <tr class="text-sm lg:text-xs text-center py-1 border-b">
                                        <td class="leading-relaxed">BEM111</td>
                                        <td class="leading-relaxed">Logic Circuits and Design</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">BEM111, BEM111, BEM111</td>
                                    </tr>
                                    <tr class="text-sm lg:text-xs text-center py-1 border-b">
                                        <td class="leading-relaxed">BEM111</td>
                                        <td class="leading-relaxed">Logic Circuits and Design</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">BEM111, BEM111, BEM111</td>
                                    </tr>
                                    <tr class="text-sm lg:text-xs text-center py-1 border-b">
                                        <td class="leading-relaxed">BEM111</td>
                                        <td class="leading-relaxed">Logic Circuits and Design</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">BEM111, BEM111, BEM111</td>
                                    </tr>
                                    <tr class="text-sm lg:text-xs text-center py-1 border-b">
                                        <td class="leading-relaxed">BEM111</td>
                                        <td class="leading-relaxed">Logic Circuits and Design</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">2</td>
                                        <td class="leading-relaxed">BEM111, BEM111, BEM111</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="p-5 shadow"></div>
                    </div>

                    <p class="hidden text-base leading-relaxed text-gray-500">
                        Looks like someone got caught using Inspect Element. Hmmmm?
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b gap-4" id="modalFooter">
                    <button data-modal-hide="reviewCurriculum" type="button" id="submitModal"
                        class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Submit
                    </button>
                    <button data-modal-hide="reviewCurriculum" type="button" id="closeModal"
                        class="text-red-600 bg-white hover:bg-red-600 border border-red-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>



    <div id="popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-login max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow ">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    
                    <h3 class="mb-5 mt-10 text-lg font-normal text-gray-500">Are you
                        sure you want to delete this product?</h3>
                    <a href="/curriculums/delete/<?= preg_replace('/[\s-]+/', '_', $curriculum['name']) ?>"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </a>
                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No,
                        cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- script starts here -->
    <script>
        let name = document.getElementById('name');
        let year = document.getElementById('year');
        let dept = document.getElementById('dept');

        name.readOnly = true;
        year.readOnly = true;
        dept.readOnly = true;
    </script>
    <!-- script ends here -->

</body>

</html>