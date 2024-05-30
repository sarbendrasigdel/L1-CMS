<section class="edit-dealermodal-wrapper">
    <div class="modal-wrapper light-modal-wrapper">
        <div class="modal fade" id="addModal" role="dialog"
             aria-labelledby="addModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    @include('layout.common.modal-spinner')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Add Team
                        </h5>
                        <button type="button" class="close modal-close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="add-form" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <input id="real-password" type="password" autocomplete="new-password" style="display: none;">
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label"> Name <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="name_err"
                                                   style="display: none;"></small>
                                            <input type="text" class="form-control"
                                                   placeholder=" Name" name="name"
                                                   value="{{old('name')}}">
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
                                                 <a data-input="thumbnail-add" data-preview="holder-add"
                                                    class="lfm btn btn-primary">
                                                   <i class="fa fa-picture-o"></i> Choose
                                                 </a>
                                               </span>
                                                <input id="thumbnail-add" class="form-control" type="text"
                                                       name="image"
                                                       value="">
                                            </div>

                                            <div id="holder-add">
                                                <img
                                                    src=""
                                                    style="height: 5rem;">

                                            </div>
                                            <small class="error-message" id="image_err"
                                                   style="display: none;bottom: 0;"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Position <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="position_err"
                                                   style="display: none;"></small>
                                            <input type="text" class="form-control"
                                                   placeholder="Position" name="position"
                                                   value="{{old('position')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Facebook</label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="facebook_err"
                                                   style="display: none;"></small>
                                            <input type="url" class="form-control"
                                                   placeholder="Facebook Link" name="facebook"
                                                   value="{{old('facebook')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Instagram </label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="instagram_err"
                                                   style="display: none;"></small>
                                            <input type="url" class="form-control"
                                                   placeholder="Instagram Link" name="instagram"
                                                   value="{{old('instagram')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Twitter </label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="twitter_err"
                                                   style="display: none;"></small>
                                            <input type="url" class="form-control"
                                                   placeholder="Twitter Link" name="twitter"
                                                   value="{{old('twitter')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Github </label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="github_err"
                                                   style="display: none;"></small>
                                            <input type="url" class="form-control"
                                                   placeholder="Github Link" name="github"
                                                   value="{{old('github')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Featured</label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="featured_err"
                                                   style="display: none;"></small>
                                                   <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="featured_add" id="featured-add" value="1"> Featured
                                                    </label>
                                                   </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-input-area">
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label">
                                                Status </label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <label class="switch">
                                                    <input type="checkbox" id="event-fee-switch_add" name="active_status_add"
                                                           value="1">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
