<section class="edit-dealermodal-wrapper">
    <div class="modal-wrapper light-modal-wrapper">
        <div class="modal fade" id="addModal" role="dialog"
             aria-labelledby="addModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    @include('layout.common.modal-spinner')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Add User
                        </h5>
                        <button type="button" class="close modal-close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="">
                            @csrf
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Team Information</legend>
                                <div class="row">
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label"> Name <sup
                                                    class="text-danger">*</sup></label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="company_name_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder=" Name" name="company_name"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Photo <sup
                                                    class="text-danger">*</sup></label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <div class="input-group">
                                                   <span class="input-group-btn">
                                                     <a data-input="thumbnail" data-preview="holder"
                                                        class="lfm btn btn-primary">
                                                       <i class="fa fa-picture-o"></i> Choose
                                                     </a>
                                                   </span>
                                                    <input id="thumbnail" class="form-control" type="text"
                                                           name="team_image"
                                                           value="">
                                                </div>

                                                <div id="holder">
                                                    <img
                                                        src=""
                                                        style="height: 5rem;">

                                                </div>
                                                <small class="error-message" id="company_logo_err"
                                                       style="display: none;bottom: 0;"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Position <sup
                                                    class="text-danger">*</sup></label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="company_email_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Position" name="position"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Facebook <sup
                                                    class="text-danger">*</sup></label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="company_location_err"
                                                       style="display: none;"></small>
                                                <input type="link" class="form-control"
                                                       placeholder="Facebook Link" name="facebook"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Instagram <sup
                                                    class="text-danger">*</sup></label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="contact_number_err"
                                                       style="display: none;"></small>
                                                <input type="link" class="form-control"
                                                       placeholder="Instagram Link" name="instagram"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Twitter </label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="copyright_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Twitter Link" name="Twitter"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Github </label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="meta_title_err"
                                                       style="display: none;"></small>
                                                <input type="text" class="form-control"
                                                       placeholder="Github Link" name="meta_title"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Featured</label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="meta_description_err"
                                                       style="display: none;"></small>
                                                       <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" name="featured" id="" value="1"> Featured
                                                        </label>
                                                       </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-6 form-input-area">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Meta Description </label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="meta_description_err"
                                                       style="display: none;"></small>
                                                <textarea name="meta_description"
                                                          class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="form-input-area">
                                            <div class="row">
                                                <label class="col-sm-4 col-form-label">
                                                    Status </label>
                                                <div class="col-sm-8 pl-lg-0">
                                                    <label class="switch">
                                                        <input type="checkbox" id="event-fee-switch"
                                                               name="active_status"
                                                               value="1"  >
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    <div class="modal-footer">
                        <button type="button" class="btn form-button" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn form-button btn-danger reset-user">
                            Reset Form
                        </button>
                        <button type="button" class="btn form-button btn-success add-user">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
