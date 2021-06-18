<ul>
    @foreach ($students as $student)
    <li>
        {{ $student->firstName . ' ' . $student->lastName }}
    </li>
    @endforeach
</ul>