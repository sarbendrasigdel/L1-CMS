<section class="edit-dealermodal-wrapper">
    <div class="modal-wrapper light-modal-wrapper">
        <div class="modal fade" id="addModal" role="dialog"
             aria-labelledby="addModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    @include('layout.common.modal-spinner')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Add Service
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
                                        <label class="col-sm-4 col-form-label">Service Title <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="company_name_err"
                                                   style="display: none;"></small>
                                            <input type="text" class="form-control"
                                                   placeholder="Service Title" name="service_title"
                                                   value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Category <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="company_name_err"
                                                   style="display: none;"></small>
                                                   <select name="category_id_add" id="category_id">
                                                    <option value="" selected>Choose category</option>
                                                    @foreach($category as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">service Description </label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="meta_description_err"
                                                   style="display: none;"></small>
                                            <textarea name="service_description"
                                                      class="form-control"></textarea>
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
