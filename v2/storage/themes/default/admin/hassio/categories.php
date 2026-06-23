<div class="d-flex mb-5">
    <div>
        <h1 class="h3 mb-0"><?php ee('Categories') ?></h1>
    </div>
    <div class="ms-auto">
        <button type="button" class="btn btn-primary rounded-3 shadow-sm px-4" data-bs-toggle="modal" data-bs-target="#newModal"><?php ee('Add Category') ?></button>
    </div>
</div>

<div class="card shadow-sm rounded-4 border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3"><?php ee('Name') ?></th>
                        <th class="py-3"><?php ee('Slug') ?></th>
                        <th class="pe-4 py-3 text-end"><?php ee('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categories as $category): ?>
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold"><?php echo $category->name ?></div>
                        </td>
                        <td><?php echo $category->slug ?></td>
                        <td class="pe-4 text-end">
                            <button type="button" class="btn btn-default shadow-none btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                <li><a class="dropdown-item py-2 edit-cat" href="#" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?php echo $category->id ?>" data-name="<?php echo $category->name ?>" data-slug="<?php echo $category->slug ?>"><i data-feather="edit" class="me-2 icon-sm"></i> <?php ee('Edit') ?></a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item py-2 text-danger" href="<?php echo route('admin.hassio.categories.delete', [$category->id, \Core\Helper::nonce('hassio.category.delete')]) ?>" data-bs-toggle="modal" data-bs-target="#deleteModal" data-href="<?php echo route('admin.hassio.categories.delete', [$category->id, \Core\Helper::nonce('hassio.category.delete')]) ?>"><i data-feather="trash-2" class="me-2 icon-sm"></i> <?php ee('Delete') ?></a></li>
                            </ul>
                        </td>
                    </tr>
                    <?php endforeach ?>
                    <?php if(empty($categories)): ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted py-5">
                            <p><?php ee('No categories found') ?></p>
                        </td>
                    </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- New Category Modal -->
<div class="modal fade" id="newModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="<?php echo route('admin.hassio.categories.save') ?>" method="post">
                <?php echo csrf() ?>
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold"><?php ee('Add Category') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold"><?php ee('Name') ?></label>
                        <input type="text" class="form-control p-2" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label fw-bold"><?php ee('Slug') ?></label>
                        <input type="text" class="form-control p-2" name="slug" id="slug">
                        <div class="form-text"><?php ee('Leave empty to generate automatically') ?></div>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal"><?php ee('Cancel') ?></button>
                    <button type="submit" class="btn btn-primary rounded-3"><?php ee('Save') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="" method="post" id="editForm">
                <?php echo csrf() ?>
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold"><?php ee('Edit Category') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-bold"><?php ee('Name') ?></label>
                        <input type="text" class="form-control p-2" name="name" id="edit_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_slug" class="form-label fw-bold"><?php ee('Slug') ?></label>
                        <input type="text" class="form-control p-2" name="slug" id="edit_slug">
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal"><?php ee('Cancel') ?></button>
                    <button type="submit" class="btn btn-primary rounded-3"><?php ee('Update') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold"><?php ee('Delete Category') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <p><?php ee('Are you sure you want to delete this category?') ?></p>
            </div>
            <div class="modal-footer border-0 pb-4 px-4">
                <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal"><?php ee('Cancel') ?></button>
                <a href="#" class="btn btn-danger rounded-3" id="confirmDelete"><?php ee('Delete') ?></a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var name = button.getAttribute('data-name');
            var slug = button.getAttribute('data-slug');
            
            var form = document.getElementById('editForm');
            form.setAttribute('action', '<?php echo route('admin.hassio.categories.update', ['']) ?>/' + id);
            
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_slug').value = slug;
        });

        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var href = button.getAttribute('data-href');
            var confirmBtn = document.getElementById('confirmDelete');
            confirmBtn.setAttribute('href', href);
        });
    });
</script>
