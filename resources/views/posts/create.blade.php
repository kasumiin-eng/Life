@extends('layouts.app')
 
@section('content')
<div class="container">
    <h1>New Post</h1>
    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}" placeholder="タイトルを入力してください">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="body" class="form-control" rows="5" placeholder="本文を入力してください">{{old('body')}}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">カテゴリー</label>
            <select class="form-control" id="exampleFormControlSelect1" select name="category">
            <option value="supplement">Supplement</option>
            <option value="protein">Protein</option>
            <option value="kosher">Kosher
            <option value="organic">Organic</option>
            <option value="others">Others</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlFile1">カバー写真</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
        </div>
        
        <input type="submit" value="Post" class="btn btn-primary">
        <input type="reset" value="cancel" class="btn btn-secondary" onclick='window.history.back(-1);'>
    </form>
</div>
@endsection