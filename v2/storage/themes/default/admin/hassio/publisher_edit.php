<div class="d-flex mb-5">
    <div>
        <h1 class="h3 mb-0"><?php ee('Edit Publisher') ?></h1>
    </div>
</div>

<div class="card shadow-sm rounded-4 border-0">
    <div class="card-body p-4">
        <form action="<?php echo route('admin.hassio.publishers.update', [$publisher->id]) ?>" method="post">
            <?php echo csrf() ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="url" class="form-label fw-bold"><?php ee('Website URL') ?></label>
                    <input type="text" class="form-control p-2" name="url" id="url" value="<?php echo $publisher->url ?>" placeholder="example.com" required>
                    <div class="form-text"><?php ee('Enter the domain without http:// or https://') ?></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="category_id" class="form-label fw-bold"><?php ee('Category') ?></label>
                    <select name="category_id" id="category_id" class="form-select p-2">
                        <option value=""><?php ee('All Categories') ?></option>
                        <?php foreach(\Core\DB::hassio_categories()->findMany() as $cat): ?>
                            <option value="<?php echo $cat->id ?>" <?php echo $publisher->category_id == $cat->id ? 'selected' : '' ?>><?php echo $cat->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label fw-bold"><?php ee('Status') ?></label>
                <select name="status" id="status" class="form-select p-2">
                    <option value="1" <?php echo $publisher->status == 1 ? 'selected' : '' ?>><?php ee('Active') ?></option>
                    <option value="0" <?php echo $publisher->status == 0 ? 'selected' : '' ?>><?php ee('Inactive') ?></option>
                </select>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary rounded-3 px-5"><?php ee('Update Publisher') ?></button>
                <a href="<?php echo route('admin.hassio.publishers') ?>" class="btn btn-light rounded-3 ms-2"><?php ee('Cancel') ?></a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm rounded-4 border-0 mt-4">
    <div class="card-header bg-transparent border-0 pt-4 px-4">
        <h5 class="fw-bold mb-0"><?php ee('Publisher Script') ?></h5>
    </div>
    <div class="card-body p-4">
        <p><?php ee('Copy and paste the following script into your website to start displaying products.') ?></p>
        <div class="bg-light p-3 rounded-3 position-relative">
            <code id="scriptCode">&lt;script src="<?php echo route('hassio.load') ?>"&gt;&lt;/script&gt;
&lt;script&gt;
function hassioCallback(products) {
    console.log("Hassio Products Loaded:", products);
    // Implementation to render products in your UI
}
&lt;/script&gt;</code>
            <button class="btn btn-sm btn-outline-primary position-absolute top-0 end-0 m-2" onclick="copyScript()"><?php ee('Copy') ?></button>
        </div>
    </div>
</div>

<script>
    function copyScript() {
        var text = document.getElementById('scriptCode').innerText;
        navigator.clipboard.writeText(text).then(function() {
            alert('Script copied to clipboard!');
        });
    }
</script>
