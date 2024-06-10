<section class="edit-dealermodal-wrapper">
    <div class="modal-wrapper light-modal-wrapper">
        <div class="modal fade" id="viewModal" role="dialog"
             aria-labelledby="viewModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    @include('layout.common.modal-spinner')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            View mails
                        </h5>
                        <button type="button" class="close modal-close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-6">
                            <label for="name">Name:</label>
                            <p id="name"></p>
                        </div>
                        <div class="col-lg-6">
                            <label for="email">Email:</label>
                            <p id="email"></p>
                        </div>
                        <div class="col-lg-6">
                            <label for="message">Message:</label>
                            <p id="message"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn form-button" data-dismiss="modal">
                            Close
                        </button>
                        {{--<button type="button" class="btn form-button btn-danger reset-edit-designation-form">--}}
                            {{--Reset Form--}}
                        {{--</button>--}}
                        <button type="button" class="btn form-button btn-success update-button">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
