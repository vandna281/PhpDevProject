<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\ExportHistory;
use App\Service\ExportService;
use Bueltge\Marksimple\Marksimple;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExportSelected;

class ExportController extends Controller
{
    public function __construct()
    {
        // Only to test in the browser api auth
        Auth::loginUsingId(1);
    }

    public function welcome()
    {
        $ms = new Marksimple();

        return view('hello', [
            'content' =>  $ms->parseFile('../README.md'),
        ]);
    }

    /**
     * View all students found in the database
     */
    public function viewStudents()
    {
        $students = Student::with('course')->get();

        return view('view_students', compact(['students']));
    }

    /**
     * Exports selected students data to a CSV file
     */
    public function export(ExportSelected $request, ExportService $expSvc)
    {
        $selectedIds = $request->input("studentId");

        $expSvc->exportSelectedStudents($selectedIds,0);
        var_dump("Selected students exported in file Selected_student.csv");
    }  

    /**
     * Exports all student data to a CSV file
     */
    public function exportStudentsToCSV()
    {
        $expSvc->exportSelectedStudents("",1);
    }

    public function viewExportHistory()
    {
        $history = $expSvc->getExportHistory();

        return view('view_history', compact(['history']));
    }

    /**
     * Exports the total number of students that are taking each course to a CSV file
     */
    public function exportCourseAttendenceToCSV()
    {
        //
    }

    /** Optional **/

    /**
     * View all students found in the database
     */
    public function viewStudentsWithVue()
    {
        $students = Student::with('courses')->get();

        return view('view_students_vue', compact(['students']));
    }

    /**
     * Exports all student data to a CSV file
     */
    public function exportStudentsToCsvWithVue()
    {
        //
    }

    /**
     * Exports the total amount of students that are taking each course to a CSV file
     */
    public function exportCourseAttendenceToCsvWithVue()
    {
        //
    }
}
