<?php require 'partials/head.php'; ?>

</head>

<body class="coe">
    <div class="w-dynamic h-mobile bg-neutral">
        <div class="flex w-full h-mobile overflow-y-scroll">
            <div class="w-1/6 hidden sm:block relative">
                <a href="/students/<?= $prev ?>"
                    class="text-neutral text-3xl bg-transparent fixed w-inherit h-mobile flex justify-center items-center hover:bg-white/30 hover:text-contrast/60 move-page">
                    < </a>
            </div>



            <div class="flex-1 p-2">
                <div class="pb-4">
                    <a href="/students" data-tooltip-target="go-back" data-tooltip-placement="right" id="gback"
                        class="px-3 text-2xl font-medium text-purple-600 focus:outline-none bg-white rounded shadow hover:bg-purple-300 hover:text-white focus:z-10 focus:ring-4 focus:ring-purple-300">
                        < </a>
                            <div id="go-back" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                Go Back
                            </div>
                </div>



                <div class="mb-6 flex w-full justify-center bg-white shadow-lg rounded-sm border border-gray-200">
                    <div class="m-2 border-4 border-red-600/60 hidden md:block">
                        <img src="<?= showImage("placeholder_for_image.jpg") ?>" alt="No Picture" width="100">
                    </div>
                    <div class="flex-1 m-2 text-sm flex flex-col justify-around">
                        <p class="mb-2 me-3 text-red-600">Name: <span
                                class="text-nowrap font-semibold text-contrast capitalize"><?= $studentName ?></span>
                        </p>
                        <p class="mb-2 me-3 text-red-600">Student ID: <span id="studentId"
                                class="text-nowrap font-semibold text-contrast"><?= $student['studentId'] ?></span></p>
                        <p class="mb-2 me-3 text-red-600">Contact No: <span
                                class="text-nowrap font-semibold text-contrast"><?= $student['contact'] ?></span></p>
                        <p class="mb-2 me-3 text-red-600">Email Address: <span
                                class="text-nowrap font-semibold text-contrast"><?= $student['email'] ?></span></p>

                    </div>
                    <div class="flex-1 m-2 text-sm flex flex-col justify-around">
                        <p class="mb-2 me-3 text-red-600">Batch: <span id="batch"
                                class="text-nowrap font-semibold text-contrast"><?= $student['batch'] ?></span> </p>
                        <p class="mb-2 me-3 text-red-600">Year / Level: <span
                                class="text-nowrap font-semibold text-contrast"></span></p>
                        <p class="mb-2 me-3 text-red-600">Status: <span
                                class="text-nowrap font-semibold text-contrast"><?= $student['status'] ?></span></p>
                        <!-- <div class="mb-2 sm:flex items-center">
                            <label for="electives" class="me-3 text-red-600">Electives: </label>
                            <select name="electives" id="electives" class="bg-slate-200 text-sm">
                                <option value="" class="text-gray-600">--Choose an Elective--</option>
                                <option value="Elective 1">Robotics Process Automation</option>
                                <option value="Elective 2">Software Development Track</option>
                                <option value="Elective 3">System and Network Administration</option>
                                <option value="Elective 4">Technopreneurship</option>
                            </select>
                        </div>
                        <div class="text-end"><a href="#"
                                class="bg-red-600 hover:bg-red-800 py-1 px-2 text-white rounded text-nowrap">Drop
                                Student</a></div> -->
                    </div>
                </div>
                <div class="flex-col w-full justify-center bg-white shadow-lg rounded-sm border border-gray-200">

                    <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 px-6">
                        <ul class="flex flex-wrap -mb-px">
                            <li class="me-2">
                                <button type="button" id="subjectsPageBtn"
                                    class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active pointer-events-none"
                                    aria-current="page">Subjects</button>
                            </li>
                            <li class="me-2">
                                <button type="button" id="advisingPageBtn"
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Advising</button>
                            </li>
                        </ul>
                    </div>

                    <div id="content" class="p-3 flex overflow-x-hidden gap-3">
                        <div id="subjectsPage" class="w-full min-w-full grid lg:grid-cols-2 gap-4">
                            <?php
                            $academicYear = explode("-", $student['batch']);
                            $startYear = $academicYear[0];
                            $endYear = $academicYear[1];

                            foreach ($origYears as $year) {
                                foreach ($origSemesters as $semester) {

                                    $yearDivisor = $year['year'];

                                    $termDivisor = $semester['semester'];

                                    $subjectReturn = [];
                                    foreach ($origSubjects as $subject) {

                                        if ($subject['subjectYear'] == $year['year'] && $subject['subjectSemester'] == $semester['semester']) {
                                            $subjectReturn[] = $subject;
                                        }
                                    }

                                    if (sizeof($subjectReturn) > 0) { ?>
                                        <div type="submit" class="p-3 shadow">
                                            <div
                                                class="text-sm flex flex-row-reverse w-full justify-center text-center px-3 pb-2 pt-0">
                                                <div class="font-semibold"><?= "{$yearDivisor} - {$termDivisor}" ?></div>
                                                <!-- <div class="font-semibold"><? //"A.Y. {$startYear} - {$endYear}" ?></div> -->
                                            </div>
                                            <table width="550" class="w-full">
                                                <tr class="bg-gray-800/20">
                                                    <th width="75"
                                                        class="text-xs font-semibold text-center py-1 border border-black">
                                                        Code</th>
                                                    <th width="300"
                                                        class="text-xs font-semibold text-center py-1 border border-black">
                                                        Description</th>
                                                    <th width="65"
                                                        class="text-xs font-semibold text-center py-1 border border-black">
                                                        Units</th>
                                                    <th width="110"
                                                        class="text-xs font-semibold text-center py-1 border border-black">
                                                        Status</th>
                                                </tr>
                                                <?php
                                                foreach ($subjectReturn as $subject) {
                                                    ?>

                                                    <tr class="bg-yellow-100/10">
                                                        <td class="text-xs text-center p-1 border border-black"><?= $subject['subjectCode'] ?>
                                                        </td>
                                                        <td class="text-xs text-center p-1 border border-black">
                                                            <?= $subject['subjectDesc'] ?>
                                                        </td>
                                                        <td class="text-xs text-center p-1 border border-black"><?= $subject['subjectUnit'] ?>
                                                        </td>
                                                        <td class="text-xs text-center p-1 border border-black">
                                                            <?php
                                                            $subjectStatus = $db->query("SELECT status FROM `{$studentTable}` WHERE code = '{$subject['subjectCode']}'")->fetchAll();
                                                            $statusSubjects = [];
                                                            $statusShow = '';

                                                            foreach ($subjectStatus as $status) {
                                                                $statusSubjects[] = $status['status'];
                                                            }

                                                            if (in_array("ON HOLD", $statusSubjects)) {
                                                                $statusShow = "ON HOLD";
                                                            }

                                                            if (in_array("FAILED", $statusSubjects)) {
                                                                $statusShow = "FAILED";
                                                            }

                                                            if (in_array("PASSED", $statusSubjects)) {
                                                                $statusShow = "PASSED";
                                                            }

                                                            echo $statusShow;

                                                            ?>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                }
                                                ?>

                                            </table>
                                        </div>

                                    <?php }
                                }
                                $startYear++;
                                $endYear++;
                            } ?>
                        </div>


                        <!-- <div id="advisingPage" class="w-full min-w-full hidden lg:grid-cols-2 gap-4"> -->
                        <div id="advisingPage" class="w-full min-w-full hidden">
                            <?php

                            $availability = true;
                            $hasGrades = false;
                            $currentSem = false;
                            $academicYear = explode("-", $student['batch']);
                            $startYear = $academicYear[0];
                            $endYear = $academicYear[1];

                            foreach ($years as $year) {
                                $yearDivisor = $year['year'];
                                ?>

                                <div id="YEAR_SEPARATOR" class="flex flex-col items-center my-6">
                                    <div class="flex justify-around gap-6 mb-6">
                                        <h1 class="text-2xl font-bold"> <?= $yearDivisor ?></h1>
                                        <h1 class="text-2xl font-bold"><?= "A.Y. {$startYear} - {$endYear}" ?></h1>
                                    </div>


                                    <div class="grid lg:grid-cols-2 gap-4">

                                        <?php

                                        foreach ($semesters as $semester) {

                                            if ($availability && !$hasGrades) {
                                                $currentSem = true;
                                            }

                                            $termDivisor = $semester['semester'];

                                            $subjectReturn = [];
                                            foreach ($subjects as $subject) {
                                                if ($subject['year'] == $year['year'] && $subject['semester'] == $semester['semester']) {
                                                    $subjectReturn[] = $subject;
                                                }
                                            }

                                            if (sizeof($subjectReturn) > 0) {
                                                ?>
                                                <form action="/students/<?= $student['studentId'] ?>/update/subjects" method="post"
                                                    class=" max-h-full">
                                                    <input type="text" name="year" id="year" value="<?= $year['year'] ?>" hidden>
                                                    <input type="text" name="semester" id="semester" value="<?=
                                                        $semester['semester']
                                                        ?>" hidden>
                                                    <input type="text" name="studentId" id="studentId" value="<?=
                                                        $student['studentId']
                                                        ?>" hidden>
                                                    <button type="submit"
                                                        class="px-3 pt-3  pb-6 mb-6 shadow <?= $availability ? ($currentSem ? "bg-red-300/10 hover:bg-red-100/60" : "bg-gray-100/10 hover:bg-gray-400/40") : "bg-gray-400/20 pointer-events-none" ?>"
                                                        <?= !$availability ? "disable" : "" ?>>
                                                        <div
                                                            class="text-sm flex flex-row-reverse w-full justify-between text-center px-3 pb-2 pt-0">
                                                            <div class="font-semibold"><?= "{$yearDivisor} - {$termDivisor}" ?>
                                                            </div>
                                                            <div class="font-semibold"><?= "A.Y. {$startYear} - {$endYear}" ?></div>
                                                        </div>
                                                        <table width="600" class="w-full">
                                                            <tr class="bg-gray-800/20">
                                                                <th width="150"
                                                                    class="text-xs font-semibold text-center py-1 border border-black">
                                                                    Code</th>
                                                                <th width="300"
                                                                    class="text-xs font-semibold text-center py-1 border border-black">
                                                                    Description</th>
                                                                <th width="50"
                                                                    class="text-xs font-semibold text-center py-1 border border-black">
                                                                    Units</th>
                                                                <th width="100"
                                                                    class="text-xs font-semibold text-center py-1 border border-black">
                                                                    Grade</th>
                                                            </tr>
                                                            <?php
                                                            $hasGrades = false;
                                                            $availability = false;
                                                            foreach ($subjectReturn as $subject) {
                                                                ?>

                                                                <tr class="bg-yellow-100/10">
                                                                    <td class="text-xs text-center p-1 border border-black">
                                                                        <?= $subject['code'] ?>
                                                                    </td>
                                                                    <td class="text-xs text-center p-1 border border-black">
                                                                        <?= $subject['description'] ?>
                                                                    </td>
                                                                    <td class="text-xs text-center p-1 border border-black">
                                                                        <?= $subject['units'] ?>
                                                                    </td>
                                                                    <td
                                                                        class="text-xs text-center p-1 border border-black <?= $subject['status'] == 'FAILED' ? 'text-red-600' : '' ?> relative">
                                                                        <?= $subject['grade'] ?>

                                                                        <?php
                                                                        if ($subject['remarks'] != '') {
                                                                            ?>

                                                                            <div class="absolute bg-primary text-contrast text-xs px-1 py-0 rounded-full top-0 right-0"
                                                                                data-tooltip-target="show-remarks"
                                                                                data-tooltip-placement="top">-</div>

                                                                            <div id="show-remarks" role="tooltip"
                                                                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                                                                <?= $subject['remarks'] ?>
                                                                            </div>

                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>

                                                                <?php
                                                                $subject['status'] != "Unavailable" && $subject['status'] != "PENDING" && $subject['status'] != "CANCELLED" ? $hasGrades = true : '';
                                                                ($subject['status'] == "Unavailable" || $subject['status'] == "PENDING" || $subject['status'] == "CANCELLED") ? $availability = false : $availability = true;
                                                            }
                                                            ?>

                                                        </table>
                                                    </button>
                                                </form>

                                                <?php
                                            }

                                            if ($hasGrades) {
                                                $availability = true;
                                            }


                                        }
                                        $startYear++;
                                        $endYear++;

                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>



            <div class="w-1/6 hidden sm:block relative">
                <a href="/students/<?= $next ?>"
                    class="text-neutral text-3xl bg-transparent fixed w-inherit h-mobile flex justify-center items-center hover:bg-white/30 hover:text-contrast/60 move-page">
                    > </a>
            </div>


        </div>
        <script src="<?= js('student.js') ?>"></script>

</body>

</html>