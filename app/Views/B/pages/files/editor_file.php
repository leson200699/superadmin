


<div class="row g-2 g-lg-3 mb-5">
    <?php foreach ($files as $file): ?>
        <?php if ($file['is_dir']): ?>
            <div class="card card-folder col-xl-2 mx-2">
                <div class="card-body">
                    <i class="ri-folder-2-line"></i>
                    <div class="card-content">
                        <h6>
                            <a href="/admin/editor_file?path=<?= rawurlencode($file['path']) ?>" class="link-02">
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















<script>
function selectFile(fileUrl) {
    // Gửi URL hình ảnh về TinyMCE thông qua postMessage
    const relativeUrl = getRelativeUrl(fileUrl); // Xử lý URL tương đối
    window.parent.postMessage({
        sender: 'amfilemanager',
        url: relativeUrl
    }, '*');
}

function getRelativeUrl(fullUrl) {
    const url = new URL(fullUrl);
    return url.pathname; // Trả về phần đường dẫn tương đối
}
</script>
