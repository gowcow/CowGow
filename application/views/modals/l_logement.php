<div class="modal fade" id="l_logement">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
            $this->load->library('form_validation');
            echo validation_errors();
            echo form_open('verify_filter/l_logement');
            if(!isset($logement)){
                $logement = array();
            }
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Logement</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <label for="lieu_l">Lieu du logement : </label>
                        <select  class="select form-control" id="lieu_l">
                            <?php
                            foreach ($logement as $value) {
                                echo "<option class=\"form-control\">$value</option>" . PHP_EOL;
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Allons-y !</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->