<?php

namespace Core;

use PDO;

class Database
{

    public $conn;

    public function __construct($config, $db_uname = 'root', $db_pass = '')
    {

        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->conn = new PDO($dsn, $db_uname, $db_pass, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {
        $statement = $this->conn->prepare($query);

        $statement->execute($params);

        return $statement;
    }

    public function getUserById($id)
    {
        $query = 'SELECT * FROM faculties WHERE uniqueId = ?';
        $faculty = $this->query($query, [$id])->fetch();
        return $faculty;
    }

    public function getUserByUsername($username)
    {
        $query = 'SELECT * FROM faculties WHERE username = ?';
        $faculty = $this->query($query, [$username])->fetch();
        return $faculty;
    }

    public function getUsers($username)
    {
        $query = 'SELECT * FROM faculties WHERE username = ?';
        return $this->query($query, [$username])->fetchAll();
    }

    public function user($uniqueId)
    {
        $query = 'SELECT * FROM faculties WHERE uniqueId = ?';
        $user = $this->query($query, [$uniqueId])->fetch();
        return $user;
    }

    public function getCurriculumDetailsByName($curriculum)
    {
        return $this->query("SELECT name, year, college, department  FROM curriculums WHERE name = ?", [$curriculum])->fetch();
    }

    public function getCurriculumDataByName($curriculum)
    {
        return $this->query("SELECT * FROM curriculums WHERE name = ?", [$curriculum])->fetchAll();
    }

    public function checkIfStudentIdExist($studentId)
    {
        $students = $this->query("SELECT studentId FROM students WHERE studentId = ?", [$studentId])->fetchAll();
        if (sizeof($students) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getStudentById($studentId)
    {
        return $this->query("SELECT * FROM students WHERE studentId = ?", [$studentId])->fetch();
    }

    public function getYearsToCompleteCurriculum($studentId)
    {
        $studentTable = preg_replace('/[\s-]+/', '_', $studentId);
        $years = $this->query("SELECT DISTINCT year FROM `{$studentTable}`")->fetchAll();
        return sizeOf($years);
    }

    public function getYearsShouldToCompleteCurriculum($curriculum)
    {
        // $curriculumTable = preg_replace('/[\s-]+/', '_', $curriculum);
        $years = $this->query("SELECT DISTINCT subjectYear FROM `curriculums` WHERE name = ?", [$curriculum])->fetchAll();
        return sizeOf($years);
    }

    public function close()
    {
        return $this->conn = null;
    }

}
