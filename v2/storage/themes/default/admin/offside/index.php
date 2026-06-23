<nav aria-label="breadcrumb" class="mb-3">
  <ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo route('admin') ?>"><?php ee('Dashboard') ?></a></li>
	<li class="breadcrumb-item"><?php ee('Offside Statistics') ?></li>
  </ol>
</nav>
<div class="d-flex mb-5 align-items-center">
	<h1 class="h3 mb-0 fw-bold"><?php echo \Core\View::$title ?></h1>
</div>
<div class="card rounded-4 shadow-sm mb-4 p-3">
	<form action="" method="get" class="row g-3 align-items-end">
		<div class="col-md-4">
			<label class="form-label fw-bold"><?php ee('Domain') ?></label>
			<input type="text" class="form-control" name="domain" value="<?php echo clean(request()->domain) ?>" placeholder="e.g. google.com">
		</div>
		<div class="col-md-3">
			<label class="form-label fw-bold"><?php ee('Start Date') ?></label>
			<input type="text" class="form-control" name="start" value="<?php echo clean(request()->start) ?>" data-toggle="datepicker">
		</div>
		<div class="col-md-3">
			<label class="form-label fw-bold"><?php ee('End Date') ?></label>
			<input type="text" class="form-control" name="end" value="<?php echo clean(request()->end) ?>" data-toggle="datepicker">
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-primary w-100"><?php ee('Filter') ?></button>
		</div>
	</form>
</div>

<div class="card rounded-4 shadow-sm">
	<div class="table-responsive">
		<table class="table table-hover mb-0">
			<thead>
				<tr>
					<th><?php ee('URL') ?></th>
					<th><?php ee('Domain') ?></th>
					<th><?php ee('IP') ?></th>
					<th><?php ee('Location') ?></th>
					<th><?php ee('Device') ?></th>
					<th><?php ee('Date') ?></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($stats as $stat): ?>
					<tr>
						<td>
							<div class="d-flex align-items-center">
								<img src="https://www.google.com/s2/favicons?domain=<?php echo $stat->domain ?>&sz=32" class="rounded-circle me-2" width="24" height="24">
								<span title="<?php echo $stat->url ?>"><?php echo \Core\Helper::truncate($stat->url, 40) ?></span>
								<a href="<?php echo $stat->url ?>" target="_blank" class="ms-2 text-muted"><i data-feather="external-link" style="width:14px"></i></a>
							</div>
						</td>
						<td><?php echo $stat->domain ?></td>
						<td><?php echo $stat->ip ?></td>
						<td><?php echo $stat->country ?>, <?php echo $stat->city ?></td>
						<td>
							<span class="badge bg-secondary"><?php echo $stat->os ?></span>
							<span class="badge bg-info text-dark"><?php echo $stat->browser ?></span>
						</td>
						<td><?php echo \Core\Helper::dtime($stat->click_date, 'Y-m-d H:i') ?></td>
						<td>
							<button type="button" class="btn btn-default shadow-none bg-transparent" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="more-vertical"></i></button>
							<ul class="dropdown-menu shadow-sm">
								<li><a class="dropdown-item text-danger" href="<?php echo route('admin.offside.delete', [$stat->id]) ?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i data-feather="trash-2"></i> <?php ee('Delete') ?></a></li>
							</ul>
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

<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
	<div class="modal-content">
	  <div class="modal-header border-0">
		<h5 class="modal-title fw-bold"><?php ee('Are you sure you want to delete this?') ?></h5>
		<button type="button" class="btn btn-transparent border-0 p-0" data-bs-close data-bs-dismiss="modal" aria-label="Close"><i class="fs-3 fa fa-times"></i></button>
	  </div>
	  <div class="modal-body">
		<p><?php ee('You are trying to delete a record. This action is permanent and cannot be reversed.') ?></p>
	  </div>
	  <div class="modal-footer border-0">
		<button type="button" class="btn btn-white border px-3 py-2 rounded-3 shadow-sm" data-bs-close data-bs-dismiss="modal"><?php ee('Cancel') ?></button>
		<a href="#" class="btn btn-danger px-5 py-2 rounded-3 shadow-sm" data-trigger="confirm"><?php ee('Confirm') ?></a>
	  </div>
	</div>
  </div>
</div>
