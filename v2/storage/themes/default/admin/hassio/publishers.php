<div class="d-flex mb-5">
    <div>
        <h1 class="h3 mb-0"><?php ee('Publishers') ?></h1>
    </div>
    <div class="ms-auto">
        <a href="<?php echo route('admin.hassio.publishers.new') ?>" class="btn btn-primary rounded-3 shadow-sm px-4"><?php ee('Add Publisher') ?></a>
    </div>
</div>

<div class="card shadow-sm rounded-4 border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3"><?php ee('URL') ?></th>
                        <th class="py-3"><?php ee('Category') ?></th>
                        <th class="py-3"><?php ee('Status') ?></th>
                        <th class="py-3"><?php ee('Created At') ?></th>
                        <th class="pe-4 py-3 text-end"><?php ee('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($publishers as $publisher): ?>
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold"><?php echo $publisher->url ?></div>
                        </td>
                        <td>
                            <?php if($publisher->category_id && $cat = \Core\DB::hassio_categories()->where('id', $publisher->category_id)->first()): ?>
                                <span class="badge bg-info bg-opacity-10 text-info px-2 rounded-pill"><?php echo $cat->name ?></span>
                            <?php else: ?>
                                <span class="text-muted"><?php ee('None') ?></span>
                            <?php endif ?>
                        </td>
                        <td>
                            <?php if($publisher->status): ?>
                                <span class="badge bg-success bg-opacity-10 text-success px-2 rounded-pill"><?php ee('Active') ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger bg-opacity-10 text-danger px-2 rounded-pill"><?php ee('Inactive') ?></span>
                            <?php endif ?>
                        </td>
                        <td><?php echo date('Y-m-d', strtotime($publisher->created_at)) ?></td>
                        <td class="pe-4 text-end">
                            <button type="button" class="btn btn-default shadow-none btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                <li><a class="dropdown-item py-2" href="<?php echo route('admin.hassio.publishers.edit', [$publisher->id]) ?>"><i data-feather="edit" class="me-2 icon-sm"></i> <?php ee('Edit') ?></a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item py-2 text-danger" href="<?php echo route('admin.hassio.publishers.delete', [$publisher->id, \Core\Helper::nonce('hassio.publisher.delete')]) ?>" data-bs-toggle="modal" data-bs-target="#deleteModal" data-href="<?php echo route('admin.hassio.publishers.delete', [$publisher->id, \Core\Helper::nonce('hassio.publisher.delete')]) ?>"><i data-feather="trash-2" class="me-2 icon-sm"></i> <?php ee('Delete') ?></a></li>
                            </ul>
                        </td>
                    </tr>
                    <?php endforeach ?>
                    <?php if(empty($publishers)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            <i data-feather="users" class="mb-3" style="width: 48px; height: 48px;"></i>
                            <p><?php ee('No publishers found') ?></p>
                        </td>
                    </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold"><?php ee('Delete Publisher') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <p><?php ee('Are you sure you want to delete this publisher? This action cannot be undone.') ?></p>
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
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var href = button.getAttribute('data-href');
            var confirmBtn = document.getElementById('confirmDelete');
            confirmBtn.setAttribute('href', href);
        });
    });
</script>
