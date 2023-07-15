<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Schedule
 *
 * @property int $id
 * @property string $disciplineName
 * @property string $studyTimeName
 * @property string $studyTimeBegin
 * @property string $studyTimeEnd
 * @property string $scheduleDate
 * @property string|null $cabinetNumber
 * @property string $positionName
 * @property string $positionShortName
 * @property string $empFullName
 * @property string $lastName
 * @property string $firstName
 * @property string $middleName
 * @property string|null $subgroupName
 * @property string|null $contentNotes
 * @property string $studyTypeName
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCabinetNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereContentNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereDisciplineName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereEmpFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule wherePositionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule wherePositionShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereScheduleDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereStudyTimeBegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereStudyTimeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereStudyTimeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereStudyTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereSubgroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereUpdatedAt($value)
 * @method static \Database\Factories\ScheduleFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 */
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
