<section class="edit-dealermodal-wrapper">
    <div class="modal-wrapper light-modal-wrapper">
        <div class="modal fade" id="addModal" role="dialog"
             aria-labelledby="addModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    @include('layout.common.modal-spinner')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Add In Portfolio
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
                                        <label class="col-sm-4 col-form-label"> Title <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="title_err"
                                                   style="display: none;"></small>
                                            <input type="text" class="form-control"
                                                   placeholder=" Title" name="title"
                                                   value="{{old('title')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label"> Client <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="title_err"
                                                   style="display: none;"></small>
                                            <input type="text" class="form-control"
                                                   placeholder=" Client" name="client"
                                                   value="{{old('client')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Image<sup
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
                                        <label class="col-sm-4 col-form-label">Description<sup
                                            class="text-danger">*</sup></label> 
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="description_err"
                                                   style="display: none;"></small>
                                            <textarea name="description"
                                                      class="form-control" id="editor1"  value="">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Category <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="category_id_add_err"
                                                   style="display: none;"></small>
                                                   <select name="category_id_add" id="category_id_add">
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
                                        <label class="col-sm-4 col-form-label">Date <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="date_err"
                                                   style="display: none;"></small>
                                                   <input type="date" class="form-control"
                                                    name="date"
                                                   >
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
                        <button type="button" class="btn form-button btn-success add-btn">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
