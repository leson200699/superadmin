<?php if (session()->has('success')): ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>


        <form id="uploadForm" action="/admin/filemanager/upload_pop" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="file" class="form-control" name="file" id="fileInput">
            <input type="hidden" name="path" value="<?= esc($currentPath) ?>">
        </form>

        <script>
            document.getElementById('fileInput').addEventListener('change', function() {
                // Kiểm tra nếu có tệp được chọn
                if (this.files && this.files.length > 0) {
                    // Tự động submit form
                    document.getElementById('uploadForm').submit();
                }
            });
        </script>



        <?php if (basename($currentPath) != 'pop_file'): ?>
            <a href="/admin/pop_file?path=<?= rawurlencode(dirname($currentPath)) ?>"><button type="submit" class="btn btn-primary mx-3">Back</button></a>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
        <p style="color:red;">
            <?= session()->getFlashdata('error') ?>
        </p>
        <?php endif; ?>

<!-- 

<div class="row g-2 g-lg-3 mb-5">

  <?php foreach ($files as $file): ?>
    <?php if ($file['is_dir']): ?>

            <div class="card card-folder col-xl-2 mx-2">
              <div class="card-body">
                <i class="ri-folder-2-line"></i>
                <div class="card-content">
                  <h6>

<a href="/admin/pop_file?path=<?= rawurlencode($file['path']) ?>" class="link-02">
                <?= $file['name'] ?></a></h6>
                  <span><?= $file['date'] ?></span>
                </div>
              </div>
            </div>
   
<i data-feather="folder"></i> >
            <?= $file['name'] ?></a>

        
    <?php else: ?>
            <a href="javascript:void(0);" onclick="selectFile('<?= base_url('uploads/' . rawurlencode($currentPath . '/' . $file['name'])) ?>')">
            <?php
            $imageFileTypes = ['jpg', 'jpeg', 'png', 'gif', 'bmp']; // Danh sách các loại tệp hình ảnh
        $fileExtension      = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($fileExtension), $imageFileTypes)):
            ?>
             <img src="<?= base_url('uploads/' . rawurlencode($currentPath . '/' . $file['name'])) ?>" 
                 alt="<?= esc($file['name']) ?>" class="img-thumbnail" style="max-width: 100px; max-height: 100px; display: block; margin-top: 5px;" /><?php else: ?><i data-feather="file"></i> <?= $file['name'] ?><?php endif; ?>
                </a>
    <?php endif; ?>
<?php endforeach; ?>

</div> -->




<div class="row g-2 g-lg-3 mb-5">
    <?php foreach ($files as $file): ?>
        <?php if ($file['is_dir']): ?>
            <div class="card card-folder col-xl-2 mx-2">
                <div class="card-body">
                    <i class="ri-folder-2-line"></i>
                    <div class="card-content">
                        <h6>
                            <a href="/admin/pop_file?path=<?= rawurlencode($file['path']) ?>" class="link-02">
                                <?= $file['name'] ?>
                            </a>
                        </h6>
                        <span><?= $file['date'] ?></span>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <a href="javascript:void(0);" onclick="selectFile('<?= base_url('uploads/' . rawurlencode($currentPath . '/' . $file['name'])) ?>')">
                <?php
                $imageFileTypes = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            if (in_array(strtolower($fileExtension), $imageFileTypes)):
                ?>
                    <img src="<?= base_url('uploads/' . rawurlencode($currentPath . '/' . $file['name'])) ?>" 
                         alt="<?= esc($file['name']) ?>" class="img-thumbnail" style="max-width: 100px; max-height: 100px; display: block; margin-top: 5px;" />
                <?php else: ?>
                    <i data-feather="file"></i> <?= $file['name'] ?>
                <?php endif; ?>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>
</div>







<?= $this->include('B/layouts/_javascript') ?>


