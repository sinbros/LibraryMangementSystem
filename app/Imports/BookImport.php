<?php

namespace App\Imports;

use App\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Book([
            'book_name' => $row['book_name'],
            'book_category_id' => $row['book_category_id'],
            'book_author_id' => $row['book_author_id'],
            'book_publisher_id' => $row['book_publisher_id'],
            'book_edition' => $row['book_edition'],
            'book_description' => $row['book_description'],
            'book_price' => $row['book_price'],
            'book_total_qty' => $row['book_total_qty'],
            'book_current_qty' => $row['book_current_qty'],
            'book_status' => $row['book_status']
        ]);
    }
}
