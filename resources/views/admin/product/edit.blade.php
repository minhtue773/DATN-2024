@extends('admin.layout.app')
@section('title')
    Cập nhật sản phẩm
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mô hình Luffy</li>
                </ol>
            </nav>
            <a href="{{ route('admin.product.index') }}" class="btn btn-danger btn-sm mb-3"><i class="fa-solid fa-right-from-bracket me-2"></i>Thoát</a>
            <form action="">
                <div class="row">
                    <div class="col-8">
                        <div class="card border-top-primary shadow">
                            <div class="card-header text-gray-800">
                                Thông tin sản phẩm
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Tên mô hình:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập tên..." value="Mô hình Luffy">
                                    </div>                                      
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Slug:</label>
                                        <input type="text" class="form-control form-control-sm" value="mo-hinh-luffy">
                                    </div>                                      
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Giá mô hình:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập giá..." value="678.000 đ">
                                    </div>                                      
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Giảm giá (%):</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập giảm giá..." value="5%">
                                    </div>                                                                         
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Danh mục:</label>
                                        <select class="form-select form-select-sm" aria-label="Default select example">
                                            <option value="0">----Chọn danh mục---</option>
                                            <option value="1" selected>Mô hình One Piece</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>     
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Trạng thái:</label>
                                        <select class="form-select form-select-sm" aria-label="Default select example">
                                            <option value="0">----Chọn trạng thái---</option>
                                            <option value="1" selected>Sản phẩm Hot</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>     
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Tình trạng:</label>
                                        <div class="d-flex align-items-center py-1">
                                            <div class="form-check form-switch me-5">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Nổi bật</label>
                                            </div>                                          
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="check-show" checked>
                                                <label class="form-check-label" for="check-show">Hiển thị</label>
                                            </div>      
                                        </div>                                        
                                    </div>                                    
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Mô tả:</label>
                                        <textarea class="form-control" name="" id="editor" style="height: 100px"></textarea>
                                    </div>                                      
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm me-2"><i class="fa-solid fa-floppy-disk me-2"></i>Lưu</button>
                                <a href="{{ route('admin.product.index') }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-right-from-bracket me-2"></i>Thoát</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 no-gutters">
                        <div class="col-12 mb-3">
                            <div class="card border-top-primary shadow">
                                <div class="card-header text-gray-800">
                                    Hình ảnh sản phẩm
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-12">
                                            <div class="photoUpload-zone" id="photo-zone">
                                                <img src="https://bizweb.dktcdn.net/thumb/grande/100/418/981/products/1-3c9ff52a-852b-475c-b26f-62adaeaa4eaa.jpg?v=1726212838470" id="preview-image" class="img-fluid col-9">
                                                <div class="lable-zone">
                                                    <label class="photoUpload-file" for="file-zone">
                                                        <input type="file" name="file" id="file-zone" onchange="previewImage(event)">
                                                        <div class="d-flex flex-column justify-content-center ">
                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                            <p class="photoUpload-choose btn btn-outline-primary btn-sm">Chọn hình</p>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="card border-top-primary shadow">
                                <div class="card-header text-gray-800">
                                    Ảnh liên quan
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-12">
                                            <div class="d-flex flex-wrap justify-content-between" id="preview-container">
                                                <!-- Ảnh được chọn sẽ được tạo động và chèn vào đây -->
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" id="inputGroupFile01" multiple>
                                            </div>
                                            <button type="button" class="btn btn-outline-danger btn-sm float-right px-3" id="clearImagesBtn" style="display:none;">Hủy</button>
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
    <!-- /.container-fluid -->
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

    document.getElementById('inputGroupFile01').addEventListener('change', function(event) {
        var files = event.target.files;
        var previewContainer = document.getElementById('preview-container');
        var clearImagesBtn = document.getElementById('clearImagesBtn');
        previewContainer.innerHTML = '';
        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();
            var img = document.createElement('img');
            img.classList.add('img-thumbnail', 'mb-3');
            img.style.height = '75px';
            img.style.width = '75px';
            reader.onload = (function(img) {
                return function(e) {
                    img.src = e.target.result;
                    previewContainer.appendChild(img);  

                    
                    clearImagesBtn.style.display = 'block';
                };
            })(img);
            reader.readAsDataURL(files[i]);  
        } 
        if (files.length === 0) {
            clearImagesBtn.style.display = 'none';
        }
    });
    document.getElementById('clearImagesBtn').addEventListener('click', function() {
        var previewContainer = document.getElementById('preview-container');
        var fileInput = document.getElementById('inputGroupFile01');
        var clearImagesBtn = document.getElementById('clearImagesBtn');
        previewContainer.innerHTML = '';
        fileInput.value = '';     
        clearImagesBtn.style.display = 'none';
    });


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
@endsection