<h2>Sửa Quận/Huyện</h2>
<form action="<?= site_url('ward/edit/'.$ward['id']) ?>" method="post">
    <label for="name">Tên Quận/Huyện</label>
    <input type="text" name="name" value="<?= $ward['name'] ?>" required>
    
    <label for="district_id">Mã Quận/Huyện</label>
    <input type="text" name="district_id" value="<?= $ward['district_id'] ?>" required>
    
    <button type="submit">Cập nhật</button>
</form>
