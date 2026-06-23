<div class="d-flex mb-5">
    <h1 class="h3 mb-0"><?php ee('Hassio Dashboard') ?></h1>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card card-body shadow-sm rounded-4 border-0">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3">
                        <i data-feather="users"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-0 text-muted"><?php ee('Publishers') ?></h6>
                    <h3 class="mb-0 fw-bold"><?php echo $stats->publishers ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-body shadow-sm rounded-4 border-0">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-3">
                        <i data-feather="package"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-0 text-muted"><?php ee('Products') ?></h6>
                    <h3 class="mb-0 fw-bold"><?php echo $stats->products ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-body shadow-sm rounded-4 border-0">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="bg-info bg-opacity-10 text-info p-3 rounded-3">
                        <i data-feather="mouse-pointer"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-0 text-muted"><?php ee('Total Impressions') ?></h6>
                    <h3 class="mb-0 fw-bold"><?php echo $stats->renders ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-body shadow-sm rounded-4 border-0">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3">
                        <i data-feather="refresh-cw"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-0 text-muted"><?php ee('Conversions') ?></h6>
                    <h3 class="mb-0 fw-bold"><?php echo $stats->conversions ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card shadow-sm rounded-4 border-0">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0"><?php ee('Top Publishers') ?></h5>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead>
                            <tr class="text-muted small uppercase">
                                <th><?php ee('Publisher') ?></th>
                                <th class="text-end"><?php ee('Clicks') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($topPublishers as $publisher): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold"><?php echo $publisher->url ?></div>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 rounded-pill"><?php echo $publisher->count ?></span>
                                </td>
                            </tr>
                            <?php endforeach ?>
                            <?php if(empty($topPublishers)): ?>
                            <tr>
                                <td colspan="2" class="text-center text-muted py-4"><?php ee('No data available') ?></td>
                            </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm rounded-4 border-0">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0"><?php ee('Top Products') ?></h5>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead>
                            <tr class="text-muted small uppercase">
                                <th><?php ee('Product') ?></th>
                                <th class="text-end"><?php ee('Clicks') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($topProducts as $product): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold"><?php echo $product->name ?></div>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 rounded-pill"><?php echo $product->count ?></span>
                                </td>
                            </tr>
                            <?php endforeach ?>
                            <?php if(empty($topProducts)): ?>
                            <tr>
                                <td colspan="2" class="text-center text-muted py-4"><?php ee('No data available') ?></td>
                            </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm rounded-4 border-0 mt-4">
    <div class="card-header bg-transparent border-0 pt-4 px-4">
        <h5 class="fw-bold mb-0"><?php ee('Integration Guide for Publishers') ?></h5>
    </div>
    <div class="card-body p-4">
        <p class="text-muted"><?php ee("To start displaying products on a publisher's site, they need to add the following code where they want the ads to appear.") ?></p>
        
        <div class="bg-light p-3 rounded-3 mb-3 position-relative">
            <pre class="mb-0"><code id="integrationCode">&lt;div id="wordpress-source"&gt;&lt;/div&gt;
&lt;script src="<?php echo route('hassio.load') ?>"&gt;&lt;/script&gt;</code></pre>
            <button class="btn btn-sm btn-outline-primary position-absolute top-0 end-0 m-2" onclick="copyCode()"><?php ee('Copy') ?></button>
        </div>

        <div class="alert alert-info rounded-3 border-0">
            <i data-feather="info" class="me-2"></i>
            <?php ee('The system will automatically register any new domain that uses this script. You can then manage them in the Publishers section.') ?>
        </div>
    </div>
</div>

<script>
    function copyCode() {
        var code = document.getElementById('integrationCode').innerText;
        navigator.clipboard.writeText(code).then(function() {
            alert('<?php ee('Code copied to clipboard') ?>');
        });
    }
</script>