<script>
function selectFile(url) {
    // Kiểm tra xem có đang trong context iframe hay không
    if (window.top !== window.self) {
        // Lấy document của window top
        const imageType = window.top.imageType; // Lấy imageType đã lưu trước đó

            if (imageType === 'multiple_image') {
                        const input = window.top.document.getElementById('multiple_image');
                        if (input) {
                            const relativeUrl = getRelativeUrl(url); // Get relative URL

                            // Get existing image URLs and add the new one
                            let selectedImages = input.value ? input.value.split(',') : [];
                            if (!selectedImages.includes(relativeUrl)) {
                                selectedImages.push(relativeUrl);
                                input.value = selectedImages.join(','); // Store the URLs in the hidden input

                                // Create a preview of the selected images
                                const previewContainer = window.top.document.getElementById('image-preview-container');
                                
                                // Tạo phần tử chứa hình ảnh và nút xóa
                                const imageContainer = document.createElement('div');
                                imageContainer.classList.add('image-item');
                                
                                // Tạo phần tử ảnh
                                const imgElement = document.createElement('img');
                                imgElement.src = relativeUrl;
                                imgElement.classList.add('img-thumbnail', 'm-2');
                                imgElement.style.maxWidth = '100px';

                                // Tạo nút xóa
                                const deleteButton = document.createElement('button');
                                deleteButton.type = 'button';
                                deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'delete-image');
                                deleteButton.innerHTML = '<i class="ri-delete-bin-2-line"></i> Delete';

                                // Gắn sự kiện xóa cho nút
                                deleteButton.onclick = function() {
                                    deleteImage(imgElement, deleteButton, relativeUrl);
                                };

                                // Thêm ảnh và nút xóa vào container
                                imageContainer.appendChild(imgElement);
                                imageContainer.appendChild(deleteButton);
                                previewContainer.appendChild(imageContainer);
                            }
                        }
                    }


        else if (imageType === 'img-thumbnail') {
            const input = window.top.document.getElementById('img-thumbnail');
            if (input) {
                const relativeUrl = getRelativeUrl(url); // Xử lý URL tương đối
                input.value = relativeUrl;

                // Hiển thị hình ảnh được chọn trong thẻ <img> của form chính
                const imagePreview = window.top.document.querySelector('.img-thumbnail');
                if (imagePreview) {
                    imagePreview.src = relativeUrl;
                }

            } else {
                alert('Không tìm thấy input hình đại diện.');
            }
        } else if (imageType === 'favicon-image') {
            const input = window.top.document.getElementById('favicon-image');
            if (input) {
                const relativeUrl = getRelativeUrl(url); // Xử lý URL tương đối
                input.value = relativeUrl;

                // Hiển thị hình ảnh được chọn trong thẻ <img> của form chính
                const imagePreview = window.top.document.querySelector('.favicon-image');
                if (imagePreview) {
                    imagePreview.src = relativeUrl;
                }

            } else {
                alert('Không tìm thấy input hình ảnh phụ.');
            }
        } else if (imageType === 'logo-image') {
            const input = window.top.document.getElementById('logo-image');
            if (input) {
                const relativeUrl = getRelativeUrl(url); // Xử lý URL tương đối
                input.value = relativeUrl;

                // Hiển thị hình ảnh được chọn trong thẻ <img> của form chính
                const imagePreview = window.top.document.querySelector('.logo-image');
                if (imagePreview) {
                    imagePreview.src = relativeUrl;
                }

            } else {
                alert('Không tìm thấy input hình ảnh phụ.');
            }
        } else if (imageType === 'logo_footer') {
            const input = window.top.document.getElementById('logo_footer');
            if (input) {
                const relativeUrl = getRelativeUrl(url); // Xử lý URL tương đối
                input.value = relativeUrl;

                // Hiển thị hình ảnh được chọn trong thẻ <img> của form chính
                const imagePreview = window.top.document.querySelector('.logo_footer');
                if (imagePreview) {
                    imagePreview.src = relativeUrl;
                }

            } else {
                alert('Không tìm thấy input hình ảnh phụ.');
            }
        }  else if (imageType === 'thumbnail') {
            const input = window.top.document.getElementById('thumbnail');
            if (input) {
                const relativeUrl = getRelativeUrl(url); // Xử lý URL tương đối
                input.value = relativeUrl;

                // Cập nhật hình ảnh được chọn trong thẻ <img> của form chính
                const imagePreview = window.top.document.getElementById('thumbnail-preview');
                if (imagePreview) {
                    // Tạo một thẻ <img> mới để hiển thị ảnh đã chọn
                    const imgElement = document.createElement('img');
                    imgElement.src = relativeUrl;
                    imgElement.classList.add('img-thumbnail', 'm-2'); // Thêm các lớp CSS
                    imgElement.style.maxWidth = '100px'; // Giới hạn chiều rộng ảnh
                    imgElement.style.maxHeight = '100px'; // Giới hạn chiều cao ảnh

                    // Thêm thẻ <img> vào preview container
                    imagePreview.src = relativeUrl; // Cập nhật ảnh trong thẻ <img> hiện tại
                    imagePreview.style.display = 'block'; // Hiển thị ảnh trong thẻ <img> hiện tại
                    imagePreview.classList.add('img-thumbnail', 'm-2'); // Thêm lớp CSS cho thẻ hiện tại
                    imagePreview.style.maxWidth = '100px'; // Giới hạn chiều rộng ảnh
                    imagePreview.style.maxHeight = '100px'; // Giới hạn chiều cao ảnh
                }

            } else {
                alert('Không tìm thấy input hình đại diện.');
            }
        }

        // Đóng modal của iframe
        window.top.closeFileManagerModal(); // Gọi hàm đóng modal từ window top

    } else {
        alert('Không thể truyền URL vì không ở trong iframe.');
    }
}


function getRelativeUrl(fullUrl) {
    const url = new URL(fullUrl);
    return url.pathname; // Trả về phần đường dẫn tương đối
}

function deleteImage(imgElement, deleteButton, imageUrl) {
    // Xóa hình ảnh và nút xóa khỏi giao diện
    imgElement.remove();
    deleteButton.remove();

    // Cập nhật giá trị trong textarea
    const input = window.top.document.getElementById('multiple_image');
    let selectedImages = input.value ? input.value.split(',') : [];
    
    // Xóa URL ảnh khỏi mảng
    const index = selectedImages.indexOf(imageUrl);
    if (index > -1) {
        selectedImages.splice(index, 1);
    }

    // Cập nhật lại giá trị textarea
    if (selectedImages.length > 0) {
        input.value = selectedImages.join(',');
    } else {
        input.value = ''; // Nếu không còn ảnh, làm trống textarea
    }
}
</script>

    <!-- Vendor CSS -->
    <link href="<?php echo base_url('B/am-x-admin/lib/remixicon/fonts/remixicon.css') ?>" rel="stylesheet">
    <!-- Template CSS -->
    <link href="<?php echo base_url('B/am-x-admin/assets/css/style.min.css') ?>" rel="stylesheet">


