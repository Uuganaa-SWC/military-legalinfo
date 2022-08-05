@extends('home')

@section('content')
    <div class="clearfix"></div>
    <div class="form-group row">
        <label for="name" class="col-md-1 col-form-label text-md-right">Хууль:</label>
        <div class="col-md-6">
            <select class="form-control" name="law" id="cmbSearchLaw"  post-url="{{url('/discipline/law/articles/show')}}">
                <option value="-1">Сонгоно уу</option>
                <option value="1">Төрийн албаны тухай</option>
                <option value="2">Цэргийн албаны тухай</option>
                <option value="3">Төрийн албан хаагчийн ёс зүйн дүрэм</option>
                <option value="4">Зэвсэгт хүчний офицер, ахлагчийн ёс зүйн дүрэм</option>
                <option value="5">Цэргийн алба хаагчдын эрх зүйн байдлын тухай</option>
                <option value="6">Цэргийн алба хаагчдын тэтгэвэр, тэтгэмжийн тухай</option>
                <option value="7">Төрийн цэргийн байгууллагын хөгжлийн стратеги 2030.</option>
                <option value="8">Цэргийн алба хаагчийн хувцас өмсөх дүрэм.</option>
            </select>
        </div>
    </div>
    <div class="row" id="divList">
        <ul class="list-group">
            @foreach ($articles as $article)
                @php
                    $childArticles = App\Http\Controllers\DisciplineLawArticleController::getChildArticles($article->id);
                @endphp
                @if (count($childArticles) == 0)
                    <li class="list-group-item">{{$article->articleName}}</li>
                @else
                    <li class="list-group-item">{{$article->articleName}}
                        <ul class="list-group">
                            @foreach($childArticles as $childArticle)
                                <li class="list-group-item">{{$childArticle->articleName}}</li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

<div class="row">
    <button type="button" name="button" class="btn btn-success" id="btnNewArticle">Нэмэх</button>
</div>
@include('admin.disciplineApp.article.articleNew')
<script src="{{url('/js/admin/discipline/article/article.js')}}"></script>
@endsection
