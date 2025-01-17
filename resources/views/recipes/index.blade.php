<x-app-layout>
        <ul>
            @foreach ($recipes as $recipe)
                <li>
                    <a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->name }}</a>
                    {{ $recipe->value }}
                    {{ $recipe->level }}
                </li>
            @endforeach
        </ul>
        <a href="{{ route('recipes.create') }}">レシピの作成</a>
</x-app-layout>