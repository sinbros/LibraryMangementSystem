<?php

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentExportCustom implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $_data = null;
    
    public function __construct($data) {
       $this->_data = $data;
    }

    public function collection()
    {
        return Student::whereIn('id',$this->_data)->get();
    }

    public function map($row):array{
        if($row->student_status=="1")
        {
            $status="Active";
        }
        else
        {
            $status="Deactive";
        }
    	$fields=[
    		$row->student_id,
    		$row->student_name,
    		$row->student_gender,
    		$row->student_dob,
    		$row->student_contact,
            $row->student_email,
    		$row->college->college_name,
    		$row->department->department_name,
    		$row->batch->batch_name,
            $status,
    		$row->created_at,
    		$row->updated_at,
    	];

    	return $fields;
    }
    public function headings(): array
    {
    	return [
    		'ID',
            'Name',
            'Gender',
            'DOB',
            'Contact',
            'Email',
            'College',
            'Department',
            'Batch',
            'Status',
            'Created At',
            'Updated At',
    	];
    }
}
