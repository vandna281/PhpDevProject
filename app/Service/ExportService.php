<?php
namespace App\Service;

use App\Models\Student;
use App\Models\ExportHistory;

Class ExportService {

    public function exportSelectedStudents($selectedIds, $exportAll) {
        $students = $this->getStudents($selectedIds);
        if (count($students) > 0) {
            $writeResult = $this->writeDatatoFile($students, $exportAll);
            if ($writeResult == true) {
            	$this->saveHistory($selectedIds);
            }
        } else {
            var_dump("No result found!");
        }
    }

    protected function writeDatatoFile($students, $exportAll) {
        if ($exportAll == 1) {
            $fh = fopen('../All_student.csv', 'w') or die('Cannot open the file');
        } else {
            $fh = fopen('../Selected_student.csv', 'w') or die('Cannot open the file');
        }
        $header = implode(";", array("Forename", "Surname", "Email", "University", "Course"));
        fwrite($fh, $header);
        fwrite($fh, "\n");
        foreach ($students as $key => $value) {
            foreach ($value->getAttributes() as $col => $colval) {
                fwrite($fh, $colval);
                fwrite($fh, ";");
            }
            fwrite($fh, "\n");
        }
        fclose($fh);

        return true;
    }

    protected function getStudents($selectedIds) {
        if (!empty($selectedIds)) {
            $students = Student::join('course', 'course.id', '=', 'student.course_id')->whereIn('student.id', $selectedIds)->select('student.firstname', 'student.surname', 'student.email', 'course.university', 'course.course_name')->get();
        } else {
            $students = Student::join('course', 'course.id', '=', 'student.course_id')->select('student.firstname', 'student.surname', 'student.email', 'course.university', 'course.course_name')->get();
        }

        return $students;
    }

    protected function saveHistory($selectedIds) {
        $historyObj = new ExportHistory();
        $historyObj->exported_ids = implode(",", $selectedIds);
        $historyObj->save();
    }

    public function getExportHistory() {
        $history = ExportHistory::all();
        if (count($history) > 0) {
            foreach ($history as $key => $value) {
                $histData = ($value->getAttributes());
                $emailList = "";
                $emails = Student::whereIn('id', explode(",", $histData["exported_ids"]))->get(['email']);
                foreach ($emails as $keyemail => $email) {
                    $emailList = $emailList . $email->getAttributes() ["email"] . ", ";
                }
                $value->setEmailListAttribute($emailList);
            }
        }

        return $history;
    }

}
