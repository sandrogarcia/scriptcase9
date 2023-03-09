$.ajaxTransport("+binary", function(options, originalOptions, jqXHR){
    // check for conditions and support for blob / arraybuffer response type
    if (window.FormData && ((options.dataType && (options.dataType == 'binary')) || (options.data && ((window.ArrayBuffer && options.data instanceof ArrayBuffer) || (window.Blob && options.data instanceof Blob)))))
    {
        return {
            // create new XMLHttpRequest
            send: function(headers, callback){
                // setup all variables
                var xhr = new XMLHttpRequest(),
                    url = options.url,
                    type = options.type,
                    async = options.async || true,
                    // blob or arraybuffer. Default is blob
                    dataType = options.responseType || "blob",
                    data = options.data || null,
                    username = options.username || null,
                    password = options.password || null;

                xhr.addEventListener('load', function(){
                    var data = {};
                    data[options.dataType] = xhr.response;
                    // make callback and send data
                    callback(xhr.status, xhr.statusText, data, xhr.getAllResponseHeaders());
                });

                xhr.open(type, url, async, username, password);

                // setup custom headers
                for (var i in headers ) {
                    xhr.setRequestHeader(i, headers[i] );
                }

                xhr.responseType = dataType;
                xhr.send(data);
            },
            abort: function(){
                jqXHR.abort();
            }
        };
    }
});

var i18n;
var arr_locale_data =[];
function loadLocalFile(file) {
    var locale_data;

    if(arr_locale_data[file]) {
        i18n = new Jed({
            'locale_data': arr_locale_data[file],
            'domain': file
        });
    }
    else {

        var url = nm_url_iface + '../lang/' + lang_page + '/LC_MESSAGES/' + file + '.mo';
        $.ajax({
            url: url,
            type: "GET",
            dataType: "binary",
            async: false,
            cache: true,
            processData: false,
            responseType: 'arraybuffer',
            success: function (result) {
                var opts = {
                    domain: file
                };

                locale_data = jedGettextParser.mo.parse(result, opts);

                arr_locale_data[file] = locale_data;

                i18n = new Jed({
                    'locale_data': locale_data,
                    'domain': file
                });

            }
        });
    }
}

function nm_get_text_lang(lang)
{
   /* if(typeof(arr_lang) !== 'undefined') {
        $.each(arr_lang, function (i, value) {
            loadLocalFile(value);
        });
    }*/
    var retorno = '';
    try {
        if (typeof i18n == 'undefined') {
            loadLocalFile(arr_lang[0]);
        }

        retorno = i18n.translate(lang).fetch();
        if (retorno == lang) {
            $.each(arr_lang, function (i, value) {
                if (retorno == lang) {
                    loadLocalFile(value);

                    retorno = i18n.translate(lang).fetch();
                }
            });

        }
    }catch (e) {
    }
    return retorno == '' ? lang : retorno;


}



