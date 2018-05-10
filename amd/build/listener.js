define(['jquery', 'core/ajax'], function ($, ajax) {
    return {
        initialise: function (cmid) {
            var video = document.querySelector('video');
            video.addEventListener('ended', function () {
                ajax.call([{
                    methodname: 'local_videocomp_set_module_viewed',
                    args: {cmid: cmid, userid: this._lastUserId}
                }]);
            });
        }
    };
});