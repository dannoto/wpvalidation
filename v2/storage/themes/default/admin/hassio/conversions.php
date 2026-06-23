<div class="d-flex mb-5">
    <div>
        <h1 class="h3 mb-0"><?php ee('Conversions') ?></h1>
    </div>
</div>

<div class="card shadow-sm rounded-4 border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3"><?php ee('Publisher') ?></th>
                        <th class="py-3"><?php ee('Product') ?></th>
                        <th class="py-3"><?php ee('Commission') ?></th>
                        <th class="py-3"><?php ee('Status') ?></th>
                        <th class="py-3"><?php ee('Created At') ?></th>
                        <th class="pe-4 py-3 text-end"><?php ee('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($conversions as $conversion): ?>
                    <tr>
                        <td class="ps-4">
                            <?php if($pub = \Core\DB::hassio_publishers()->where('id', $conversion->publisher_id)->first()): ?>
                                <div class="fw-bold"><?php echo $pub->url ?></div>
                            <?php else: ?>
                                <span class="text-muted"><?php ee('Unknown') ?></span>
                            <?php endif ?>
                        </td>
                        <td>
                            <?php if($prod = \Core\DB::hassio_products()->where('id', $conversion->product_id)->first()): ?>
                                <div class="fw-bold"><?php echo $prod->name ?></div>
                            <?php else: ?>
                                <span class="text-muted"><?php ee('Unknown') ?></span>
                            <?php endif ?>
                        </td>
                        <td><?php echo \Helpers\App::currency(config('currency'), $conversion->commission) ?></td>
                        <td>
                            <?php if($conversion->status == 'paid'): ?>
                                <span class="badge bg-success bg-opacity-10 text-success px-2 rounded-pill"><?php ee('Paid') ?></span>
                            <?php elseif($conversion->status == 'pending'): ?>
                                <span class="badge bg-warning bg-opacity-10 text-warning px-2 rounded-pill"><?php ee('Pending') ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger bg-opacity-10 text-danger px-2 rounded-pill"><?php ee('Cancelled') ?></span>
                            <?php endif ?>
                        </td>
                        <td><?php echo date('Y-m-d H:i', strtotime($conversion->created_at)) ?></td>
                        <td class="pe-4 text-end">
                            <button type="button" class="btn btn-default shadow-none btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                <li><a class="dropdown-item py-2" href="<?php echo route('admin.hassio.conversions.delete', [$conversion->id, \Core\Helper::nonce('hassio.conversion.delete')]) ?>" data-bs-toggle="modal" data-bs-target="#deleteModal" data-href="<?php echo route('admin.hassio.conversions.delete', [$conversion->id, \Core\Helper::nonce('hassio.conversion.delete')]) ?>"><i data-feather="trash-2" class="me-2 icon-sm"></i> <?php ee('Delete') ?></a></li>
                            </ul>
                        </td>
                    </tr>
                    <?php endforeach ?>
                    <?php if(empty($conversions)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <p><?php ee('No conversions found') ?></p>
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
                <h5 class="modal-title fw-bold"><?php ee('Delete Conversion') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <p><?php ee('Are you sure you want to delete this conversion?') ?></p>
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
