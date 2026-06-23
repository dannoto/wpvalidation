<div>
    <a style="text-decoration:none" href="<?= base_url() ?>painel/adp_prospection">
        <div style="border-bottom: 0.08rem solid #c9c9c9;padding:5px;margin-top:5px">
            <p style="color:#fff"><i style="color:gray" class="fa fa-trophy"></i> PROSPECTION</p>

        </div>
    </a>
    <a style="text-decoration:none" href="<?= base_url() ?>painel/adp_prospection_credentials">
        <div style="border-bottom: 0.08rem solid #c9c9c9;padding:5px;margin-top:5px">
            <p style="color:#fff"><i style="color:gray" class="fa fa-lock"></i> CREDENTIALS <small>(<?=count($this->tung_model->get_adp_prospection_credentials() )?>)</small></p>

        </div>
    </a>
    <a style="text-decoration:none" href="<?= base_url() ?>painel/adp_prospection_list">
        <div style="border-bottom: 0.08rem solid #c9c9c9;padding:5px;margin-top:5px">
            <p style="color:#fff"><i style="color:gray" class="fa fa-bullseye"></i> TARGETS</p>
        </div>
    </a>
        <a style="text-decoration:none" href="<?= base_url() ?>painel/adp_pocs">
        <div style="border-bottom: 0.08rem solid #c9c9c9;padding:5px;margin-top:5px">
            <p style="color:#fff"><i style="color:gray" class="fa fa-bug"></i> POC's</p>
        </div>
    </a>
    <a style="text-decoration:none" href="<?= base_url() ?>painel/sair">
        <div style="border-bottom: 0.08rem solid #c9c9c9;padding:5px;margin-top:5px">
            <p style="color:#fff"><i style="color:gray" class="fa fa-right-from-bracket"></i> SAIR</p>
        </div>
    </a>
</div>