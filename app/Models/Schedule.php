<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;


    protected $fillable = [
        'discScheduleContentId',
        'disciplineName',
        'studyTimeName',
        'studyTimeBegin',
        'studyTimeEnd',
        'scheduleDate',
        'cabinetNumber',
        'positionName',
        'positionShortName',
        'empFullName',
        'lastName',
        'firstName',
        'middleName',
        'subgroupName',
        'contentNotes',
        'studyTypeName'
    ];
}
