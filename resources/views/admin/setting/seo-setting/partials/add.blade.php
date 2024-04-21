<section class="edit-dealermodal-wrapper">
    <div class="modal-wrapper light-modal-wrapper">
        <div class="modal fade" id="addModal"  role="dialog"
             aria-labelledby="addModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    @include('layout.common.modal-spinner')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Add {{$title}}
                        </h5>
                        <button type="button" class="close modal-close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="add-form" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Page Name <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="page_name_err"
                                                   style="display: none;"></small>
                                            <select name="page_name" class="form-control">
                                                <option value="">Select Page Name</option>
                                                <option value="home-page" >Home Page</option>
                                                <option value="about-us" >About Us</option>
                                                <option value="ingredient" >Ingredient</option>
                                                <option value="csr" >Csr</option>
                                                <option value="our-herbal-kingdom" >Herbal Herbal Kingdom</option>
                                                <option value="our-team" >Our Team</option>
                                                <option value="our-brand" >Our Brand</option>
                                                <option value="gallery" >Gallery</option>
                                                <option value="newsroom" >Newsroom</option>
                                                <option value="blogs" >Blogs</option>
                                                <option value="contact-us" >Contact Us</option>
                                                <option value="terms-and-condition" >Terms and Condition</option>
                                                <option value="privacy-policy" >Privacy Policy</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label">Meta Title <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="meta_title_err" style="display: none;"></small>
                                            <input type="text" name="meta_title" class="form-control" placeholder="Meta Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label">Meta Description <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="meta_description_err" style="display: none;"></small>
                                            <textarea name="meta_description" class="form-control"></textarea>
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
                                                    <input type="checkbox" id="event-fee-switch" name="active_status" value="1" checked>
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn form-button" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn form-button btn-danger reset-btn">
                            Reset Form
                        </button>
                        <button type="button" class="btn form-button btn-success add-btn">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
