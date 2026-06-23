<div class="d-flex mb-5">
    <div>
        <h1 class="h3 mb-0"><?php ee('New Product') ?></h1>
    </div>
</div>

<form action="<?php echo route('admin.hassio.products.save') ?>" method="post">
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
                        <input type="text" class="form-control p-2" name="name" id="name" placeholder="e.g. Hostinger VPS" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold"><?php ee('Description') ?></label>
                        <textarea class="form-control p-2" name="description" id="description" rows="3" placeholder="<?php ee('Enter a short description for the product') ?>"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="affiliate_url" class="form-label fw-bold"><?php ee('Affiliate URL') ?></label>
                        <input type="url" class="form-control p-2" name="affiliate_url" id="affiliate_url" placeholder="https://..." required>
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
                                <option value="all"><?php ee('All Countries') ?></option>
                                <?php foreach(\Core\Helper::Country(false) as $code => $country): ?>
                                    <option value="<?php echo strtolower($code) ?>"><?php echo $country ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label fw-bold"><?php ee('City') ?></label>
                            <input type="text" class="form-control p-2" name="targeting[city]" id="city" value="all">
                            <div class="form-text"><?php ee('Enter "all" or a specific city name') ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="language" class="form-label fw-bold"><?php ee('Language') ?></label>
                            <select name="targeting[language]" id="language" class="form-select p-2">
                                <option value="all"><?php ee('All Languages') ?></option>
                                <option value="en">English</option>
                                <option value="pt">Portuguese</option>
                                <option value="es">Spanish</option>
                                <option value="fr">French</option>
                                <option value="de">German</option>
                                <option value="it">Italian</option>
                                <?php foreach(\Core\Localization::listInfo() as $lang): ?>
                                    <?php if(!in_array($lang['code'], ['en', 'pt', 'es', 'fr', 'de', 'it'])): ?>
                                        <option value="<?php echo $lang['code'] ?>"><?php echo $lang['name'] ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="browser" class="form-label fw-bold"><?php ee('Browser') ?></label>
                            <select name="targeting[browser]" id="browser" class="form-select p-2">
                                <option value="all"><?php ee('All Browsers') ?></option>
                                <option value="chrome">Chrome</option>
                                <option value="firefox">Firefox</option>
                                <option value="safari">Safari</option>
                                <option value="edge">Edge</option>
                                <option value="opera">Opera</option>
                                <option value="internet explorer">Internet Explorer</option>
                                <option value="netscape">Netscape</option>
                                <option value="maxthon">Maxthon</option>
                                <option value="konqueror">Konqueror</option>
                                <option value="mobile browser"><?php ee('Mobile Browser') ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="os" class="form-label fw-bold"><?php ee('Operating System') ?></label>
                        <select name="targeting[os]" id="os" class="form-select p-2">
                            <option value="all"><?php ee('All Systems') ?></option>
                            <?php echo \Core\Helper::devices() ?>
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
                                <option value="<?php echo $cat->id ?>"><?php echo $cat->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold"><?php ee('Status') ?></label>
                        <select name="status" id="status" class="form-select p-2">
                            <option value="1"><?php ee('Active') ?></option>
                            <option value="0"><?php ee('Inactive') ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm"><?php ee('Create Product') ?></button>
                <a href="<?php echo route('admin.hassio.products') ?>" class="btn btn-light rounded-3 py-2 mt-2"><?php ee('Cancel') ?></a>
            </div>
        </div>
    </div>
</form>
