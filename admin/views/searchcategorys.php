<?php
require_once "models/Category.php";
?>
<div class="mb-4 ">
    <div class="row">
        <div class="mb-4 col-lg-6">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Thêm danh mục
            </button>
        </div>
        <div class="col-lg-6">
            <form action="?controller=categories&action=search" method="post">
                <input type="search" class="form-control" name="timkiem" id="timkiem"
                    placeholder="Tìm kiếm tên danh mục.." required>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tên danh mục</th>
                <th>Mô tả</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categoriessearch as $category): ?>
            <tr>
                <td>
                    <?php echo $category['name']; ?>
                </td>
                <td>
                    <?php echo $category['description']; ?>
                </td>
                <td class="flex">
                    <form action="?controller=categories&action=deletebyid" method="post">
                        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                        <a class="btn btn-warning edit-button" data-bs-toggle="modal"
                            data-bs-target="#editModal<?php echo $category['id']; ?>"
                            data-id="<?php echo $category['id']; ?>">Sửa</a>
                        <button class="btn btn-danger delete-button" onclick="return confirmDelete()">Xóa</button>
                    </form>
                </td>
            </tr>
            <!-- Popup sửa danh mục -->
            <div class="modal fade" id="editModal<?php echo $category['id']; ?>" tabindex="-1" role="dialog"
                aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Sửa danh mục</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="?controller=categories&action=updateCategory" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" value="<?php echo $category['id']; ?>" name="id">
                                    <label for="editName">Tên danh mục:</label>
                                    <input type="text" class="form-control" id="editName" name="editName"
                                        value="<?php echo $category['name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="editDescription">Mô tả:</label>
                                    <textarea class="form-control" id="editDescription" name="editDescription"
                                        required><?php echo $category['description']; ?></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </tbody>
    </table>



</div>




<!-- Popup thêm danh mục -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="?controller=categories&action=addcategory" method="post" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm danh mục</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="addName">Tên danh mục:</label>
                    <input type="text" class="form-control" id="addName" name="name">
                </div>
                <div class="form-group">
                    <label for="addDescription">Mô tả:</label>
                    <textarea class="form-control" id="addDescription" name="description"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="addCategorybtn" class="btn btn-primary">Thêm</button>
            </div>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {

});

function confirmDelete() {
    return confirm("Bạn có chắc chắn muốn xóa?");
}
</script>