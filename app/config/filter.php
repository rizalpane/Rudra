<?php
function filterLoginToStudent($dataToFilter)
{
    if ($dataToFilter !== 'student') {
        header("Location: ../app/config/modelLogout.php");
        exit();
    }
}

function filterLoginToTeacher($dataToFilter)
{
    if ($dataToFilter !== 'teacher') {
        header("Location: ../../app/config/modelLogout.php");
        exit();
    }
}

function minDataOnTable($numRow, $minData)
{
    if ($numRow < $minData) {
        header("Location: dashboard-student.php");
        exit();
    }
}
