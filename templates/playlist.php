<div class="obelisk-wrapper">
  <span id="obelisk-player-data"
        data-url="<?php echo admin_url('admin-ajax.php'); ?>"
        data-nonce="<?php echo wp_create_nonce('obelisk_plugin_nonce'); ?>"
  ></span>

    <div class="obelisk-container">
        <div class="obelisk-main obelisk-clearfix">
            <div class="obelisk-left-col">
                <div class="obelisk-col-header">
                    Obelisk Player
                </div>
                <ol class="obelisk-playlist category-list scrollbar-macosx">
                    <?php
                    $categoriesWithSongs = \Includes\Models\Playlist::getCategoriesWithSongs();

                    foreach ($categoriesWithSongs as $categoryName => $category) : ?>
                        <li>
                            <div class="category-name">
                                <?php echo $categoryName; ?>
                                <div class="btn-container obelisk-clearfix">
                                    <a href="#" class="toggle-btns">
                                        <img class="toggle-btn plus-circle" alt="" src="<?php echo \Includes\Base\Config::assets() . '/img/plus-circle.png'; ?>">
                                        <img class="toggle-btn minus-circle" alt="" src="<?php echo \Includes\Base\Config::assets() . '/img/minus-circle.png'; ?>">
                                    </a>
                                </div>
                            </div>
                            <ol class="song-list">
                                <?php foreach ($category as $song) : ?>
                                    <?php if ($song->id) : ?>
                                        <li class="song"
                                            data-id="<?php echo $song->id; ?>"
                                            data-name="<?php echo $song->song_name; ?>"
                                            data-url="<?php echo $song->url; ?>"
                                            data-description="<?php echo htmlspecialchars($song->description); ?>"
                                        >
                                            <div class="song-content">
                                                <audio class="obelisk-audio" data-volume="<?php echo $song->volume / 100; ?>">
                                                    <source src="<?php echo $song->url; ?>">
                                                </audio>
                                                <div class="obelisk-clearfix">
                                                    <span class="song-title"><?php echo $song->song_name; ?></span>
                                                    <div class="btn-container obelisk-clearfix">
                                                        <?php if ($song->info_url) : ?>
                                                            <a href="<?php echo $song->info_url; ?>" target="_blank" class="info-btn"></a>
                                                        <?php endif; ?>
                                                        <a href="#" class="play-btn">
                                                            <img src="<?php echo \Includes\Base\Config::assets() . '/img/play-btn.png'; ?>" alt="">
                                                        </a>
                                                        <a href="#" class="pause-btn">
                                                            <img src="<?php echo \Includes\Base\Config::assets() . '/img/pause-btn.png'; ?>" alt="">
                                                        </a>
                                                        <a href="#" class="close-btn">
                                                            <img src="<?php echo \Includes\Base\Config::assets() . '/img/close-btn.png'; ?>" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="obelisk-progress-wrapper obelisk-clearfix">
                                                    <div class="obelisk-progress-container">
                                                        <progress value="" max="1"></progress>
                                                    </div>
                                                    <div class="current-time">00:00</div>
                                                    <div class="total-time">00:00</div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ol>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
            <div class="obelisk-right-col">
                <div class="obelisk-col-header">
                    My Playlist
                </div>
                <ol class="obelisk-playlist user-song-list scrollbar-macosx">
                    <?php
                    $userId = get_current_user_id();
                    $playlist = \Includes\Models\Playlist::getUserPlaylist($userId);

                    if (count($playlist)) :
                        foreach ($playlist as $song) : ?>
                            <li class="song"
                                data-id="<?php echo $song->id; ?>"
                                data-name="<?php echo $song->name; ?>"
                                data-url="<?php echo $song->url; ?>"
                                data-description="<?php echo htmlspecialchars($song->description); ?>"
                            >
                                <div class="song-content">
                                    <audio class="obelisk-audio" data-volume="<?php echo $song->volume / 100; ?>">
                                        <source src="<?php echo $song->url; ?>">
                                    </audio>
                                    <div class="obelisk-clearfix">
                                        <span class="song-title"><?php echo $song->name; ?></span>
                                        <div class="btn-container obelisk-clearfix">
                                            <a href="#" class="play-btn">
                                                <img src="<?php echo \Includes\Base\Config::assets() . '/img/play-btn.png'; ?>" alt="">
                                            </a>
                                            <a href="#" class="pause-btn">
                                                <img src="<?php echo \Includes\Base\Config::assets() . '/img/pause-btn.png'; ?>" alt="">
                                            </a>
                                            <a href="#" class="close-btn">
                                                <img src="<?php echo \Includes\Base\Config::assets() . '/img/close-btn.png'; ?>" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="obelisk-progress-wrapper obelisk-clearfix">
                                        <div class="obelisk-progress-container">
                                            <progress value="" max="1"></progress>
                                        </div>
                                        <div class="current-time">00:00</div>
                                        <div class="total-time">00:00</div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach;
                    endif; ?>
                </ol>
            </div>
        </div>
        <div class="obelisk-description">
            <div class="song-hover-description"></div>
            <div class="song-active-description"></div>
        </div>
    </div>
</div>
