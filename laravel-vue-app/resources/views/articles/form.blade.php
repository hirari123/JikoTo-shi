<!-- 記事タイトル・本文 -->

@csrf
<div class="md-form">
  <label>タイトル</label>
  <!-- 既存の記事内容を表示させる -->
  <input type="text" name="title" class="form-control" required value="{{$article->title ?? old('title')}}">
</div>
<div class="form-group">
  <article-tags-input>
  </article-tags-input>
</div>
<div class="form-group">
  <label></label>
  <textarea name="content" required class="form-control" rows="16" placeholder="本文">{{$article->content ?? old('content')}}</textarea>
</div>