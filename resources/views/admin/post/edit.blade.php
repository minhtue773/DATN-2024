@extends('admin.layout.app')
@section('title')
    Cập nhật bài viết
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.post.index') }}">Bài viết</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                </ol>
            </nav>
            <a href="{{ route('admin.post.index') }}" class="btn btn-danger btn-sm mb-3"><i class="fa-solid fa-right-from-bracket me-2"></i>Thoát</a>
            <form action="{{ route('admin.post.update',$post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-8">
                        <div class="card border-top-primary shadow">
                            <div class="card-header text-gray-800">
                                Nội dung bài viết
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="sform-label">Tiêu đề:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập tiêu đề..." name="title" id="title" value="{{ $post->title ?? old('title') }}" onkeyup="ChangeToSlug()">  
                                        @error('title')
                                            <p class="text-danger m-0 mt-1">* {{ $message }}</p>
                                        @enderror
                                    </div>                                                                                                                                                
                                    <div class="col-6 mb-3">
                                        <label class="sform-label">Slug:</label>
                                        <input type="text" class="form-control form-control-sm" name="slug" id="slug" value="{{ $post->slug ?? old('slug') }}"> 
                                        @error('slug')
                                            <p class="text-danger m-0 mt-1">* {{ $message }}</p>
                                        @enderror
                                    </div>                                                                                                                                                
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Chuyên mục:</label>
                                        <select class="form-select form-select-sm" name="category_id">
                                            <option>----Chọn chuyên mục---</option>
                                            @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $post->category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="text-danger m-0 mt-1">* {{ $message }}</p>
                                        @enderror
                                    </div>    
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Trạng thái:</label>
                                        <select class="form-select form-select-sm" name="status">
                                            <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Công khai</option>
                                            <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Riêng tư</option>
                                        </select>
                                        @error('status')
                                            <p class="text-danger m-0 mt-1">* {{ $message }}</p>
                                        @enderror
                                    </div>    
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Nổi bật trên trang chủ:</label>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check form-switch me-5">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="is_featured" {{ $post->is_featured == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Nổi bật</label>
                                            </div>                                               
                                        </div>  
                                        @error('is_featured')
                                        <p class="text-danger m-0 mt-1">* {{ $message }}</p>
                                        @enderror                                  
                                    </div>                                    
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Mô tả:</label>
                                        <textarea class="form-control" name="description">{{ $post->description }}</textarea>    
                                        @error('description')
                                        <p class="text-danger">* {{ $message }}</p>
                                        @enderror
                                    </div>                                      
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Nội dung chi tiết:</label>
                                        <textarea class="form-control" name="content" id="editor" style="height: 100px">{{ $post->content }}</textarea>
                                        @error('content')
                                        <p class="text-danger">* {{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm me-2"><i class="fa-solid fa-floppy-disk me-2"></i>Cập nhật</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 no-gutters">
                        <div class="col-12 mb-3">
                            <div class="card border-top-primary shadow">
                                <div class="card-header text-gray-800">
                                    Hình ảnh bài viết
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-12">
                                            <div class="photoUpload-zone" id="photo-zone">
                                                <img src="{{ asset('uploads/images/post') }}/{{ $post->image }}" id="preview-image" class="img-fluid col-9">
                                                <div class="lable-zone">
                                                    <label class="photoUpload-file" for="file-zone">
                                                        <input type="file" name="file" id="file-zone" onchange="previewImage(event)">
                                                        <div class="d-flex flex-column justify-content-center ">
                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                            <p class="photoUpload-choose btn btn-outline-primary btn-sm">Chọn hình</p>
                                                        </div>
                                                        @error('photo')
                                                        <p class="text-danger">* {{ $message }}</p>
                                                        @enderror
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                     
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview-image');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.1.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.1.0/"
            }
        }
    </script>
    <script type="module">
        import {
            ClassicEditor,
            AccessibilityHelp,
            Autoformat,
            AutoImage,
            Autosave,
            BlockQuote,
            Bold,
            CloudServices,
            Essentials,
            Heading,
            ImageBlock,
            ImageCaption,
            ImageInline,
            ImageInsert,
            ImageInsertViaUrl,
            ImageResize,
            ImageStyle,
            ImageTextAlternative,
            ImageToolbar,
            ImageUpload,
            Indent,
            IndentBlock,
            Italic,
            Link,
            LinkImage,
            Paragraph,
            SelectAll,
            SimpleUploadAdapter,
            Table,
            TableCaption,
            TableCellProperties,
            TableColumnResize,
            TableProperties,
            TableToolbar,
            TextTransformation,
            Underline,
            Undo
        } from 'ckeditor5';

        const editorConfig = {
            toolbar: {
                items: [
                    'undo',
                    'redo',
                    '|',
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'underline',
                    '|',
                    'link',
                    'insertImage',
                    'insertTable',
                    'blockQuote',
                    '|',
                    'outdent',
                    'indent'
                ],
                shouldNotGroupWhenFull: false
            },
            plugins: [
                AccessibilityHelp,
                Autoformat,
                AutoImage,
                Autosave,
                BlockQuote,
                Bold,
                CloudServices,
                Essentials,
                Heading,
                ImageBlock,
                ImageCaption,
                ImageInline,
                ImageInsert,
                ImageInsertViaUrl,
                ImageResize,
                ImageStyle,
                ImageTextAlternative,
                ImageToolbar,
                ImageUpload,
                Indent,
                IndentBlock,
                Italic,
                Link,
                LinkImage,
                Paragraph,
                SelectAll,
                SimpleUploadAdapter,
                Table,
                TableCaption,
                TableCellProperties,
                TableColumnResize,
                TableProperties,
                TableToolbar,
                TextTransformation,
                Underline,
                Undo
            ],
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            image: {
                toolbar: [
                    'toggleImageCaption',
                    'imageTextAlternative',
                    '|',
                    'imageStyle:inline',
                    'imageStyle:wrapText',
                    'imageStyle:breakText',
                    '|',
                    'resizeImage'
                ]
            },
            link: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                decorators: {
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            placeholder: 'Nhập nội dung!',
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
            }
        };

        ClassicEditor.create(document.querySelector('#editor'), editorConfig);
    </script>
    <script>
        function ChangeToSlug()
        {
            var title, slug;
            title = document.getElementById("title").value;
            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();
        
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('slug').value = slug;
        }
    </script>
@endsection