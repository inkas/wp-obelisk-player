<?php

/**
 * @package   Obelisk Player
 */

use Includes\Api\Route;
use Includes\Controllers\PlaylistsController;

Route::add('save_playlist', array(PlaylistsController::class, 'savePlaylist'));
Route::add('delete_playlist_song', array(PlaylistsController::class, 'deletePlaylistSong'));
