<?php

namespace App\Exports;

use App\Models\ActionList;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ActionListExport implements WithHeadings, FromQuery, WithMapping
{
    function query()
    {
        return ActionList::query();
    }

    function headings(): array
    {
        return ['date_raised',
                'location',
                'manager',
                'improvements',
                'status',
                'date_complete',
                'comment',
                'comment_img'
                ];
    }

    function map($row): array
    {
        return [$row->date_raised,
                $row->location,
                $row->manager,
                $row->improvements,
                $row->status,
                $row->date_complete,
                $row->comment,
                $row->comment_img,
                ];
    }
}
