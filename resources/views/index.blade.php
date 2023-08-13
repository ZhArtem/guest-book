@extends('layouts.base')


@section('page.title', 'Страница отзывов')

@section('content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="text-center mb-1">Оставьте свой отзыв</h3>
            <form action="{{ route('guestbook.store') }}" method="post" class="d-flex flex-column mb-4 border p-3" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Имя:</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Введите ваше имя" required>
                </div>
                <div class="mb-3">
                    <label for="review" class="form-label">Отзыв:</label>
                    <textarea class="form-control" name="review" id="review" rows="4" placeholder="Введите ваш отзыв" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Аватар:</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <label for="score" class="form-label">Ваша оценка:</label>
                <div class="d-flex">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="score" id="Radio1" value=1>
                        <label class="form-check-label" for="Radio1">1</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="score" id="Radio2" value=2>
                        <label class="form-check-label" for="Radio2">2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="score" id="Radio3" value=3>
                        <label class="form-check-label" for="Radio3">3</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="score" id="Radio4" value=4>
                        <label class="form-check-label" for="Radio4">4</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="score" id="Radio5" value=5>
                        <label class="form-check-label" for="Radio5">5</label>
                    </div>
                </div>

                <div class="g-recaptcha" data-sitekey="{{ config('app.recaptcha_site_key') }}"></div>

                <input class="btn btn-primary align-self-end" type="submit" value="Оставить отзыв">
            </form>

            <h2 class="text-center">Отзывы:</h2>
            @foreach ($reviews as $review)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title">{{ $review->name }}</h5>
                        <div>
                            @if ($review->score)
                                <strong>Оценка: {{ $review->score }}</strong>
                            @endif
                            <date class="badge bg-info">{{ $review->created_at }}</date>
                        </div>
                    </div>
                    <div class="card-body d-flex">
                        @isset ($review->image)
                            <img class="img-fluid img-thumbnail rounded float-start me-2" src="{{ asset('/storage/' . $review->image) }}" style="max-width: 200px;">
                        @endisset
                        <p class="card-text ms-5">{{ $review->review }}</p>
                        @if ($key == $review->id)
                            <div class="px-1 ms-auto">
                                <a class="btn btn-primary d-block mb-1" href="{{ route('guestbook.edit', ['id' => $review->id]) }}">Редактировать</a>
                                <form action="{{ route('guestbook.delete') }}" method="post" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="review_id" value="{{ $review->id }}">
                                    <input class="btn btn-primary" type="submit" name="delete" value="Удалить">
                                </form>                            
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
