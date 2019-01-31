<?php

/**
 * @package   Obelisk Player
 */

use Includes\Api\Route;
use Includes\Controllers\SongsController;

Route::add('add_song', array(SongsController::class, 'addSong'));
Route::add('edit_song', array(SongsController::class, 'editSong'));
Route::add('delete_song', array(SongsController::class, 'deleteSong'));
