<div class="d-flex mb-5">
    <div>
        <h1 class="h3 mb-0"><?php ee('Hassio Statistics') ?></h1>
    </div>
</div>

<div class="card shadow-sm rounded-4 border-0 mb-4">
    <div class="card-body p-4">
        <form action="<?php echo route('admin.hassio.stats') ?>" method="get" class="row align-items-end">
            <div class="col-md-3 mb-3">
                <label class="form-label fw-bold"><?php ee('Publisher') ?></label>
                <select name="publisher" class="form-select">
                    <option value=""><?php ee('All Publishers') ?></option>
                    <?php foreach($publishersList as $pub): ?>
                        <option value="<?php echo $pub->id ?>" <?php echo request()->publisher == $pub->id ? 'selected' : '' ?>><?php echo $pub->url ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label fw-bold"><?php ee('Product') ?></label>
                <select name="product" class="form-select">
                    <option value=""><?php ee('All Products') ?></option>
                    <?php foreach($productsList as $prod): ?>
                        <option value="<?php echo $prod->id ?>" <?php echo request()->product == $prod->id ? 'selected' : '' ?>><?php echo $prod->name ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label fw-bold"><?php ee('Country') ?></label>
                <select name="country" class="form-select">
                    <option value=""><?php ee('All') ?></option>
                    <?php foreach(\Core\Helper::Country(false) as $code => $name): ?>
                        <option value="<?php echo strtolower($code) ?>" <?php echo request()->country == strtolower($code) ? 'selected' : '' ?>><?php echo $name ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-2 mb-3">
                <button type="submit" class="btn btn-primary w-100"><?php ee('Filter') ?></button>
            </div>
            <div class="col-md-2 mb-3">
                <a href="<?php echo route('admin.hassio.stats') ?>" class="btn btn-light w-100"><?php ee('Reset') ?></a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm rounded-4 border-0 mb-4">
    <div class="card-header bg-transparent border-0 pt-4 px-4">
        <h5 class="fw-bold mb-0"><?php ee('Clicks by Country') ?></h5>
    </div>
    <div class="card-body p-4">
        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead>
                            <tr class="text-muted small uppercase">
                                <th><?php ee('Country') ?></th>
                                <th class="text-end"><?php ee('Clicks') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($countries as $country): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold"><?php echo strtoupper($country->country) ?></div>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 rounded-pill"><?php echo $country->total ?></span>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-light rounded-4 d-flex align-items-center justify-content-center" style="height: 300px;">
                    <p class="text-muted"><?php ee('Map visualization coming soon') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card shadow-sm rounded-4 border-0">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0"><?php ee('Browsers') ?></h5>
            </div>
            <div class="card-body p-4">
                <ul class="list-group list-group-flush">
                    <?php foreach($browsers as $browser): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <span class="text-capitalize"><?php echo $browser->browser ?></span>
                        <span class="badge bg-secondary rounded-pill"><?php echo $browser->total ?></span>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm rounded-4 border-0">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0"><?php ee('Operating Systems') ?></h5>
            </div>
            <div class="card-body p-4">
                <ul class="list-group list-group-flush">
                    <?php foreach($oss as $os): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <span class="text-capitalize"><?php echo $os->os ?></span>
                        <span class="badge bg-secondary rounded-pill"><?php echo $os->total ?></span>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm rounded-4 border-0">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0"><?php ee('Languages') ?></h5>
            </div>
            <div class="card-body p-4">
                <ul class="list-group list-group-flush">
                    <?php foreach($langs as $lang): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <span class="text-uppercase"><?php echo $lang->language ?></span>
                        <span class="badge bg-secondary rounded-pill"><?php echo $lang->total ?></span>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm rounded-4 border-0 mt-4">
    <div class="card-header bg-transparent border-0 pt-4 px-4">
        <h5 class="fw-bold mb-0"><?php ee('Detailed Logs') ?></h5>
    </div>
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-borderless align-middle">
                <thead>
                    <tr class="text-muted small uppercase">
                        <th><?php ee('Date') ?></th>
                        <th><?php ee('Type') ?></th>
                        <th><?php ee('Publisher') ?></th>
                        <th><?php ee('Product') ?></th>
                        <th><?php ee('Location') ?></th>
                        <th><?php ee('Device') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($stats as $stat): ?>
                        <?php 
                            $pub = \Core\DB::hassio_publishers()->where('id', $stat->publisher_id)->first();
                            $prod = \Core\DB::hassio_products()->where('id', $stat->product_id)->first();
                        ?>
                    <tr>
                        <td><?php echo date('Y-m-d H:i', strtotime($stat->created_at)) ?></td>
                        <td>
                            <span class="badge <?php echo $stat->type == 'click' ? 'bg-success' : 'bg-info' ?> rounded-pill">
                                <?php echo ucfirst($stat->type) ?>
                            </span>
                        </td>
                        <td><?php echo $pub ? $pub->url : 'Unknown' ?></td>
                        <td><?php echo $prod ? $prod->name : 'Unknown' ?></td>
                        <td><?php echo strtoupper($stat->country) ?> (<?php echo ucfirst($stat->city) ?>)</td>
                        <td class="small">
                            <?php echo ucfirst($stat->browser) ?> / <?php echo ucfirst($stat->os) ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4 d-block">
            <?php echo pagination('pagination justify-content-center border rounded-4 p-3', 'page-item mx-2 shadow-sm text-center', 'page-link rounded') ?>
        </div>
    </div>
</div>
