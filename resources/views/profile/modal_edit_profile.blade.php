 <!-- Modal -->
                <div class="modal" id="profile-modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body px-0">
                                <p class="text-center">
                                 <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    </p>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                {{-- <hr> --}}
                                {{-- <p class="text-center"><a href="#" class="text-danger">Unfollow</a></p>
                                <hr>
                                <p class="text-center"><a href="#" >Go to post</a></p>
                                <hr>
                                <p class="text-center"><a href="#" >Share</a></p>
                                <hr>
                                <p class="text-center mb-0"><a href="#" >Copy Link</a></p> --}}
                            </div>
                        </div>
                    </div>
                </div>
<!-- Modal end -->


