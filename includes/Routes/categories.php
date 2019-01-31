<?php

/**
 * @package   Obelisk Player
 */

use Includes\Api\Route;
use Includes\Controllers\CategoriesController;

Route::add('add_category', array(CategoriesController::class, 'addCategory'));
Route::add('edit_category', array(CategoriesController::class, 'editCategory'));
Route::add('delete_category', array(CategoriesController::class, 'deleteCategory'));
