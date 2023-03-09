$(document).ready( function() {
    if ($('#kayako_brand')[0]) {
        (function (d, a) {
            window.c = function c() {
                var b = d.createElement("script");
                b.async = !0;
                b.type = "text/javascript";
                b.src = a._settings.messengerUrl;
                b.crossOrigin = "anonymous";
                var c = d.getElementsByTagName("script")[0];
                c.parentNode.insertBefore(b, c)
            }

            window.kayako = a;
            a.readyQueue = [];
            a.newEmbedCode = !0;
            a.ready = function (b) {
                a.readyQueue.push(b)
            };
            a._settings = {
                apiUrl: "https://scriptcase-" + $('#kayako_brand').val() + ".kayako.com/api/v1",
                teamName: $('#kayako_title').val(),
                homeTitles: [{
                    "locale": "en-us",
                    "translation": $('#kayako_hometitle').val()
                }, {
                    "locale": "pt-br",
                    "translation": $('#kayako_hometitle').val()
                }, {
                    "locale": "es",
                    "translation": $('#kayako_hometitle').val()
                }],
                homeSubtitles: [{
                    "locale": "en-us",
                    "translation": $('#kayako_homesub').val()
                }, {
                    "locale": "pt-br",
                    "translation": $('#kayako_homesub').val()
                }, {
                    "locale": "es",
                    "translation": $('#kayako_homesub').val()
                }],
                messengerUrl: "https://scriptcase-" + $('#kayako_brand').val() + ".kayakocdn.com/messenger",
                realtimeUrl: "wss://kre.kayako.net/socket",
                widgets: {
                    presence: {
                        enabled: false
                    },
                    twitter: {
                        enabled: false,
                        twitterHandle: "703372561"
                    },
                    articles: {
                        enabled: false,
                        sectionId: null
                    }
                },
                styles: {
                    primaryColor: "#3F5AF1",
                    homeBackground: "-134deg, #581F7E 0%, #5195F8 100%",
                    homePattern: "https://assets.kayako.com/messenger/pattern-1--dark.svg",
                    homeTextColor: "#FFFFFF"
                }
            };
            window.attachEvent ? window.attachEvent("onload", c) : window.addEventListener("load", c, !1)
        })(document, window.kayako || {});

        var chatBubble = document.querySelector('#sc-chat-bubble');

        window.toggleMessenger = function toggleMessenger() {
            // chatBubble.classList.toggle('active');
            $('#question-kayako').toggle();
            $('#close-kayako').toggle();
            if (kayako.visibility() === 'minimized') {
                kayako.maximize()
                $('#kayako-icon').addClass('disabled-sc');
                $('#kayako-icon').on('mouseover.hoverkayako', function(ev) {
                    ev.preventDefault();
                    return false;
                });
                $('#kayako-icon').on('click.closekayako', function(ev) {
                    $('#kayako-icon').off('click.closekayako');
                    $('#kayako-icon').off('mouseover.hoverkayako');
                    $('#kayako-icon').removeClass('disabled-sc');
                    $('#question-kayako').toggle();
                    $('#close-kayako').toggle();
                    kayako.minimize();
                    ev.preventDefault();
                    return false;
                });
            } else {
                kayako.minimize();
                $('#question-kayako').toggle();
                $('#close-kayako').toggle();
            }
            // e.preventDefault();

        }

        var scChatText = document.getElementById('sc-chat-text');

        window.closeChatText = function closeChatText() {
            // scChatText.style.display = 'none';

            var dateCookie = new Date();
            dateCookie = new Date(dateCookie.getTime() + 7 * 1000 * 60 * 60 * 24);
            document.cookie = 'sc-chat-text=true; expires=' + dateCookie.toGMTString();
        }

        setTimeout(function () {
            kayako.ready(function () {
                var messenger = document.getElementById('kayako-messenger');
                // var bubble = document.getElementById('sc-chat-bubble');

                messenger.className = "minimized";

                if (scChatText) {
                    setTimeout(function () {
                        scChatText.style.display = 'inline-block';
                    }, 5000);

                    setTimeout(function () {
                        scChatText.className = 'sc-chat-text animate';
                    }, 5500);
                }

                kayako.on('chat_window_maximized', function () {
                    messenger.className = "maximized";
                    // scChatText.style.display = 'none';
                    // scChatText.className = "sc-chat-text";

                    closeChatText();
                })

                kayako.config = {
                    hideReplyTime: true,
                    hideLauncher: true
                }
                $('#kayako-icon').show();

                // chatBubble.classList.add('visible');

                // listen for realtime updates
                // kayako.on('unread_messages_count_changed', function (count) {
                //     var element = document.getElementById('kayako-unread-counts')
                //
                //     if (count > 0) {
                //         var suffix = count === 1 ? '' : 's'
                //         element.style.display = 'block'
                //         element.innerHTML = count + ' new message' + suffix
                //     } else {
                //         element.style.display = 'none'
                //     }
                // })


            })
        })
    }
});