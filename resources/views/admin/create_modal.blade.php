<button id="submit-btn" type="button" class="btn icon-blue">
    Crea
</button>

<!-- Modal per la conferma creazione appartamento -->
<div class="modal fade" id="submit-modal" tabindex="-1" role="dialog" aria-labelledby="submit-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="submit-modal-title">Creazione di un nuovo appartamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                ATTENZIONE: stai per creare un nuovo annuncio, vuoi procedere?
            </div>

            <div class="modal-footer">
                <button id="proceed-btn" type="submit" class="btn btn-green">Procedi</button>
                <button id="modify-btn" type="button" class="btn btn-blue" data-dismiss="modal">Modifica annuncio</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal per segnalare all'utente la presenza di errori -->
<div class="modal fade" id="err-submit-modal" tabindex="-1" role="dialog" aria-labelledby="err-submit-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="submit-modal-title">Creazione di un nuovo appartamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                ATTENZIONE: i dati che hai inserito non sono corretti o sono incompleti.
            </div>

            <div class="modal-footer">
                <button id="modify-btn" type="button" class="btn btn-blue" data-dismiss="modal">Verifica i dati</button>
            </div>
        </div>
    </div>
</div>
