@extends('layouts.base')


@section('page.title', 'Страница Админа')

@section('content')
    <h1 class="text-center">Админка</h1>
    <h3>Отзывы для модерации:</h3>
    <table class="table table-striped table-hover">
        <thead></thead>
            <th scope="col">Дата публикации</th>
            <th scope="col">Имя</th>
            <th scope="col">Картинка</th>
            <th scope="col">Оценка</th>
            <th scope="col">Текст отзыва</th>
        </thead>
        @foreach ($reviews as $review)
            <tr>
                <td>{{ $review->created_at }}</td>
                <td>{{ $review->name }}</td>
                <td>
                    @isset ($review->image)
                        <img class="img-fluid img-thumbnail rounded float-start me-2" src="{{ asset('/storage/' . $review->image) }}" style="max-width: 200px;">
                    @endisset
                </td>
                <td>{{ $review->score }}</td>
                <td>
                    <div class="d-flex justify-content-between">
                        <div class="">{{ $review->review }}</div>
                        <div class="px-1">
                            <a class="btn btn-primary d-block mb-1" href="{{ route('admin.edit', ['id' => $review->id]) }}">Редактировать</a>
                            <form action="{{ route('admin.delete') }}" method="post" style="display: inline;">
                                @csrf
                                <input type="hidden" name="review_id" value="{{ $review->id }}">
                                <input class="btn btn-primary" type="submit" name="delete" value="Удалить">
                            </form>                            
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
@endsection