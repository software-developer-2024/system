<?php require 'partials/head.php'; ?>

</head>

<body class="coe">
    <div class="w-dynamic h-mobile bg-neutral">
        <div class="flex w-full h-mobile overflow-y-auto overflow-x-hidden">
            <div class="w-1/6 hidden sm:block relative">
                <!-- <a href="" class="text-neutral text-3xl bg-transparent fixed w-inherit h-mobile flex justify-center items-center hover:bg-white/30 hover:text-contrast/60"> < </a> -->
            </div>







            <div class="flex-1 p-2">
                <div class="pb-4">
                    <a href="<?= $_SESSION['location'] ?? '/' ?>" data-tooltip-target="go-back"
                        data-tooltip-placement="right"
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
                        <p class="mb-2 me-3 text-red-600">Student ID: <span
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
                        </div> -->
                        <?php if ($submitUri == '/update/grades') { ?>
                            <div class="text-end">
                                <a href="/update/readvise?id=<?= $student['studentId'] ?>&yearlvl=<?= $year ?>&semester=<?= $semester ?>"
                                    class="bg-red-600 hover:bg-red-800 py-1 px-2 text-white rounded text-nowrap">
                                    Re-advise Student
                                </a>
                            </div>
                        <?php } ?>
                    </div>

                </div>


                <div class="flex w-full bg-white shadow-lg rounded-sm border border-gray-200">
                    <div class="flex-1">
                        <div id="yearDivisor" class="w-full">
                            <form action="<?= $submitUri ?>" method="post">
                                <input type="text" name="year" id="year" value="<?= $year ?>" hidden>
                                <input type="text" name="semester" id="semester" value="<?= $semester ?>" hidden>
                                <input type="text" name="studentId" id="studentId" value="<?= $student['studentId'] ?>"
                                    hidden>
                                <div class="px-3 pt-3 pb-6 shadow bg-white w-full text-right">
                                    <div
                                        class="text-lg flex flex-row-reverse w-full justify-between text-center px-3 pb-2 pt-0">
                                        <?php
                                        $yearlvl = $year;
                                        $academicYear = explode("-", $student['batch']);
                                        $startYear = $academicYear[0];
                                        $endYear = $academicYear[1];

                                        switch ($yearlvl) {
                                            case '1':
                                                $startYear = $academicYear[0];
                                                $endYear = $academicYear[1];
                                                $yearlvl = "{$yearlvl}ST YEAR";
                                                break;

                                            case '2':
                                                # code...
                                                $yearlvl = "{$yearlvl}ND YEAR";
                                                break;

                                            case '3':
                                                # code...
                                                $yearlvl = "{$yearlvl}RD YEAR";
                                                break;

                                            default:
                                                $yearlvl = "{$yearlvl}TH YEAR";
                                                break;
                                        }

                                        $sem = $semester;

                                        switch ($sem) {
                                            case '0':
                                                # code...
                                                $sem = "1ST SEMESTER";
                                                break;

                                            case '1':
                                                # code...
                                                $sem = "2ND SEMESTER";
                                                break;

                                            case '2':
                                                # code...
                                                $sem = "SUMMER";
                                                break;
                                        }

                                        ?>
                                        <div class="font-semibold"><?= "{$yearlvl} - {$sem}" ?></div>
                                        <div class="font-semibold"><?= "A.Y. {$startYear} - {$endYear}" ?></div>
                                    </div>
                                    <table width="800" class="w-full">
                                        <tr class="bg-contrast text-primary">
                                            <th width="75" class="font-semibold text-center py-1 border border-black">
                                                Code</th>
                                            <th width="300" class="font-semibold text-center py-1 border border-black">
                                                Description</th>
                                            <th width="45" class="font-semibold text-center py-1 border border-black">
                                                Units</th>
                                            <th width="100" class="font-semibold text-center py-1 border border-black">
                                                <?= ($submitUri == '/update/grades') ? 'GRADES' : '' ?>
                                            </th>
                                            <th width="235" class="font-semibold text-center py-1 border border-black">
                                                Remarks</th>
                                        </tr>
                                        <?php
                                        $count = 0;
                                        foreach ($subjects as $subject) {
                                            ?>

                                            <tr class="bg-yellow-100/10">
                                                <td class="text-xs text-center p-1 border border-black">
                                                    <input class="focus:outline-none text-center" type="text"
                                                        name="subjectCode<?= $count ?>" id="subjectCode"
                                                        value="<?= $subject['code'] ?>" readonly>

                                                    <input class="focus:outline-none text-center" type="text"
                                                        name="subjectId<?= $count ?>" id="subjectId"
                                                        value="<?= $subject['id'] ?>" readonly hidden>

                                                </td>
                                                <td class="text-xs text-center p-1 border border-black">
                                                    <?= $subject['description'] ?>
                                                </td>
                                                <td class="text-xs text-center p-1 border border-black">
                                                    <?= $subject['units'] ?>
                                                </td>
                                                <td class="text-xs text-center p-1 border border-black relative">
                                                    <?php
                                                    switch ($submitUri) {
                                                        case '/update/grades':
                                                            $inc = ['INC', 'INC / 1.0', 'INC / 1.25', 'INC / 1.50', 'INC / 1.75', 'INC / 2.0', 'INC / 2.25', 'INC / 2.50', 'INC / 2.75', 'INC / 3.0', 'INC / 5.0'];
                                                            if (in_array($subject['grade'], $inc)) {
                                                                ?>

                                                                <select name="subjectGrades<?= $count ?>" id="grades"
                                                                    class="py-1 w-full text-center border border-black" require>
                                                                    <option value="" <?= $subject['grade'] == '' ? 'selected' : '' ?>>N/A
                                                                    </option>
                                                                    <option value="INC / 1.0" <?= $subject['grade'] == 'INC / 1.0' ? 'selected' : '' ?>>INC / 1.0</option>
                                                                    <option value="INC / 1.25" <?= $subject['grade'] == 'INC / 1.25' ? 'selected' : '' ?>>INC / 1.25</option>
                                                                    <option value="INC / 1.50" <?= $subject['grade'] == 'INC / 1.50' ? 'selected' : '' ?>>INC / 1.50</option>
                                                                    <option value="INC / 1.75" <?= $subject['grade'] == 'INC / 1.75' ? 'selected' : '' ?>>INC / 1.75</option>
                                                                    <option value="INC / 2.0" <?= $subject['grade'] == 'INC / 2.0' ? 'selected' : '' ?>>INC / 2.0</option>
                                                                    <option value="INC / 2.25" <?= $subject['grade'] == 'INC / 2.25' ? 'selected' : '' ?>>INC / 2.25</option>
                                                                    <option value="INC / 2.50" <?= $subject['grade'] == 'INC / 2.50' ? 'selected' : '' ?>>INC / 2.50</option>
                                                                    <option value="INC / 2.75" <?= $subject['grade'] == 'INC / 2.75' ? 'selected' : '' ?>>INC / 2.75</option>
                                                                    <option value="INC / 3.0" <?= $subject['grade'] == 'INC / 3.0' ? 'selected' : '' ?>>INC / 3.0</option>
                                                                    <option value="INC / 5.0" <?= $subject['grade'] == 'INC / 5.0' ? 'selected' : '' ?>>INC / 5.0</option>
                                                                    <option value="1.0" <?= $subject['grade'] == '1.0' ? '' : '' ?>>1.0
                                                                    </option>
                                                                    <option value="1.25" <?= $subject['grade'] == '1.25' ? '' : '' ?>>1.25
                                                                    </option>
                                                                    <option value="1.50" <?= $subject['grade'] == '1.50' ? '' : '' ?>>1.50
                                                                    </option>
                                                                    <option value="1.75" <?= $subject['grade'] == '1.75' ? '' : '' ?>>1.75
                                                                    </option>
                                                                    <option value="2.0" <?= $subject['grade'] == '2.0' ? '' : '' ?>>2.0
                                                                    </option>
                                                                    <option value="2.25" <?= $subject['grade'] == '2.25' ? '' : '' ?>>2.25
                                                                    </option>
                                                                    <option value="2.50" <?= $subject['grade'] == '2.50' ? '' : '' ?>>2.50
                                                                    </option>
                                                                    <option value="2.75" <?= $subject['grade'] == '2.75' ? '' : '' ?>>2.75
                                                                    </option>
                                                                    <option value="3.0" <?= $subject['grade'] == '3.0' ? '' : '' ?>>3.0
                                                                    </option>
                                                                    <option value="5.0" <?= $subject['grade'] == '5.0' ? '' : '' ?>>5.0
                                                                    </option>
                                                                    <option value="INC" <?= $subject['grade'] == 'INC' ? 'selected' : '' ?>>INC</option>
                                                                    <option value="UW" <?= $subject['grade'] == 'UW' ? '' : '' ?>>
                                                                        UW</option>
                                                                    <option value="AW" <?= $subject['grade'] == 'AW' ? '' : '' ?>>
                                                                        AW</option>
                                                                    <option value="DG" <?= $subject['grade'] == 'DG' ? '' : '' ?>>
                                                                        DG</option>
                                                                </select>

                                                                <?php
                                                            } else {
                                                                ?>
                                                                <select name="subjectGrades<?= $count ?>" id="grades"
                                                                    class="py-1 w-full text-center border border-black" require>
                                                                    <option value="" <?= $subject['grade'] == '' ? 'selected' : '' ?>>N/A
                                                                    </option>
                                                                    <option value="1.0" <?= $subject['grade'] == '1.0' ? 'selected' : '' ?>>
                                                                        1.0
                                                                    </option>
                                                                    <option value="1.25" <?= $subject['grade'] == '1.25' ? 'selected' : '' ?>>1.25</option>
                                                                    <option value="1.50" <?= $subject['grade'] == '1.50' ? 'selected' : '' ?>>1.50</option>
                                                                    <option value="1.75" <?= $subject['grade'] == '1.75' ? 'selected' : '' ?>>1.75</option>
                                                                    <option value="2.0" <?= $subject['grade'] == '2.0' ? 'selected' : '' ?>>2.0</option>
                                                                    <option value="2.25" <?= $subject['grade'] == '2.25' ? 'selected' : '' ?>>2.25</option>
                                                                    <option value="2.50" <?= $subject['grade'] == '2.50' ? 'selected' : '' ?>>2.50</option>
                                                                    <option value="2.75" <?= $subject['grade'] == '2.75' ? 'selected' : '' ?>>2.75</option>
                                                                    <option value="3.0" <?= $subject['grade'] == '3.0' ? 'selected' : '' ?>>3.0</option>
                                                                    <option value="5.0" <?= 
                                                                    $subject['grade'] == '5.0' ? 'selected' : '' 
                                                                    ?>>5.0</option>
                                                                    <option value="INC" <?= $subject['grade'] == 'INC' ? 'selected' : '' ?>>INC</option>
                                                                    <option value="UW" <?= $subject['grade'] == 'UW' ? 'selected' : '' ?>>
                                                                        UW</option>
                                                                    <option value="AW" <?= $subject['grade'] == 'AW' ? 'selected' : '' ?>>
                                                                        AW</option>
                                                                    <option value="DG" <?= $subject['grade'] == 'DG' ? 'selected' : '' ?>>
                                                                        DG</option>
                                                                </select>

                                                                <?php

                                                            }
                                                            break;

                                                        default:
                                                            ?>

                                                            <input type="button" id="remove" value="Remove"
                                                                class="bg-red-600 hover:bg-red-800 text-white px-2 py-1 rounded">
                                                            <input type="button" id="take" value="Take"
                                                                class="bg-green-500 hover:bg-green-800 text-white px-2 py-1 rounded">

                                                            <input type="text" id="subjectAction" name="subjectAction<?= $count ?>"
                                                                class="px-2 py-1 rounded">

                                                            <?php
                                                            break;
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-xs text-center p-1 border border-black">
                                                    <textarea name="subjectRemarks<?= $count ?>" id="txtArea" class="h-full w-full border border-black text-lg flex px-5" rows="1"><?= trim($subject['remarks']) ?></textarea>
                                                </td>
                                            </tr>

                                            <?php

                                            $count++;
                                        }
                                        ?>

                                    </table>
                                    <input type="text" name="subjectCount" id="count" value="<?= $count ?>" hidden>

                                    <input type="submit" name="submit" value="Submit"
                                        class="bg-primary/80 hover:bg-primary/60 text-contrast py-1 w-full sm:w-1/4 mt-6 rounded">

                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>





            <div class="w-1/6 hidden sm:block relative">
                <!-- <a href="" class="text-neutral text-3xl bg-transparent fixed w-inherit h-mobile flex justify-center items-center hover:bg-white/30 hover:text-contrast/60"> > </a> -->
            </div>


        </div>


        <script src="<?= js("update-student-subjects.js") ?>"></script>

</body>

</html>