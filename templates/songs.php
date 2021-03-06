<div class="container-fluid">
    <h2 class="mt-4 mb-4">Songs</h2>
    <hr>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-edit-tab" data-toggle="pill" href="#list-edit" role="tab" aria-controls="edit" aria-selected="true">Edit</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-add-tab" data-toggle="pill" href="#list-add" role="tab" aria-controls="add" aria-selected="false">Add</a>
        </li>
    </ul>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-edit" role="tabpanel" aria-labelledby="list-edit-list">
            <span class="badge badge-dark mb-3">Edit / Delete song</span>
            <?php
            $categories = \Includes\Models\Category::all();
            $songs = \Includes\Models\Song::all();

            if (count($categories)) : ?>
                <table class="table table-bordered table-striped table-sm">
                    <?php foreach ($songs as $song) : ?>
                    <tr>
                        <td>
                            <div class="row mb-2 mb-lg-auto">
                                <div class="col-lg-10">
                                    <form class="obelisk-form ajax" method="POST">
                                        <div class="form-row">
                                            <div class="col-lg-3 col-md-4">
                                                <div class="form-group">
                                                    <label for="song_name_<?php echo $song->id; ?>"><span class="badge badge-pill badge-light">Name</span></label>
                                                    <input type="text" class="form-control" name="song_name"
                                                           id="song_name_<?php echo $song->id; ?>" placeholder="Song Name"
                                                           value="<?php echo $song->name; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="song_url_<?php echo $song->id; ?>"><span class="badge badge-pill badge-light">URL</span></label>
                                                    <input type="text" class="form-control" name="song_url"
                                                           id="song_url_<?php echo $song->id; ?>"
                                                           placeholder="Song URL" value="<?php echo $song->url; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="form-group">
                                                    <label for="song_category_<?php echo $song->id; ?>"><span class="badge badge-pill badge-light">Category</span></label>
                                                    <select class="form-control" name="song_category_id"
                                                            id="song_category_<?php echo $song->id; ?>">
                                                        <option value="0">Uncategorized</option>
                                                        <?php foreach ($categories as $category) : ?>
                                                            <option value="<?php echo $category->id; ?>"
                                                                <?php if ($song->category_id == $category->id) echo "selected"; ?>
                                                            ><?php echo $category->name; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="song_volume_<?php echo $song->id; ?>"><span class="badge badge-pill badge-light">Volume</span></label>
                                                    <select class="form-control" name="song_volume"
                                                            id="song_volume_<?php echo $song->id; ?>">
                                                        <option disabled>Volume</option>
                                                        <?php for ($i = 0; $i <= 100; $i += 5) : ?>
                                                            <option value="<?php echo $i; ?>"
                                                                <?php if ($i == $song->volume) echo "selected"; ?>
                                                            ><?php echo $i; ?>%</option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="form-group">
                                                    <label for="song_info_url_<?php echo $song->id; ?>"><span class="badge badge-pill badge-light">Info URL</span></label>
                                                    <input type="text" class="form-control" name="song_info_url"
                                                           id="song_info_url_<?php echo $song->id; ?>"
                                                           placeholder="Song Info URL" value="<?php echo $song->info_url; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="song_description_<?php echo $song->id; ?>"><span class="badge badge-pill badge-light">Description</span></label>
                                                    <textarea class="form-control" rows="1" placeholder="Description"
                                                              id="song_description_<?php echo $song->id; ?>" name="song_description"
                                                    ><?php echo $song->description; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-2 offset-lg-1 pt-lg-4 mt-lg-2">
                                                <input type="hidden" name="song_id" value="<?php echo $song->id; ?>">
                                                <input type="hidden" name="action" value="edit_song">
                                                <button type="submit" class="btn btn-primary form-control">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-2">
                                    <form class="obelisk-form ajax pt-lg-4 mt-lg-2" method="POST">
                                        <input type="hidden" name="song_name" value="<?php echo $song->name; ?>">
                                        <input type="hidden" name="song_id" value="<?php echo $song->id; ?>">
                                        <input type="hidden" name="action" value="delete_song">
                                        <button type="submit" class="btn btn-danger form-control">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
        <div class="tab-pane fade" id="list-add" role="tabpanel" aria-labelledby="list-add-list">
            <span class="badge badge-dark mb-3">Add song</span>
            <form class="obelisk-form ajax" method="POST">
                <div class="form-group">
                    <label for="song_name_add">Song name:</label>
                    <input type="text" class="form-control" id="song_name_add" name="song_name" placeholder="Song name">
                </div>
                <div class="form-group">
                    <label for="song_url_add">Song url:</label>
                    <input type="text" class="form-control" id="song_url_add" name="song_url" placeholder="Song url">
                </div>
                <div class="form-group">
                    <label for="song_category_add">Song category:</label>
                    <select class="form-control" name="song_category_id" id="song_category_add">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="song_volume_add">Song volume:</label>
                    <select class="form-control" name="song_volume" id="song_volume_add">
                        <?php for ($i = 0; $i <= 100; $i += 5) : ?>
                            <option value="<?php echo $i; ?>"
                                <?php if ($i == 100) echo "selected"; ?>
                            ><?php echo $i; ?>%</option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="song_info_url_add">Song info url:</label>
                    <input type="text" class="form-control" id="song_info_url_add" name="song_info_url" placeholder="Song info url">
                </div>
                <div class="form-group">
                    <label for="song_description_add">Song description:</label>
                    <textarea class="form-control" rows="3" placeholder="Song description"
                              id="song_description_add" name="song_description"
                    ></textarea>
                </div>
                <input type="hidden" name="action" value="add_song">
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        <?php include 'alerts.php' ?>
    </div>
</div>