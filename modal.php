<div id="modal-confirmacao" class="modal" tabindex="-1">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="window.location.href = 'dashboard';">&times;</button>
                <h4 class="blue bigger bolder"><?php echo $titulo ?></h4>
            </div>

            <div class="modal-body">
                <p><?php echo $tipo ?></p>
                <p><?php echo $msg ?></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm" data-dismiss="modal" onclick="window.location.href = 'dashboard';"><i class="ace-icon fa fa-times"></i>Fechar</button>
            </div>

        </div>
    </div>

</div>