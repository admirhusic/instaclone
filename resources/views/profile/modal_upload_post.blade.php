
<!-- Modal -->
                <div class="modal" id="upload-modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                            <h3 class="text-center">New post</h3>
                                <form action="/p/store" method="POST" enctype="multipart/form-data">
                                 @csrf
                                    <div class="form-group">
                                        <input  type="file" class="form-control-file" id="exampleFormControlFile1" name="photo">
                                    </div>
                                    <div class="form-group">
                                        <label for="caption">caption:</label>
                                        <textarea name="caption" id="" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">upload</button>
                                    </div>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
<!-- Modal end -->

