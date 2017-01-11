<ul>
    @foreach($scores as $score)
        <li>
            {{ $score->user }}
            @if ($score->point_id == config('constants.categories.grammarian_id'))
                {{ " - ($score->notes)" }}
            @endif

            @if ($score->point_id == config('constants.categories.most_ahs_id'))
                {{ " - $score->notes " . str_plural('time', (int) $score->notes) }}
            @endif
        </li>
    @endforeach
</ul>