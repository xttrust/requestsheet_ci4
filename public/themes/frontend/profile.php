<div class="profile-top-spacer"></div>

<div class="container pt-4">
    <div class="profile-header">
        <div class="profile-header-image">
            <img class="img-fluid img-thumbnail shadow" src="<?= uploads_url('images/headers/admin-header.jpeg'); ?>" alt="alt"/>
        </div>


        <div class="profile-header-buttons mt-2">

            <!-- Start Anouncements Modal -->
            <button type="button"
                    title="Anouncements"
                    class="btn btn-dark btn-sm btn-profile"
                    data-bs-toggle="modal"
                    data-bs-target="#anouncementsModal">
                <span class="icon-bullhorn1"></span>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="anouncementsModal" tabindex="-1" aria-labelledby="anouncementsModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h2 class="modal-title" id="anouncementsModalLabel">Anouncements</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-white text-black">
                            Anouncement 1
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Anouncements Modal -->

            <!-- Start Tips Modal -->
            <button type="button"
                    title="Tips"
                    class="btn btn-dark btn-sm btn-profile"
                    data-bs-toggle="modal"
                    data-bs-target="#tipsModal">
                <span class="icon-money"></span>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="tipsModal" tabindex="-1" aria-labelledby="tipsModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h2 class="modal-title" id="tipsModalLabel">Tips title here</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-white text-black">
                            Tips list here
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Tips Modal -->

            <!-- Start Socials Modal -->
            <button type="button"
                    title="Social Networks"
                    class="btn btn-dark btn-sm btn-profile"
                    data-bs-toggle="modal"
                    data-bs-target="#socialsModal">
                <span class="icon-share-square-o"></span>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="socialsModal" tabindex="-1" aria-labelledby="socialsModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h2 class="modal-title" id="socialsModalLabel">Socials title here</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-white text-black">
                            Socials list here
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Socials Modal -->

        </div>

    </div>
</div>