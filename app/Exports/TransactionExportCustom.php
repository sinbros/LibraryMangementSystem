<?php

namespace App\Exports;

use App\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionExportCustom implements FromCollection, WithHeadings, WithMapping
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
        return Transaction::whereIn('id',$this->_data)->get();
    }

    public function map($row):array{
        if($row->status=="3")
        {
            $status="Pending";
        }
        else
        {
            $status="Complete";
        }
    	$fields=[
    		$row->id,
    		$row->accession->book->book_id,
    		$row->accession->accession_no,
    		$row->accession->book->book_name,
    		$row->student->student_id,
            $row->student->student_name,
            $row->student->college->college_name,
            $row->student->department->department_name,
            $row->student->student_contact,
            $row->from_date,
            $row->to_date,
            $row->actual_return_date,
            $status,
            $row->issued_by,
            $row->taken_by,
    		$row->created_at,
    		$row->updated_at,
    	];
    	return $fields;
    }
    public function headings(): array
    {
    	return [
    		'Transaction ID',
            'Book ID',
            'Accession No',
            'Book Name',
            'Student ID',
            'Student Name',
            'College Name',
            'Department Name',
            'Student Contact',
            'Transaction From Date',
            'Transaction To Date',
            'Transaction Actual Return Date',
            'Transaction Status',
            'Transaction Issued By',
            'Transaction Taken By',
            'Created At',
            'Updated At',
    	];
    }
}
