<div class="container-fluid">
    <h2 class="mt-4 mb-4">Categories</h2>
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
            <span class="badge badge-dark mb-3">Edit / Delete</span>
            <?php
            $categories = \Includes\Models\Category::all();

            if (count($categories)) : ?>
                <table class="table table-bordered table-striped table-sm">
                    <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td>
                            <div class="row mb-2 mb-lg-auto">
                                <div class="col-lg-10">
                                    <form class="obelisk-form ajax" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-lg-10">
                                                <label for="category_name_<?php echo $category->id; ?>"><span class="badge badge-pill badge-light">Name</span></label>
                                                <input type="text" class="form-control" name="category_name"
                                                       id="category_name_<?php echo $category->id; ?>"
                                                       placeholder="Category Name" value="<?php echo $category->name; ?>">
                                            </div>
                                            <div class="form-group col-lg-2 pt-lg-4 mt-lg-2">
                                                <input type="hidden" name="id" value="<?php echo $category->id; ?>">
                                                <input type="hidden" name="action" value="edit_category">
                                                <button type="submit" class="btn btn-primary form-control">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-2">
                                    <form class="obelisk-form ajax pt-lg-4 mt-lg-2" method="POST">
                                        <input type="hidden" name="category_name" value="<?php echo $category->name; ?>">
                                        <input type="hidden" name="id" value="<?php echo $category->id; ?>">
                                        <input type="hidden" name="action" value="delete_category">
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
            <span class="badge badge-dark mb-3">Add category</span>
            <form class="obelisk-form ajax" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category name">
                </div>
                <input type="hidden" name="action" value="add_category">
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        <?php include 'alerts.php' ?>
    </div>
</div>
