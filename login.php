<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Acceso de Administrador</h3>
            </div>
            <div class="panel-body">
                <form role="form" id="form_login" name="form_login">
                    <?php if (isset($_GET['accesscheck'])) { ?>
                        <input type="hidden" id="prevURL" name="accesscheck" value="<?php echo $_GET['accesscheck']; ?>" />
                    <?php } else { ?>
                        <input type="hidden" id="prevURL" name="accesscheck" value="0" />
                    <?php } ?>
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Usuario" name="L_USER" id="L_USER" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="L_PASSWORD" id="L_PASSWORD" type="password" value="">
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <input type="hidden" value="1" name="login_ingresar"/>
                        <button class="btn btn-lg btn-success btn-block" id="btn_ingresar">Ingresar</button>
                    </fieldset>
                </form>
                <div id="alertBoxes"></div>
            </div>
        </div>
    </div>
</div>