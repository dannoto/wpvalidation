<div class="d-flex mb-5">
    <div>
        <h1 class="h3 mb-0"><?php ee('Edit Product') ?></h1>
    </div>
</div>

<?php $targeting = $product->targeting; ?>

<form action="<?php echo route('admin.hassio.products.update', [$product->id]) ?>" method="post">
    <?php echo csrf() ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm rounded-4 border-0 mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0"><?php ee('General Information') ?></h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold"><?php ee('Product Name') ?></label>
                        <input type="text" class="form-control p-2" name="name" id="name" value="<?php echo $product->name ?>" placeholder="e.g. Hostinger VPS" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold"><?php ee('Description') ?></label>
                        <textarea class="form-control p-2" name="description" id="description" rows="3" placeholder="<?php ee('Enter a short description for the product') ?>"><?php echo $product->description ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="affiliate_url" class="form-label fw-bold"><?php ee('Affiliate URL') ?></label>
                        <input type="url" class="form-control p-2" name="affiliate_url" id="affiliate_url" value="<?php echo $product->affiliate_url ?>" placeholder="https://..." required>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0"><?php ee('Targeting') ?></h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label fw-bold"><?php ee('Country') ?></label>
                            <select name="targeting[country]" id="country" class="form-select p-2">
                                <option value="all" <?php echo ($targeting->country ?? 'all') == 'all' ? 'selected' : '' ?>><?php ee('All Countries') ?></option>
                                <?php foreach(\Core\Helper::Country(false) as $code => $country): ?>
                                    <option value="<?php echo strtolower($code) ?>" <?php echo ($targeting->country ?? '') == strtolower($code) ? 'selected' : '' ?>><?php echo $country ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label fw-bold"><?php ee('City') ?></label>
                            <input type="text" class="form-control p-2" name="targeting[city]" id="city" value="<?php echo $targeting->city ?? 'all' ?>">
                            <div class="form-text"><?php ee('Enter "all" or a specific city name') ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="language" class="form-label fw-bold"><?php ee('Language') ?></label>
                            <select name="targeting[language]" id="language" class="form-select p-2">
                                <option value="all" <?php echo ($targeting->language ?? 'all') == 'all' ? 'selected' : '' ?>><?php ee('All Languages') ?></option>
                                <option value="en" <?php echo ($targeting->language ?? '') == 'en' ? 'selected' : '' ?>>English</option>
                                <option value="pt" <?php echo ($targeting->language ?? '') == 'pt' ? 'selected' : '' ?>>Portuguese</option>
                                <option value="es" <?php echo ($targeting->language ?? '') == 'es' ? 'selected' : '' ?>>Spanish</option>
                                <option value="fr" <?php echo ($targeting->language ?? '') == 'fr' ? 'selected' : '' ?>>French</option>
                                <option value="de" <?php echo ($targeting->language ?? '') == 'de' ? 'selected' : '' ?>>German</option>
                                <option value="it" <?php echo ($targeting->language ?? '') == 'it' ? 'selected' : '' ?>>Italian</option>
                                <?php foreach(\Core\Localization::listInfo() as $lang): ?>
                                    <?php if(!in_array($lang['code'], ['en', 'pt', 'es', 'fr', 'de', 'it'])): ?>
                                        <option value="<?php echo $lang['code'] ?>" <?php echo ($targeting->language ?? '') == $lang['code'] ? 'selected' : '' ?>><?php echo $lang['name'] ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="browser" class="form-label fw-bold"><?php ee('Browser') ?></label>
                            <select name="targeting[browser]" id="browser" class="form-select p-2">
                                <option value="all" <?php echo ($targeting->browser ?? 'all') == 'all' ? 'selected' : '' ?>><?php ee('All Browsers') ?></option>
                                <option value="chrome" <?php echo ($targeting->browser ?? '') == 'chrome' ? 'selected' : '' ?>>Chrome</option>
                                <option value="firefox" <?php echo ($targeting->browser ?? '') == 'firefox' ? 'selected' : '' ?>>Firefox</option>
                                <option value="safari" <?php echo ($targeting->browser ?? '') == 'safari' ? 'selected' : '' ?>>Safari</option>
                                <option value="edge" <?php echo ($targeting->browser ?? '') == 'edge' ? 'selected' : '' ?>>Edge</option>
                                <option value="opera" <?php echo ($targeting->browser ?? '') == 'opera' ? 'selected' : '' ?>>Opera</option>
                                <option value="internet explorer" <?php echo ($targeting->browser ?? '') == 'internet explorer' ? 'selected' : '' ?>>Internet Explorer</option>
                                <option value="netscape" <?php echo ($targeting->browser ?? '') == 'netscape' ? 'selected' : '' ?>>Netscape</option>
                                <option value="maxthon" <?php echo ($targeting->browser ?? '') == 'maxthon' ? 'selected' : '' ?>>Maxthon</option>
                                <option value="konqueror" <?php echo ($targeting->browser ?? '') == 'konqueror' ? 'selected' : '' ?>>Konqueror</option>
                                <option value="mobile browser" <?php echo ($targeting->browser ?? '') == 'mobile browser' ? 'selected' : '' ?>><?php ee('Mobile Browser') ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="os" class="form-label fw-bold"><?php ee('Operating System') ?></label>
                        <select name="targeting[os]" id="os" class="form-select p-2">
                            <option value="all" <?php echo ($targeting->os ?? 'all') == 'all' ? 'selected' : '' ?>><?php ee('All Systems') ?></option>
                            <?php echo \Core\Helper::devices(strtolower($targeting->os ?? '')) ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm rounded-4 border-0 mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0"><?php ee('Organization') ?></h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="category_id" class="form-label fw-bold"><?php ee('Category') ?></label>
                        <select name="category_id" id="category_id" class="form-select p-2" required>
                            <option value=""><?php ee('Select Category') ?></option>
                            <?php foreach(\Core\DB::hassio_categories()->findMany() as $cat): ?>
                                <option value="<?php echo $cat->id ?>" <?php echo $product->category_id == $cat->id ? 'selected' : '' ?>><?php echo $cat->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold"><?php ee('Status') ?></label>
                        <select name="status" id="status" class="form-select p-2">
                            <option value="1" <?php echo $product->status == 1 ? 'selected' : '' ?>><?php ee('Active') ?></option>
                            <option value="0" <?php echo $product->status == 0 ? 'selected' : '' ?>><?php ee('Inactive') ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm"><?php ee('Update Product') ?></button>
                <a href="<?php echo route('admin.hassio.products') ?>" class="btn btn-light rounded-3 py-2 mt-2"><?php ee('Cancel') ?></a>
            </div>
        </div>
    </div>
</form>
