 <?php if(!empty($bancodefilmes)){
        foreach($bancodefilmes as $filme){ ?>
            <div class="col s6 m3 filme center-align">
                <img class="filme_trigger" src="<?= $this->public; ?>img/filmes/<?= $filme->imagem; ?>" data-id="<?= $filme->id_filme; ?>">
                
                
        
        <!-- Modal Structure -->
        <div id="modal_filme" class="modal">
            <div class="modal-content ">
                <h4 class="titulo"></h4>
                <p class="genero"></p>
                <p class="descricao"></p>
                <p class="nota"></p>
                <p class="ano"></p>
            </div>
            <div class="modal-footer">
                <?php } } ?>
            </div>
        </div>
    </div>
   

