function showDiagram(strApls)
{
    $("#id_connections").hide();
    $("#id_chart").show();
    $("#id_back").show();

    showERDiagram('id_chart', strApls)
}

function showConnections()
{
    $("#id_connections").show();
    $("#id_chart").hide();
    $("#id_chart").html('');
    $("#id_back").hide();
}

function getERDiagram(str_conn)
{
    $.ajax({
        type: 'POST',
        url: nm_url_iface + 'er_diagram.php',
        data: 'ajax=nm&ajax_option=get_db_relations&str_conn=' + str_conn,
        success: function(response){
            if(response.indexOf('<script>') >=0)
            {
                str_eval = response.substr(response.indexOf('<script>')+8);
                str_eval = str_eval.substr(0, str_eval.indexOf('</script>'));
                eval(str_eval);
            }
            else
            {
                response = response.split('_@NM@_');
                if(response[0] == "ok")
                {
                    showDiagram(JSON.parse(response[1]));
                }
            }
        }
    });
}