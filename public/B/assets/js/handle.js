tinymce.init({
    selector: '#editor',
    convert_urls: false,
    relative_urls: false,
    remove_script_host: true,
    height: 400,
    forced_root_block : "",
    branding: false,
    plugins: 'link code lists image imagetools',
    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link | code | image | imagetools',
    menubar: false,
    statusbar: false,
    content_css: [
        '//fonts.googleapis.com/css?family=Google+Sans:300,300i,400,400i',
        '//www.tiny.cloud/css/codepen.min.css'
    ],

    external_filemanager_path:"/admin/editor_file/",
    filemanager_title:"AM Filemanager" ,
    external_plugins: { "filemanager" : "/B/assets/js/am.filemanager.js"}
});

tinymce.init({
    selector: '#editor1',
    convert_urls: false,
    relative_urls: false,
    remove_script_host: true,
    height: 400,
    forced_root_block : "",
    branding: false,
    plugins: 'link code lists image imagetools',
    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link | code | image | imagetools',
    menubar: false,
    statusbar: false,
    content_css: [
        '//fonts.googleapis.com/css?family=Google+Sans:300,300i,400,400i',
        '//www.tiny.cloud/css/codepen.min.css'
    ],

    external_filemanager_path:"/admin/editor_file/",
    filemanager_title:"AM Filemanager" ,
    external_plugins: { "filemanager" : "/B/assets/js/am.filemanager.js"}
});

tinymce.init({
    selector: '#editor2',
    height: 400,
    menubar:true,
    forced_root_block : "",
    branding: false,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table paste imagetools wordcount"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |fontsizeselect link image | forecolor backcolor | underline| responsivefilemanager",
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tiny.cloud/css/codepen.min.css'
    ],
    external_filemanager_path:"/admin/editor_file/",
    filemanager_title:"AM Filemanager" ,
    external_plugins: { "filemanager" : "/B/assets/js/am.filemanager.js"}
});

tinymce.init({
    selector: '#editor3',
    height: 400,
    menubar:true,
    forced_root_block : "",
    branding: false,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table paste imagetools wordcount"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |fontsizeselect link image | forecolor backcolor | underline| responsivefilemanager",
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tiny.cloud/css/codepen.min.css'
    ],
    external_filemanager_path:"/admin/editor_file/",
    filemanager_title:"AM Filemanager" ,
    external_plugins: { "filemanager" : "/B/assets/js/am.filemanager.js"}
});

tinymce.init({
    selector: '#editor4',
    height: 400,
    menubar:true,
    forced_root_block : "",
    branding: false,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table paste imagetools wordcount"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |fontsizeselect link image | forecolor backcolor | underline| responsivefilemanager",
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tiny.cloud/css/codepen.min.css'
    ],
    external_filemanager_path:"/admin/editor_file/",
    filemanager_title:"AM Filemanager" ,
    external_plugins: { "filemanager" : "/B/assets/js/am.filemanager.js"}
});

tinymce.init({
    selector: '#editor5',
    height: 400,
    menubar: 'file edit view insert format tools table help', 
    forced_root_block : "",
    branding: false,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table paste imagetools wordcount"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |fontsizeselect link image | forecolor backcolor | underline| responsivefilemanager",
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tiny.cloud/css/codepen.min.css'
    ],
    external_filemanager_path:"/admin/editor_file/",
    filemanager_title:"AM Filemanager" ,
    external_plugins: { "filemanager" : "/B/assets/js/am.filemanager.js"}
});


function openFileManager(imageType, editorId = null) {
    // Lưu imageType và editorId vào window.top
    window.top.imageType = imageType;
    window.top.targetEditorId = editorId; // Lưu ID của editor
    document.getElementById('fileManagerModal').style.display = 'block';
}



// function selectFile(filePath) {
//     // Lấy imageType từ window.top
//     const imageType = window.top.imageType;

//     // Kiểm tra imageType để xác định đang chọn hình đại diện hay hình ảnh phụ
//     if (imageType === 'news-image') {
//         window.top.document.getElementById('news-image').value = filePath; // Gán giá trị vào input của hình đại diện
//         window.top.document.querySelector('.news-image').src = filePath;  // Hiển thị hình ảnh đại diện
//     } else if (imageType === 'loiich_thumb') {
//         window.top.document.getElementById('loiich_thumb').value = filePath;  // Gán giá trị vào input của hình ảnh phụ
//         window.top.document.querySelector('.loiich_thumb').src = filePath;   // Hiển thị hình ảnh phụ
//     } else if (imageType === 'quytrinh_thumb') {
//         window.top.document.getElementById('quytrinh_thumb').value = filePath;  // Gán giá trị vào input của hình ảnh phụ
//         window.top.document.querySelector('.quytrinh_thumb').src = filePath;   // Hiển thị hình ảnh phụ
//     }   else if (imageType === 'quytrinh2_thumb') {
//         window.top.document.getElementById('quytrinh2_thumb').value = filePath;  // Gán giá trị vào input của hình ảnh phụ
//         window.top.document.querySelector('.quytrinh2_thumb').src = filePath;   // Hiển thị hình ảnh phụ
//     } else if (imageType === 'cauhoi_thumb') {
//         window.top.document.getElementById('cauhoi_thumb').value = filePath;  // Gán giá trị vào input của hình ảnh phụ
//         window.top.document.querySelector('.cauhoi_thumb').src = filePath;   // Hiển thị hình ảnh phụ
//     }

//     // Đóng modal sau khi đã chọn xong
//     window.top.closeFileManagerModal();
// }



function closeFileManagerModal() {
    document.getElementById('fileManagerModal').style.display = 'none';
}


window.addEventListener("insert-image-from-modal", function (event) {
    const urls = event.detail.images || [];
    const targetEditorId = window.top.targetEditorId; // Lấy ID của editor từ window.top

    console.log('Handle.js received image event:', {
        urls: urls,
        targetTinyEditorId: window.targetTinyEditorId,
        targetCustomEditorId: targetEditorId
    });
    
    // Handle TinyMCE editors
    if (typeof tinymce !== 'undefined' && window.targetTinyEditorId) {
        const editor = tinymce.get(window.targetTinyEditorId);
        if (editor) {
            urls.forEach(url => {
                editor.insertContent(`<img src="${url}" style="max-width:100%;height:auto;" /><br/>`);
            });
        }
    }
    
    // Handle Custom Rich Editors
    if (targetEditorId && urls.length > 0) {
        urls.forEach(url => {
            if (window.insertImageToCustomEditor) {
                window.insertImageToCustomEditor(url, targetEditorId);
            }
        });
    }
});
