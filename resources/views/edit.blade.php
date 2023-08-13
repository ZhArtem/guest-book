@extends('layouts.base')


@section('page.title', 'Редактирование отзыва')

@section('content')
    <h1>Редактирование отзыва</h1>
    <form action="{{ route('guestbook.update', ['id' => $review->id]) }}" method="post" class="d-flex flex-column">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" name="edited_name" class="form-control" id="name" placeholder="Введите имя" value="{{ $review->name }}" required>
        </div>
        <div class="mb-3">
            <label for="review" class="form-label">Отзыв</label>
            <textarea class="form-control" name="edited_review" id="review" rows="4" placeholder="Введите отзыв" required>{{ $review->review }}</textarea>
        </div>
        <div class="mb-3">
            <label for="score" class="form-label">Оценка</label>
            <input class="form-control" type="number" name="edited_score" id="score" min="1" max="5" value="{{ $review->score }}">
        </div>
        <input  class="btn btn-primary align-self-end" type="submit" value="Сохранить">
    </form>
@endsection
