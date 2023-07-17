@php
$num = 1;
@endphp

@for($i = 0; $i < count($lessons); $i++)
    @php
        $lesson = $lessons[$i];
        $time_start = \Carbon\Carbon::createFromFormat('H:i:s', $lesson->studyTimeBegin)->format('H:i');
        $time_end = \Carbon\Carbon::createFromFormat('H:i:s', $lesson->studyTimeEnd)->format('H:i');
    @endphp



    @php

                // Check if there is a next lesson
                $nextLesson = isset($lessons[$i + 1]) ? $lessons[$i + 1] : null;

                if ($nextLesson) {
                    $nextLessonStartTime = \Carbon\Carbon::createFromFormat('H:i:s', $nextLesson->studyTimeBegin);
                    $currentLessonEndTime = \Carbon\Carbon::createFromFormat('H:i:s', $lesson->studyTimeEnd);

                    // Calculate the duration between the current lesson and the next lesson
                    $breakDuration = $currentLessonEndTime->diffInMinutes($nextLessonStartTime);

                }
    @endphp
    @if($nextLesson && $nextLesson->studyTimeBegin != $lesson->studyTimeBegin)
        {{$num}}. {{$time_start}} - {{$time_end}} ({{$breakDuration}} мин)
        <b>{{$lesson->studyTypeName}}:</b> {{$lesson->disciplineName}}
        Преподаватель: {{$lesson->lastName}} {{substr($lesson->firstName, 0, 1)}}.{{substr($lesson->middleName, 0, 1)}}.
        <br>
        @php
            $num++;
        @endphp
    @endif
    @if(!$nextLesson)
        {{$num}}. {{$time_start}} - {{$time_end}}
        <b>{{$lesson->studyTypeName}}:</b> {{$lesson->disciplineName}}
        Преподаватель: {{$lesson->lastName}} {{substr($lesson->firstName, 0, 1)}}.{{substr($lesson->middleName, 0, 1)}}.
        <br>
        @php
            $num++;
        @endphp
    @endif
    @if($nextLesson && $nextLesson->studyTimeBegin == $lesson->studyTimeBegin)
        {{$num}}. {{$time_start}} - {{$time_end}}
        <br>
        •  {{$lesson->subgroupName}} гр.: <b>{{$lesson->studyTypeName}}:</b> {{$lesson->disciplineName}}
        Преподаватель: {{$lesson->lastName}} {{substr($lesson->firstName, 0, 1)}}.{{substr($lesson->middleName, 0, 1)}}.
        @for($a = $i; $lessons[$a+1]->studyTimeBegin == $lesson->studyTimeBegin; $a++)
            <br>
            •  {{$lessons[$a+1]->subgroupName}} гр.: <b>{{$lesson->studyTypeName}}:</b> {{$lesson->disciplineName}}
            Преподаватель: {{$lessons[$a+1]->lastName}} {{substr($lessons[$a+1]->firstName, 0, 1)}}.{{substr($lessons[$a+1]->middleName, 0, 1)}}.
        @endfor

        <br>
        @php
            $num++;
        @endphp
    @endif
@endfor





2. 13:10 - 14:30 (20 хв)
<br>
•  1 гр.: <b>Лабораторная работа:</b> Комп'ютерні числення
Преподаватель: Казнадій С.П.
<br>
•  2 гр.: <b>Лабораторная работа:</b> Алгоритми і структури даних
Преподаватель: Якименко І.В.
<br>
3. 14:50 - 16:10 (15 хв)
<br>
•  1 гр.: <b>Лабораторная работа:</b> Алгоритми і структури даних
Преподаватель: Якименко І.В.
<br>
•  2 гр.: <b>Лабораторная работа:</b> Комп'ютерні числення
Преподаватель: Казнадій С.П.
