<div class="modal fade" id="s_activite">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
            $this->load->library('form_validation');
            echo validation_errors();
            echo form_open('verify_filter/s_activite');
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Saison de l'activite</h4>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-10 col-md-offset-1">
                        <h4>
                            <input type="radio" name="saison" id="ete" />
                            <label for="ete"> Été </label>
                            <input type="radio" name="saison" id="hiver" />
                            <label for="hiver"> Hiver </label>
                        </h4>
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