<?php

namespace App\Exports;

use App\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Book::all();
    }

    public function map($row):array{
    	$fields=[
    		$row->id,
    		$row->book_name,
    		$row->category->category_name,
            $row->author->author_name,
            $row->publisher->publisher_name,
    		$row->book_edition,
    		$row->book_description,
    		$row->book_price,
    		$row->created_at,
    		$row->updated_at,
    	];
    	return $fields;
    }
    public function headings(): array
    {
    	return [
    		'ID',
            'Book Name',
            'Book Catagory',
            'Book Author',
            'Book Publisher',
            'Book Edition',
            'Book Description',
            'Book Price',
            'Created At',
            'Updated At',
    	];
    }
}
