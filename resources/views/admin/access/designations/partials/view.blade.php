<section class="edit-dealermodal-wrapper">
    <div class="modal-wrapper light-modal-wrapper">
        <div class="modal fade" id="viewModal" role="dialog"
             aria-labelledby="viewModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    @include('layout.common.modal-spinner')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            View Designation
                        </h5>
                        <button type="button" class="close modal-close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-designation-form">
                            @csrf
                            <div class="container-fluid">
                                <input type="hidden" name="designation_id">
                                @can('edit.user.designation')
                                <div class="text-right">
                                    <div class="link-btn-wrapper">
                                        <a href="javascript:void(0);" class="btn link-btn btn-edit">
                                            Edit
                                            <span class="fa fa-pencil-alt edit-bg"></span>
                                        </a>
                                    </div>
                                </div>
                                <hr class="mt-1"/>
                                @endcan
                                <div class="row">
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label  class="col-sm-4 col-form-label">
                                                Designation Name <sup class="text-danger">*</sup></label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="designation_name_err" style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Designation Name" name="designation_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-input-area">
                                            <div class="row">
                                                <label  class="col-sm-4 col-form-label">
                                                    Status </label>
                                                <div class="col-sm-8 pl-lg-0">
                                                    <label class="switch">
                                                        <input type="checkbox" id="event-fee-switch1" name="active_status" value="1">
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mt-0"/>
                                <div class="form-input-area">
                                    <div class="row user-data">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn form-button" data-dismiss="modal">
                            Close
                        </button>
                        {{--<button type="button" class="btn form-button btn-danger reset-edit-designation-form">--}}
                            {{--Reset Form--}}
                        {{--</button>--}}
                        <button type="button" class="btn form-button btn-success update-designation">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
