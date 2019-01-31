jQuery(document).ready(function($) {
    var Helper = (function(){
        function Helper(){}

        Helper.prototype.isInt = function (value) {
            var x;
            return isNaN(value) ? !1 : (x = parseFloat(value), (0 | x) === x);
        };

        Helper.prototype.decodeEntities = function (str) {
            var element = document.createElement('div');

            if (str && typeof str === 'string') {
                // strip script/html tags
                str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
                str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
                element.innerHTML = str;
                str = element.textContent;
                element.textContent = '';
            }

            return str;
        };

        return Helper;
    })();

    var ajax_object = {},
        $obeliskPlayerData = $('#obelisk-player-data'),
        $allPlaylists = $('.obelisk-playlist, .obelisk-playlist ol'),
        $userSongList = $('.obelisk-playlist.user-song-list'),
        $playerSongList = $(".obelisk-left-col .song-list"),
        helper = new Helper(),
        adjustment;

    ajax_object.ajax_url = $obeliskPlayerData.data('url');
    ajax_object.nonce = $obeliskPlayerData.data('nonce');

    $playerSongList.sortable({
        group: 'categories',
        drop: false,
        onDragStart: function ($item, container, _super) {
            var offset = $item.offset(),
                pointer = container.rootGroup.pointer;

            adjustment = {
                left: pointer.left - offset.left,
                top: pointer.top - offset.top
            };

            if (!container.options.drop) {
                // Keep the source in admin defined playlist
                var $itemAudio = $item.find('.obelisk-audio'),
                    $itemProgress = $item.find('progress');

                $item.removeClass('playing');
                $itemAudio.trigger('pause');
                $itemProgress.attr('value', 0);
                $item.clone().insertAfter($item);
            }

            _super($item, container);
        },
        onDrop: function ($item, container, _super) {
            var $droppedLi = $groupUserList.find('[data-id="' + $item.data('id') + '"]'),
                $droppedLiAudio = $droppedLi.find('audio');

            $droppedLi.removeClass('playing');
            $droppedLiAudio.trigger('pause');
            $droppedLiAudio[0].currentTime = 0;

            if ($droppedLi.length > 1) {
                // Song already in playlist, remove it
                $droppedLi[$droppedLi.length - 1].remove();
            }

            var $clonedItem = $('<li/>').css({height: 0});
            $item.before($clonedItem);
            $clonedItem.animate({'height': $item.height()});

            $item.animate($clonedItem.position(), function  () {
                $clonedItem.detach();
                _super($item, container);
            });

            // AJAX CALLS HERE
            var userListData = $groupUserList.sortable("serialize");

            // Filter out the empty objects
            var playlistData = $.grep(userListData[0], function(n) {
                return !$.isEmptyObject(n);
            });

            // Convert array to object
            var playlistDataObj = $.extend({}, playlistData);

            var data = {};
            data.action = "save_playlist";
            data.nonce = ajax_object.nonce;
            data.playlist = playlistDataObj;

            $.ajax({
                type: 'POST',
                data: data,
                url: ajax_object.ajax_url,
            });
        },
        onDrag: function ($item, position) {
            $item.css({
                left: position.left - adjustment.left,
                top: position.top - adjustment.top
            });
        }
    });

    var $groupUserList = $userSongList.sortable({
        group: 'categories'
    });


    $allPlaylists.on('mousedown touchstart click', '.play-btn, .pause-btn, .close-btn, .obelisk-progress-container', function(e) {
        e.preventDefault();
        e.stopPropagation();
    });

    $userSongList.on('click', '.close-btn', function () {
        var $song = $(this).closest('li');
        var songID = $song.data('id');

        if (!helper.isInt(songID)) {
            return;
        }

        var data = {};

        data.nonce = ajax_object.nonce;
        data.action = "delete_playlist_song";
        data.songID = songID;

        $.ajax({
            type: 'POST',
            data: data,
            url: ajax_object.ajax_url,
            success: function (response) {
                if (!response.hasOwnProperty('success') || !response.data.hasOwnProperty('song_id')) {
                    // Fail
                    return;
                }

                if (response.success) {
                    // Success
                    var $song = $userSongList.find('li[data-id="' + response.data.song_id + '"]');

                    $song.fadeOut(function () {
                        $(this).remove();
                    });
                }
            },
            error: function() {
                // Fail
            }
        });
    });

    var $songHoverDescription = $('.song-hover-description'),
        $songActiveDescription = $('.song-active-description');

    $('.obelisk-container').on({
            mouseenter: function() {
                $songHoverDescription.html(helper.decodeEntities($(this).data('description')));
                $songActiveDescription.hide();
                $songHoverDescription.show();
            },
            mouseleave: function() {
                $songHoverDescription.html('');
                $songActiveDescription.show();
                $songHoverDescription.hide();
            }
        }, '.song'
    );

    // Obelisk player controls
    var Player = (function () {
        function Player() {
            this.$audio = $('.obelisk-playlist audio');
            this.$songContainer = $('.obelisk-container .song');
        }

        Player.prototype.refreshVolume = function () {
            this.$audio.each(function () {
                $(this)[0].volume = $(this).data('volume');
            });
        };

        Player.prototype.stopAllAudioVideo = function () {
            this.$audio.each(function () {
                $(this).trigger('pause');
            });
        };

        Player.prototype.resetPauseStates = function () {
            this.$songContainer.each(function () {
                $(this).removeClass('playing');
            });
        };

        Player.prototype.updateDescription = function (description) {
            $('.song-active-description').html(helper.decodeEntities(description));
        };

        Player.prototype.formatTime = function (s) {
            var seconds = Math.floor( s );
            var minutes = Math.floor( s / 60 );
            minutes = minutes >= 10 ? minutes : '0' + minutes;
            seconds = Math.floor( seconds % 60 );
            seconds = seconds >= 10 ? seconds : '0' + seconds;

            return minutes + ':' + seconds;
        };

        return Player;
    })();

    var player = new Player();
    player.refreshVolume();

    document.addEventListener('ended', function(e) {
        var $this = $(e.target);

        if (!$this.is('.obelisk-audio')) {
            return;
        }

        var $closestLi = $this.closest('.song'),
            $nextLi = $closestLi.next('.song');

        $closestLi.removeClass('playing');

        if (!$nextLi.length) {
            // Last song played, loop from the first one
            $nextLi = $closestLi.parent().find('.song').first();
        }

        var $next = $nextLi.find('audio');

        if (!$next.prop('paused')) {
            $next.trigger('pause');
        } else {
            $next.closest('.song').addClass('playing');
            player.updateDescription($nextLi.data('description'));
            $next.trigger('play');
        }
    }, true);

    document.addEventListener('timeupdate', function(e) {
        var $this = $(e.target);

        if (!$this.is('.obelisk-audio')) {
            return;
        }

        var audio = e.target,
            $songContent = $this.parent('.song-content'),
            $progress = $songContent.find('.obelisk-progress-container progress'),
            $currentTime = $songContent.find('.current-time'),
            $totalTime = $songContent.find('.total-time');

        if (audio.readyState > 0) {
            $currentTime.text(player.formatTime(audio.currentTime));
            $totalTime.text(player.formatTime(audio.duration));
            $progress.attr("value", audio.currentTime / audio.duration);
        }

        $progress.on('click', function (e) {
            audio.currentTime = audio.duration * (e.offsetX / this.offsetWidth);
        });
    }, true);

    $allPlaylists.on('click', '.play-btn', function (e) {
        player.stopAllAudioVideo();
        player.resetPauseStates();

        var $closestLi = $(this).closest('.song'),
            $audio = $(this).closest('.song-content').find('audio');

        $closestLi.addClass('playing');

        player.updateDescription($closestLi.data('description'));

        if (!$audio.prop('paused')) {
            $audio.trigger('pause');
        } else {
            $audio.trigger('play');
        }
    });

    // Pause button
    $allPlaylists.on('click', '.pause-btn', function (e) {
        var $audio = $(this).closest('.song-content').find('audio');

        $audio.trigger('pause');

        player.resetPauseStates();
    });

    $('.toggle-btn').on('click', function (e) {
        e.preventDefault();

        var $that = $(this);

        $that.hide();
        $that.siblings('img').show();
        $that.closest('.category-name').siblings('.song-list').slideToggle();
    });
});
