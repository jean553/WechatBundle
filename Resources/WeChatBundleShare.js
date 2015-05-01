/**
 * Sharing module for WeChat
 */
var WeChatBundleShare = (function() {
    'use strict';

    /**
     * Initialization method
     *
     * @method initialize
     *
     * @param {String} ticket, API ticket
     * @param {String} title, shared message title
     * @param {String} desc, shared message description
     * @param {String} link, link URL
     * @param {String} image, picture path
     *
     * @public
     */
    function initialize(
        ticket,
        appid,
        title,
        desc,
        link,
        image
    ) {

        // generate the signature string
        var signature =
            'jsapi_ticket=' +
            ticket +
            '&noncestr=SieB9eeM7aeWeeSheesu' +
            '&timestamp=1414587457' +
            '&url=' +
            document.URL;

        // generate the hash of
        // the signature string
        var shaObj = new jsSHA(signature, 'TEXT');
        var hash = shaObj.getHash('SHA-1', 'HEX');

        // WeChat API configuration
        wx.config({
            debug: false,
            appId: appid,
            timestamp: '1414587457',
            nonceStr: 'SieB9eeM7aeWeeSheesu',
            signature: hash,
            jsApiList: [
                'onMenuShareAppMessage',
                'onMenuShareTimeline'
            ]
        });

        // WeChat API is ready
        wx.ready(function() {

            // triggered when the user
            // share content to a friend
            wx.onMenuShareAppMessage({
                title: title,
                desc: desc,
                link: link,
                imgUrl: image,
                type: 'link',
                dataUrl: '',
                success: function() {
                },
                cancel: function() {
                }
            });

            // triggered when the user
            // share content on his wall
            wx.onMenuShareTimeline({
                title: title,
                desc: desc,
                link: link,
                imgUrl: image,
                type: 'link',
                dataUrl: '',
                success: function() {
                },
                cancel: function() {
                }
            });
        });
    }

    return {
        initialize: initialize
    };
}());
