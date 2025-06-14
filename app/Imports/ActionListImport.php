<?php

namespace App\Imports;

use App\Models\ActionList;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;

class ActionListImport implements WithHeadingRow, WithValidation, SkipsEmptyRows, WithBatchInserts, ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            ActionList::create([
                'date_raised' => $row['date_raised'],
                'location' => $row['location'],
                'manager' => $row['manager'],
                'status' => $row['status'],
                'improvements' => $row['improvements'],
                'date_complete' => $row['date_complete'],
                'comment' => $row['comment'],
                'comment_img' => $row['comment_img']
            ]);
        }
    }

    public function rules(): array
    {
        return [
            '*.date_raised' => 'required|date_format:Y-m-d',
            '*.location' => 'required|string|max:255',
            '*.manager' => 'required|string|max:50',
            '*.status' => 'nullable|string|max:255',
            '*.improvements' => 'required|string|max:1000',
            '*.date_complete' => 'nullable|date_format:Y-m-d',
            '*.comment' => 'nullable|string|max:1000',
            '*.comment_img' => 'nullable|url',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.date_raised.required' => 'The date raised field is required.',
            '*.date_raised.date_format' => 'The date raised must be in the format YYYY-MM-DD.',
            '*.location.required' => 'The location field is required.',
            '*.location.string' => 'The location must be a string.',
            '*.location.max' => 'The location may not be greater than 255 characters.',
            '*.manager.required' => 'The manager field is required.',
            '*.manager.string' => 'The manager must be a string.',
            '*.manager.max' => 'The manager may not be greater than 50 characters.',
            '*.status.string' => 'The status must be a string.',
            '*.status.max' => 'The status may not be greater than 255 characters.',
            '*.improvements.required' => 'The improvements field is required.',
            '*.improvements.string' => 'The improvements must be a string.',
            '*.improvements.max' => 'The improvements may not be greater than 1000 characters.',
            '*.date_complete.date_format' => 'The date complete must be in the format YYYY-MM-DD.',
            '*.comment.string' => 'The comment must be a string.',
            '*.comment.max' => 'The comment may not be greater than 1000 characters.',
            '*.comment_img.url' => 'The comment image must be a valid URL.',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 100;
    }
}
