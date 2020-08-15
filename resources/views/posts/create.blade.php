@extends('adminlte.master') 

@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('content')
        <div class="ml-3 mt-3">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Input Pertanyaan</h3>
              </div>
              <!-- /.card-header -->

              <!-- form start -->
              <form role="form" action='/posts' method='POST' >
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" value ="{{old('title','')}}" placeholder="masukkan judul pertanyaan">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description">Deskripsi</label>
                    {{-- <input type="text" class="form-control" id="body" name="body" placeholder="Description"> --}}
                    <textarea name="body" class="form-control my-editor">{!! old('body', $body ?? '') !!}</textarea>
                  </div>

                  <div class="formgroup">
                    <label for="tags">Tags</label>
                  <input type="text" class="form-control" id="tags" name="tags" value="{{old('tags','')}}" placeholder="pisahkan dengan koma">
                  </div>

                  {{-- <div class="form-group">
                    <label for="body">Tags</label>
                    <input type="text" class="form-control" id="body" name="body" value ="{{old('body','')}}" placeholder="masukkan tags pertanyaan">
                    @error('body')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>                --}}
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>

@endsection

@push('scripts')
<script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }
      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };
  tinymce.init(editor_config);
</script>
@endpush 