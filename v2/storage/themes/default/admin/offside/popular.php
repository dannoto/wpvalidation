<nav aria-label="breadcrumb" class="mb-3">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo route('admin') ?>"><?php ee('Dashboard') ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo route('admin.offside') ?>"><?php ee('Offside Statistics') ?></a></li>
    <li class="breadcrumb-item active"><?php ee('Popular') ?></li>
  </ol>
</nav>
<div class="d-flex mb-5 align-items-center">
    <h1 class="h3 mb-0 fw-bold"><?php echo \Core\View::$title ?></h1>
</div>
<div class="card rounded-4 shadow-sm mb-4 p-3">
    <form method="get" action="<?php echo route('admin.offside.popular') ?>" class="row g-3 align-items-end">
        <div class="col-md-4">
            <label class="form-label fw-bold"><?php ee('Start Date') ?></label>
            <input type="text" name="start" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo request()->start ?>" data-toggle="datepicker">
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold"><?php ee('End Date') ?></label>
            <input type="text" name="end" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo request()->end ?>" data-toggle="datepicker">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary"><?php ee('Filter') ?></button>
            <a href="<?php echo route('admin.offside.popular') ?>" class="btn btn-link text-secondary"><?php ee('Reset') ?></a>
        </div>
    </form>
</div>
<div class="card rounded-4 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th><?php ee('Domain') ?></th>
                    <th><?php ee('URL') ?></th>
                    <th><?php ee('Total Hits') ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($stats as $stat): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://www.google.com/s2/favicons?domain=<?php echo $stat->domain ?>&sz=32" class="rounded-circle me-2" width="24" height="24">
                                <strong><?php echo $stat->domain ?></strong>
                            </div>
                        </td>
                        <td><a href="<?php echo $stat->url ?>" target="_blank" class="text-break"><?php echo $stat->url ?></a></td>
                        <td><span class="badge bg-primary"><?php echo $stat->count ?></span></td>
                        <td class="text-end">
                            <a href="<?php echo route('admin.offside') ?>?domain=<?php echo $stat->domain ?>" class="btn btn-sm btn-outline-primary"><?php ee('View Logs') ?></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4 d-block">
    <?php echo pagination('pagination justify-content-center border rounded-4 p-3', 'page-item mx-2 shadow-sm text-center', 'page-link rounded') ?>
</div>
