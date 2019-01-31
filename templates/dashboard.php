<div class="container-fluid">
    <h2 class="mt-4 mb-4">Dashboard</h2>
    <hr>
    <div class="card-columns">
        <div class="card bg-light mb-3 p-0 mw-100">
            <div class="card-header h4">Categories</div>
            <div class="card-body text-dark">
                <div class="h4 mb-0"><?php echo count(\Includes\Models\Category::all()); ?></div>
                <p class="text-uppercase">Count</p>
            </div>
        </div>
        <div class="card bg-light mb-3 p-0 mw-100">
            <div class="card-header h4">Songs</div>
            <div class="card-body text-dark">
                <div class="h4 mb-0"><?php echo count(\Includes\Models\Song::all()); ?></div>
                <p class="text-uppercase">Count</p>
            </div>
        </div>
        <div class="card bg-light mb-3 p-0 mw-100">
            <div class="card-header h4">Top 10</div>
            <div class="card-body text-dark">
                <?php
                $top10songs = \Includes\Models\Playlist::getMostlyAddedSongsToPlaylist(10);

                if (count($top10songs)) : ?>
                <div class="h6 mb-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col" class="w-25">#</td>
                                <td scope="col" class="w-50">Song</td>
                                <td scope="col" class="w-25">Count</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($top10songs); $i++) : ?>
                            <tr>
                                <td scope="row"><?php echo $i + 1; ?></td>
                                <td><a href="<?php echo $top10songs[$i]->url; ?>"><?php echo $top10songs[$i]->name; ?></a></td>
                                <td><?php echo $top10songs[$i]->count; ?></td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
                <p class="text-uppercase">Mostly added to playlists</p>
                <?php else : ?>
                <p class="text-uppercase">There are no songs added to any playlist yet</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
