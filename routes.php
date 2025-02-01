<?php

$router->get("/", "controllers/index.php");

//routes for admin <-- STARTS HERE -->
$router->get("/faculty", "controllers/admin/faculty.php");
$router->get("/advisers", "controllers/admin/advisers.php");
$router->get("/advisers/{uniqueId}", "controllers/admin/advisers-list.php");
$router->get("/curriculums", "controllers/admin/curriculums.php");
$router->get("/archives", "controllers/admin/archives.php");
$router->get("/curriculums/{curriculum}", "controllers/admin/curriculum.php");
$router->get("/myaccount/admin/password", "controllers/admin/myaccount.php");

$router->get("/add/faculty", "controllers/admin/add-faculty.php");
$router->get("/add/curriculum", "controllers/admin/add-curriculum.php");
$router->post("/add/curriculum", "controllers/admin/add-curriculum.php");
//routes for admin <-- ENDS HERE -->



//routes for adviser <-- STARTS HERE -->
$router->get("/students", "controllers/adviser/adviser.php");
$router->get("/students/curriculum", "controllers/adviser/static-curriculum.php");
$router->get("/students/{studentId}", "controllers/adviser/student.php");
$router->get("/myaccount/adviser/profile", "controllers/adviser/myaccount.php");
$router->get("/myaccount/adviser/password", "controllers/adviser/myaccount.php");

$router->get("/add/student", "controllers/adviser/add-student.php");
$router->post("/students/{studentId}/update/subjects", "controllers/adviser/update-student-subjects.php");
//routes for adviser <-- ENDS HERE -->



//common routes <-- STARTS HERE -->
$router->get("/login", "controllers/login.php");
//common routes <-- STARTS HERE -->


// //routes for add-curriculum <-- STARTS HERE -->
// $router->get("/ac/style", "ac/style.css");
// $router->get("/ac/script", "ac/script.js");
// $router->get("/ac/saveQueueData", "ac/saveQueueData.php");
// $router->get("/ac/search", "ac/search.php");
// $router->get("/ac/dbconn", "ac/dbcon.php");
// //routes for add-curriculum <-- ENDS HERE -->


//actions <-- STARTS HERE -->
$router->post("/login", "controllers/auth/login.php");
$router->get("/logout", "controllers/auth/logout.php");
$router->post("/action/add", "controllers/add.php");
$router->post("/action/edit", "controllers/edit.php");
$router->get("/curriculums/delete/{curriculum}", "controllers/action/update/delete-curriculum.php");
$router->post("/update/grades", "controllers/action/update/update-student-grades.php");
$router->post("/update/subjects", "controllers/action/update/update-student-subjects.php");
$router->get("/update/readvise", "controllers/action/update/update-student-readvise.php");
//actions <-- ENDS HERE -->



//Request <-- STARTS HERE -->
$router->get("/request/curriculums", "controllers/action/request/getCurriculums.php");
$router->get("/request/advisees", "controllers/action/request/getAdvisees.php");
$router->post("/request/studentSubjects", "controllers/action/request/getStudentTable.php");
$router->post("/request/getPreviousSubjects", "controllers/action/request/getPreviousSubjects.php");
//Request <-- ENDS HERE -->





$router->get("/img", "public/img/");
$router->get("/js", "public/js/");
$router->get("/css", "public/css/");