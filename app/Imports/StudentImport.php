<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $_college = null;
    protected $_department = null;
    protected $_batch = null;
    
    public function __construct($college,$department,$batch) {
       $this->_college = $college;
       $this->_department = $department;
       $this->_batch = $batch;
    }

    public function model(array $row)
    {
        return new Student([
            'student_id' => $row['student_id'],
            'student_name' => $row['student_name'],
            'student_gender' => $row['student_gender'],
            'student_dob' => $row['student_dob'],
            'student_contact' => $row['student_contact'],
            'student_email' => $row['student_email'],
            'student_college_id' => $this->_college,
            'student_department_id' => $this->_department,
            'student_batch_id' => $this->_batch,
            'student_status' => '2'
        ]);
    }
}
