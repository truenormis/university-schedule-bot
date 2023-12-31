@php
    function sub($text): string
    {
        return Str::limit($text,1,'');
    }

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
                $nextLesson = $lessons[$i + 1] ?? null;

                if ($nextLesson) {
                    $nextLessonStartTime = \Carbon\Carbon::createFromFormat('H:i:s', $nextLesson->studyTimeBegin);
                    $currentLessonEndTime = \Carbon\Carbon::createFromFormat('H:i:s', $lesson->studyTimeEnd);

                    // Calculate the duration between the current lesson and the next lesson
                    $breakDuration = $currentLessonEndTime->diffInMinutes($nextLessonStartTime);

                }
@endphp
@if($nextLesson && $nextLesson->studyTimeBegin != $lesson->studyTimeBegin)
{{$lesson->studyTimeName}}. {{$time_start}} - {{$time_end}} ({{$breakDuration}} мин) <b>{{$lesson->studyTypeName}}:</b> {{$lesson->disciplineName}}
Преподаватель: {{$lesson->lastName}} {{sub($lesson->firstName)}}.{{sub($lesson->middleName)}}.

@php
            $num++;
@endphp
@endif
@if(!$nextLesson)
{{$lesson->studyTimeName}}. {{$time_start}} - {{$time_end}}
<b>{{$lesson->studyTypeName}}:</b> {{$lesson->disciplineName}}
Преподаватель: {{$lesson->lastName}} {{sub($lesson->firstName)}}.{{sub($lesson->middleName)}}.

@php
            $num++;
@endphp
@endif
@if($nextLesson && $nextLesson->studyTimeBegin == $lesson->studyTimeBegin)
{{$lesson->studyTimeName}}. {{$time_start}} - {{$time_end}}
•  {{$lesson->subgroupName}} гр.: <b>{{$lesson->studyTypeName}}:</b> {{$lesson->disciplineName}}
Преподаватель: {{$lesson->lastName}} {{sub($lesson->firstName)}}.{{sub($lesson->middleName)}}.

@for($a = $i; isset($lessons[$a+1]) && $lessons[$a+1]->studyTimeBegin == $lesson->studyTimeBegin; $a++)
•  {{$lessons[$a+1]->subgroupName}} гр.: <b>{{$lesson->studyTypeName}}:</b> {{$lesson->disciplineName}}
Преподаватель: {{$lessons[$a+1]->lastName}} {{sub($lessons[$a+1]->firstName)}}.{{sub($lessons[$a+1]->middleName)}}.

@php
                $num++;
                $i++;
@endphp
@endfor
@php
            $num++;
@endphp
@endif
@endfor
